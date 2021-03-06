<?php

namespace App;

use App\Http\Controllers\PaidController;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;
use Nicolaslopezj\Searchable\SearchableTrait;
use CyrildeWit\EloquentViewable\InteractsWithViews;
use CyrildeWit\EloquentViewable\Contracts\Viewable;

//  implements Viewable
class Course extends Model
{
    // use InteractsWithViews;
    use SearchableTrait;

    protected $fillable = ['title', 'titleEng', 'description', 'sortingDate', 'releaseDate', 'updateDate', 'slug_linkedin'];
    // protected $with = ['authors'];

    /**
     * Searchable rules.
     *
     * @var array
     */
    protected $searchable = [
        /**
         * Columns and their priority in search results.
         * Columns with higher values are more important.
         * Columns with equal values have equal importance.
         *
         * @var array
         */
        'columns' => [
            'courses.title' => 30,
            'courses.titleEng' => 30,
            'courses.description' => 1,
            'courses.descriptionEng' => 1,
            'courses.concepts' => 1,
            'courses.conceptsEng' => 1,
            // 'subjects.title' => 6,
            // 'software.title' => 6,
            // 'authors.name' => 6,
            // 'libraries.title' => 4,
            // 'libraries.titleEng' => 4,
        ],
        'joins' => [
            // 'libraries' => ['courses.library_id','libraries.id'],
            // 'course_subject' => ['course_subject.course_id', 'courses.id'],
            // 'subjects' => ['subjects.id', 'course_subject.subject_id'],
            // 'course_software' => ['course_software.course_id', 'courses.id'],
            // 'software' => ['software.id', 'course_software.software_id'],
            // 'author_course' => ['author_course.course_id', 'courses.id'],
            // 'authors' => ['authors.id', 'author_course.author_id'],
        ],
    ];

    protected static function boot()
    {
        parent::boot();

        static::retrieved(
            function ($model) {
                if (isset($_SERVER['HTTP_USER_AGENT'])) {
                    if (strstr($_SERVER['HTTP_USER_AGENT'], 'iPhone') || strstr($_SERVER['HTTP_USER_AGENT'], 'iPad') || strstr($_SERVER['HTTP_USER_AGENT'], 'Mac')) {
                        $model->img = str_replace(".webp", ".jpg", $model->img);
                        $model->thumbnail = str_replace(".webp", ".jpg", $model->thumbnail);
                    }
                }
            }
        );
    }
    /**
     * A Course belong to many users
     *
     * @return belongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    /**
     * A Course belong to a author
     *
     * @return belongsToMany
     */
    public function authors()
    {
        return $this->belongsToMany(Author::class);
    }

    /**
     * A Course belong to many subjects
     *
     * @return BelongsToMany
     */
    public function subjects()
    {
        return $this->belongsToMany(Subject::class);
    }

    /**
     * A Course belong to many softwares
     *
     * @return BelongsToMany
     */
    public function softwares()
    {
        return $this->belongsToMany(Software::class);
    }

    /**
     * A Course belong to many learn_paths
     *
     * @return BelongsToMany
     */
    public function learn_paths()
    {
        return $this->belongsToMany(LearnPath::class);
    }

    /**
     * A Software belong to a library
     *
     * @return BelongsTo
     */
    public function library()
    {
        return $this->belongsTo(Library::class);
    }

    /**
     * A Course can have many bookmark_parts
     *
     * @return HasMany
     */
    public function bookmark_parts()
    {
        return $this->hasMany(BookmarkPart::class);
    }

    /**
     * A Course can have many course_parts
     *
     * @return HasMany
     */
    public function course_parts()
    {
        return $this->hasMany(CoursePart::class);
    }

    public function isPaid()
    {
        if (auth()->check()) {
            if (User::find(auth()->id())->isAdmin())
                return true;
            if ((new PaidController)->isPaid($this->id, auth()->id(), '1')) {
                return true;
            }
        }
        return false;
    }

    public function setTitleEngAttribute($value)
    {
        $this->attributes['titleEng'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    public function getCreatedDateAttribute()
    {
        return $this->created_at->diffForHumans();
    }

    // public function getBodyHtmlAttribute()
    // {
    //     return \Parsedown::instance()->text($this->description);
    // }

    public function getTableColumns()
    {
        return $this->getConnection()->getSchemaBuilder()->getColumnListing($this->getTable());
    }
}
