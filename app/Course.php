<?php

namespace App;

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
    protected $fillable = ['title', 'titleEng', 'description'];
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
            'courses.title' => 10,
            'courses.titleEng' => 10,
            // 'courses.description' => 3,
            // 'courses.descriptionEng' => 3,
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
