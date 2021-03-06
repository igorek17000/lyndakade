<?php

namespace App;

use App\Http\Controllers\PaidController;
use Exception;
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

    protected static function boot()
    {
        parent::boot();

        static::retrieved(function ($model) {
            // if (strstr($_SERVER['HTTP_USER_AGENT'], 'iPhone') || strstr($_SERVER['HTTP_USER_AGENT'], 'iPad') || strstr($_SERVER['HTTP_USER_AGENT'], 'Mac')) {
            //     $model->img = str_replace(".webp", ".jpg", $model->img);
            //     $model->thumbnail = str_replace(".webp", ".jpg", $model->thumbnail);
            // }
            if ($model->courses) {

                $ids = $model->courses_id;
                if (!$model->courses_id) {
                    $js_courses = json_decode($model->courses);
                    $ids = [];
                    foreach ($js_courses as $c) {
                        $c = (array) $c;
                        $ids[] = $c['id'];
                    }
                    $ids = implode(',', $ids);
                    LearnPath::where('id', $model->id)->update([
                        'courses_id' => $ids
                    ]);
                }
                $model->_courses = Course::whereIn('id', explode(',', $ids))
                    ->orderByRaw("FIELD(id, $ids)")->get();

                // $js_courses = ;
                // // $model->courses = array();
                // if ($js_courses) {
                //     $res = [];
                //     foreach ($js_courses as $c) {
                //         $course_id = $c->id;
                //         $course = Course::find($course_id);
                //         if ($course) {
                //             array_push($res, $course);
                //         }
                //     }
                //     // $ids = [];
                //     // foreach ($js_courses as $c) {
                //     //     array_push($ids, $c->id);
                //     // }
                //     // $ids_ordered = implode(',', $ids);
                //     // $courses = Course::whereIn('id', $ids)
                //     //     ->orderByRaw("FIELD(id, $ids_ordered)")->get();
                //     $model->_courses = $res;
                //     // $model->courses = $courses->get();
                // }
                // // $model->_courses = $courses;
            }
        });
    }

    // protected $with = ['__courses'];

    // public function __courses()
    // {
    //     return $this->hasMany(Course::class,);
    // }

    /**
     * A LearnPath belong to a library
     *
     * @return BelongsTo
     */
    public function library()
    {
        return $this->belongsTo(Library::class);
    }

    /**
     * A LearnPath belong to a Category
     *
     * @return BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function durationHours()
    {
        if ($this->duration_m > 0) {
            return $this->duration_h;
        }
        $courses = js_to_courses($this->_courses);
        // $courses = js_to_courses($this->courses);
        $res = 0;
        foreach ($courses as $course) {
            $res += ($course->durationHours * 60) + $course->durationMinutes;
        }
        return (int)($res / 60);
    }

    public function durationMinutes()
    {
        if ($this->duration_m > 0) {
            return $this->duration_m;
        }
        $courses = js_to_courses($this->_courses);
        // $courses = js_to_courses($this->courses);
        $res = 0;
        foreach ($courses as $course) {
            $res += ($course->durationHours * 60) + $course->durationMinutes;
        }
        return (int)($res % 60);
    }

    public function price()
    {
        $courses = js_to_courses($this->_courses);
        // $courses = js_to_courses($this->courses);
        $res = 0;
        foreach ($courses as $course) {
            if (auth()->check()) {
                if (!(new PaidController)->isPaid($course->id, auth()->id(), '1')) {
                    $res += get_course_price($course->price);
                }
            } else {
                $res += get_course_price($course->price);
            }
        }
        return (int)($res * 0.70 / 100) * 100;
    }

    public function old_price()
    {
        $courses = js_to_courses($this->_courses);
        // $courses = js_to_courses($this->courses);
        $res = 0;
        foreach ($courses as $course) {
            if (auth()->check()) {
                if (!(new PaidController)->isPaid($course->id, auth()->id(), '2')) {
                    $res += get_course_price($course->price);
                }
            } else {
                $res += get_course_price($course->price);
            }
        }
        return $res;
    }

    public function authors()
    {
        $authors = array();
        // $courses = $this->_courses->with('authors')->get();

        foreach ($this->_courses as $key => $course) {
            // foreach ($courses as $key => $course) {
            foreach ($course->authors as $author) {
                array_push($authors, $author->id);
            }
        }
        $authors = Author::find($authors);
        $authors = array_values($authors->all());
        return $authors;
    }

    public function getTableColumns()
    {
        return $this->getConnection()->getSchemaBuilder()->getColumnListing($this->getTable());
    }
}
