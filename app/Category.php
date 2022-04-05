<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['title', 'titleEng', 'slug'];


    /**
     * A Category belong to many LearnPaths
     *
     * @return belongsToMany
     */
    public function learn_paths()
    {
        return $this->belongsToMany(LearnPath::class);
    }

}
