<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['title', 'titleEng', 'slug'];


    /**
     * A Category has many LearnPaths
     *
     * @return belongsToMany
     */
    public function paths()
    {
        return $this->hasMany(LearnPath::class);
    }

}
