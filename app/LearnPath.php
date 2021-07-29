<?php

namespace App;

use App\Http\Controllers\PaidController;
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
            // 'learn_paths.description' => 4,
            // 'learn_paths.descriptionEng' => 4,
            // 'courses.title' => 10,
            // 'courses.titleEng' => 10,
            // 'libraries.title' => 4,
            // 'libraries.titleEng' => 4,
        ],
        'joins' => [
            // 'libraries' => ['learn_paths.library_id','libraries.id'],
            // 'course_learn_path' => ['course_learn_path.learn_path_id','learn_paths.id'],
            // 'courses' => ['courses.id','course_learn_path.course_id'],
        ],
    ];

    /**
     * A LearnPath belong to a library
     *
     * @return BelongsTo
     */
    public function library()
    {
        return $this->belongsTo(Library::class);
    }

    public function durationHours()
    {
        $courses = js_to_courses($this->courses);
        $res = 0;
        foreach ($courses as $course) {
            $res += ($course->durationHours * 60) + $course->durationMinutes;
        }
        return (int)($res / 60);
    }

    public function durationMinutes()
    {
        $courses = js_to_courses($this->courses);
        $res = 0;
        foreach ($courses as $course) {
            $res += ($course->durationHours * 60) + $course->durationMinutes;
        }
        return (int)($res % 60);
    }

    public function price()
    {
        $courses = js_to_courses($this->courses);
        $res = 0;
        foreach ($courses as $course) {
            if (auth()->check()) {
                if (!(new PaidController)->isPaid($course->id, auth()->id(), '2')) {
                    $res += $course->price;
                }
            } else {
                $res += $course->price;
            }
        }
        return $res * 0.70;
    }

    public function old_price()
    {
        $courses = js_to_courses($this->courses);
        $res = 0;
        foreach ($courses as $course) {
            if (auth()->check()) {
                if (!(new PaidController)->isPaid($course->id, auth()->id(), '2')) {
                    $res += $course->price;
                }
            } else {
                $res += $course->price;
            }
        }
        return $res;
    }

    public function getTableColumns()
    {
        return $this->getConnection()->getSchemaBuilder()->getColumnListing($this->getTable());
    }
}
