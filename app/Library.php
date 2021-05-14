<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;
use Nicolaslopezj\Searchable\SearchableTrait;

class Library extends Model
{
    use SearchableTrait;

    protected $fillable = ['title', 'titleEng'];

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
            'libraries.title' => 4,
            'libraries.titleEng' => 4,
        ],
    ];
    /**
     * A library has many LearnPaths
     *
     * @return HasMany
     */
    public function paths()
    {
        return $this->hasMany(LearnPath::class);
    }

    /**
     * A library has many Subjects
     *
     * @return HasMany
     */
    public function subjects()
    {
        return $this->hasMany(Subject::class);
    }

    /**
     * A library has many Software
     *
     * @return HasMany
     */
    public function software()
    {
        return $this->hasMany(Software::class);
    }

    /**
     * A library has many Courses
     *
     * @return HasMany
     */
    public function courses()
    {
        return $this->hasMany(Course::class);
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
