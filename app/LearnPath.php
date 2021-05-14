<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;
use Nicolaslopezj\Searchable\SearchableTrait;

class LearnPath extends Model
{
    use SearchableTrait;

    protected $fillable = ['title', 'titleEng', 'description'];

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
            'learn_paths.title' => 10,
            'learn_paths.titleEng' => 10,
            'learn_paths.description' => 4,
            'learn_paths.descriptionEng' => 4,
            'courses.title' => 10,
            'courses.titleEng' => 10,
            'libraries.title' => 4,
            'libraries.titleEng' => 4,
        ],
        'joins' => [
            'libraries' => ['learn_paths.library_id','libraries.id'],
            'course_learn_path' => ['course_learn_path.learn_path_id','learn_paths.id'],
            'courses' => ['courses.id','course_learn_path.course_id'],
        ],
    ];

    /**
     * A LearnPath belong to many courses
     *
     * @return BelongsToMany
     */
    public function courses()
    {
        return $this->belongsToMany(Course::class);
    }

    /**
     * A LearnPath belong to a library
     *
     * @return BelongsTo
     */
    public function library()
    {
        return $this->belongsTo(Library::class);
    }

    public function setTitleEngAttribute($value)
    {
        $this->attributes['titleEng'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    public function getTableColumns()
    {
        return $this->getConnection()->getSchemaBuilder()->getColumnListing($this->getTable());
    }
}
