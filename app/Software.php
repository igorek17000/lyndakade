<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;
use Nicolaslopezj\Searchable\SearchableTrait;

class Software extends Model
{
    use SearchableTrait;
    protected $fillable = ['id', 'title', 'slug', 'description'];

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
            'software.title' => 10,
            // 'courses.title' => 10,
            // 'courses.titleEng' => 10,
            // 'libraries.title' => 4,
            // 'libraries.titleEng' => 4,
        ],
        'joins' => [
            // 'course_software' => ['course_software.software_id', 'software.id'],
            // 'courses' => ['courses.id', 'course_software.course_id'],
            // 'libraries' => ['software.library_id','libraries.id'],
        ],
    ];
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
     * A Software belong to many courses
     *
     * @return BelongsToMany
     */
    public function courses()
    {
        return $this->belongsToMany(Course::class);
    }

    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = Str::slug($value) . '-training-tutorials';
    }

    public function getTableColumns()
    {
        return $this->getConnection()->getSchemaBuilder()->getColumnListing($this->getTable());
    }
}
