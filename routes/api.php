<?php

use App\Author;
use App\Course;
use App\Discount;
use App\LearnPath;
use App\Mail\DubJoinMailer;
use App\Paid;
use App\Subject;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('guest')->get('/find-courses/', 'CourseController@courses_find_api')->name('courses.find.api');

Route::middleware('guest')->get('/subjects', 'SubjectController@subjects_api')->name('subjects.api');
Route::middleware('guest')->get('/software', 'SoftwareController@software_api')->name('software.api');
Route::middleware('guest')->get('/software/has-courses', 'SoftwareController@software_has_api')->name('software.api');
Route::middleware('guest')->post('/set-software', 'SoftwareController@set_software_api')->name('software.set.api');
Route::middleware('guest')->post('/courses/set', 'CourseController@courses_api_set')->name('courses.set.api');
Route::middleware('guest')->get('/courses', 'CourseController@courses_api')->name('courses.api');
Route::middleware('guest')->get('/courses/{id}', 'CourseController@course_api')->name('course.api');
Route::middleware('guest')->get('/courses/get-course/{slug}', 'CourseController@get_course_api')->name('course.api');
Route::middleware('guest')->post('/courses/get-for-aparat', 'CourseController@course_api_get_for_aparat')->name('course.api.get-for-aparat');
Route::middleware('guest')->post('/courses/get-course', 'CourseController@course_api_get_course')->name('course.api.get-for-instagram');
Route::middleware('guest')->post('/courses/get-hashed-data', 'CourseController@course_api_get_hashed_data')->name('course.api.get-hashed-data');
Route::middleware('guest')->post('/courses/check-token', 'CourseController@course_api_check_token')->name('course.api.check-token');
Route::middleware('guest')->post('/courses/with-link', 'CourseController@courses_with_link_api')->name('course.api.with-link');
Route::middleware('guest')->post('/courses/set-slug-linkedin', 'CourseController@courses_set_slug_linkedin')->name('course.api.set-slug-linkedin');
Route::middleware('guest')->get('/courses/add-view/{id}', 'CourseController@add_view')->name('courses.add-view.api');
Route::middleware('guest')->get('/courses/add-views/{id}/{count}', 'CourseController@add_views')->name('courses.add-views.api');
Route::middleware('guest')->get('/courses-all', 'CourseController@courses_all_api')->name('courses.all.api');
Route::middleware('guest')->get('/authors', 'AuthorController@authors_api')->name('authors.api');
Route::middleware('guest')->get('/authors/has-courses', 'AuthorController@authors_has_api')->name('authors-has.api');
Route::middleware('guest')->post('/authors/update/{id}', 'AuthorController@update_api')->name('authors.update.api');
Route::middleware('guest')->get('/views', 'DataController@views_api')->name('views.api');
Route::middleware('guest')->get('/course-set-view', 'CourseController@course_set_view_api')->name('courses.set-view.api');
Route::middleware('guest')->post('/course-set-thumbnail', 'CourseController@course_set_thumbnail_api')->name('courses.set-thumbnail.api');
Route::middleware('guest')->post('/course-set-img-thumbnail', 'CourseController@course_set_img_thumbnail_api')->name('courses.set-img-thumbnail.api');

Route::middleware('guest')->post('/courses/update-view-from-linkedin', 'CourseController@course_update_view_from_linkedin_api')->name('course.update.view.api');
Route::middleware('guest')->post('/course-subject/set', 'CourseController@course_subject_set_api')->name('course.subject.set.api');
Route::middleware('guest')->post('/course-related/set', 'CourseController@course_related_set_api')->name('course.related.set.api');
Route::middleware('guest')->post('/subjects/add', 'SubjectController@subject_add_api')->name('subjects.add.api');

Route::middleware('guest')->get('/learn-path/get-all', 'LearnPathController@get_all_api')->name('learn-path.get-all.api');
Route::middleware('guest')->get('/learn-path/get', 'LearnPathController@get_api')->name('learn-path.get.api');
Route::middleware('guest')->post('/learn-path/set-img', 'LearnPathController@set_img_api')->name('learn-path.set-img.api');
Route::middleware('guest')->get('/learn-path/course-list/{slug}', 'LearnPathController@course_list_api')->name('learn-path.course-list.api');
Route::middleware('guest')->get('/learn-path/set-courses-id', 'LearnPathController@set_courses_id_api')->name('learn-path.set-course.api');
Route::middleware('guest')->get('/learn-path/set-category', 'LearnPathController@set_category_api')->name('learn-path.set-category.api');

Route::middleware('guest')->post('/course/set-price', 'CourseController@set_price_api')->name('course.set.price.api');

Route::middleware('guest')->post('/test', 'CourseController@test_api')->name('subjects.add.api');

Route::middleware('guest')->get('/test/urls', 'CourseController@test_urls_api')->name('courses.test.urls.api');

Route::middleware('guest')->get('/get-yalda-time', function () {
    return new JsonResponse([
        'data' => yalda_time_remaining()
    ]);
})->name('get-yalda-time');

Route::middleware('guest')->get('/test-query', function (Request $request) {
    return;
    foreach (LearnPath::get() as $path) {
        $courses_id = [];
        foreach (json_decode($path->courses) as $course) {
            $courses_id[] = $course->id;
        }
        $total_duration_m = Course::whereIn('id', $courses_id)->sum('durationHours') * 60;
        $total_duration_m += Course::whereIn('id', $courses_id)->sum('durationMinutes');
        $duration_h = (int)($total_duration_m / 60);
        $duration_m = (int)($total_duration_m % 60);
        LearnPath::where('id', $path->id)->update([
            'courses_id' => implode(',', $courses_id),
            'duration_h' => $duration_h,
            'duration_m' => $duration_m,
        ]);
    }

    $q = trim($request->get('q', ''));

    if (empty($q)) {
        return new JsonResponse([
            'data' => DB::select('select * from courses')
        ]);
    }

    $qq = preg_split('([\ ])', $q);
    $q3 = [];
    foreach ($qq as $value) {
        if (!empty($value))
            $q3[] = '(titleEng LIKE "%' . $value . '%")';
    }

    return new JsonResponse([
        'data' => DB::select('select id,titleEng,
        (
            ((titleEng ="' . $q . '") * 5) +
            ((titleEng LIKE "%' . $q . '%") * 3) +
            ' . implode(' + ', $q3) . '
        ) as matches
        from courses
        where ' . implode(' OR ', $q3) . '
        ORDER BY matches DESC')
    ]);
})->name('test query');

Route::middleware('guest')->post('/main-page/courses', function (Request $request) {
    $onlyFree = $request->get('onlyFree', '0');
    $sortingOrder = $request->get('sortingOrder', '1');
    $libraries = $request->get('libraries', '');
    $language = $request->get('language', '3');
    $user_username = $request->get('user_username');
    $author_slug = $request->get('author_slug');
    $subject_slug = $request->get('subject_slug');
    $q = $request->get('q');

    // $sortingOrder = intval($sortingOrder) == 1 ? 'sortingDate' : 'views';
    $courses = Course::query();
    $type = 'main';

    if ($subject_slug != null) {
        $subject = Subject::with('courses')->where('slug', $subject_slug)->orWhere('slug', str_replace("-training-tutorials", "", $subject_slug))->first();
        if ($subject) {
            $courses = $subject->courses();
            $type = 'subject';
        } else {
            return new JsonResponse([false], 404);
        }
    } else if ($author_slug != null) {
        $author = Author::with('courses')->where('slug', $author_slug)->first();
        if ($author) {
            $courses = $author->courses();
            $type = 'author';
        } else {
            return new JsonResponse([false], 404);
        }
    } else if ($user_username != null) {
        $user = User::with('courses')->where('username', $user_username)->first();
        if ($user) {
            $courses = $user->courses();
            $type = 'user';
        } else {
            return new JsonResponse([false], 404);
        }
    } else if ($q != null) {
        $courses = Course::search($q);
        $type = 'search';
    }

    if (empty($libraries)) {
        $libraries = \App\Library::get()->pluck('id')->toArray();
    } else {
        $libraries = explode(',', $libraries);
    }

    if (count($libraries) < 3) {
        $courses = $courses->whereHas('subjects', function ($q) use ($libraries) {
            $q->whereIn('library_id', $libraries);
        });
    }
    if (intval($onlyFree) == 1) {
        $courses = $courses->where('price', 0);
    }
    if ($q == null) {
        if (intval($sortingOrder) == 1) {
            $courses = $courses->orderByDesc('sortingDate');
        } else {
            $courses = $courses->orderByDesc('views');
        }
    }

    if ($language == 1) {
        $courses = $courses->where('dubbed_id', 1);
    } else if ($language == 2) {
        $courses = $courses->where('dubbed_id', 2);
    }
    $limit = 20;
    $page = intval($request->get('page', 1));

    $courses_count = $courses->count();
    $hasMore = $courses_count > $limit * $page;

    $offset = ($page - 1) * $limit;
    $courses = $courses->skip($offset)->limit($limit);
    // $courses = $courses->with(['subjects', 'authors']);
    $courses = $courses->get()->makeHidden(['courseFile', 'exerciseFile', 'persianSubtitleFile']);
    return new JsonResponse([
        'data' => view('courses.partials._course_list_new_total', [
            'courses' => $courses,
        ])->render(),
        'params' => [
            'onlyFree' => $onlyFree,
            'sortingOrder' => $sortingOrder,
            'libraries' => $libraries,
            'type' =>  $type,
            'page' =>  $page,
        ],
        'hasMore' => $hasMore,
        'courses_count' => $courses_count,
        'status' => 'success'
    ]);
})->name('main-page.courses.api');

Route::middleware('guest')->post('/subjects/update', function (Request $request) {
    $subs = $request->get('subs');
    if (!$subs) {
        return new JsonResponse([
            'status' => 'failed'
        ], 403);
    }
    try {
        $subs = json_decode($subs);

        foreach ($subs as $d) {
            $id = $d->id;
            $title_per = $d->title_per;
            // return new JsonResponse([
            //     'id' => $id,
            //     'title_per' => $title_per,
            //     'status' => 'success',
            // ], 200);
            Subject::where('id', $id)->update(['title_per' => $title_per]);
        }

        return new JsonResponse([
            'status' => 'success'
        ], 200);
    } catch (Exception $e) {
        return new JsonResponse([
            'e' => $e->getMessage(),
            'subs' => $request->get('subs'),
            'status' => 'failed'
        ], 500);
    }
})->name('subjects.update.api');

Route::middleware('guest')->get('/package/check-code', function (Request $request) {
    $code = $request->get('code');
    $price = $request->get('price');
    if (!$code || !$price) {
        return new JsonResponse([
            'data' => false,
            'status' => 'failed'
        ], 200);
    }

    $today = \Carbon\Carbon::now();
    $dis = Discount::where(DB::raw('BINARY `code`'), $code)
        ->whereDate('start_date', '<=', $today)
        ->whereDate('end_date', '>=', $today)
        ->first();
    if ($dis) {
        return new JsonResponse([
            'data' => true,
            'percent' => $dis->percent,
            'new_price' => $price - ($dis->percent / 100 * $price),
            'status' => 'success'
        ], 200);
    }
    return new JsonResponse([
        'data' => false,
        'status' => 'failed'
    ], 200);
})->name('package.check-code.api');

Route::middleware('guest')->get('/users/get-data-all', function (Request $request) {
    $code = $request->get('code');
    if ($code == 'hadi00') {
        $users = User::get(['email'])->pluck('email');
        return new JsonResponse([
            'data' => str_replace('"', '', implode(',', array($users))),
            'status' => 'success'
        ], 200);
    }
    return new JsonResponse([
        'status' => 'failed'
    ], 403);
});

Route::middleware('guest')->get('/paid/get-data-all', function (Request $request) {
    $code = $request->get('code');
    if ($code == 'hadi00') {
        $paids = Paid::get();
        return new JsonResponse([
            'data' => $paids,
            'status' => 'success'
        ], 200);
    }
    return new JsonResponse([
        'status' => 'failed'
    ], 403);
});

Route::middleware('guest')->post('/dubbed/join', function (Request $request) {
    $form_data = (object)$request->only(['name', 'gender', 'skills', 'email', 'phone']);
    Mail::to('apply@lyndakade.ir')->send(new DubJoinMailer($form_data));
    return new JsonResponse([
        'data' => $form_data,
        'status' => 'success'
    ], 200);
})->name('dubbed-join.api');

Route::middleware('guest')->post('/courses/set-short-desc', function (Request $request) {
    $desc = $request->get('desc');
    if ($desc) {
        $desc = explode('||', $desc);
        return new JsonResponse([
            'slug' => explode('|', $desc[0])[0],
            'short_desc_eng' => explode('|', $desc[0])[0],
            'short_desc_per' => explode('|', $desc[0])[0],
        ], 200);
        foreach ($desc as $d) {
            $d = explode('|', $d);
            $slug = $d[0];
            $short_desc_eng = $d[1];
            $short_desc_per = $d[2];
            Course::where('slug_linkedin', $slug)
                ->orWhere('slug_url', $slug)
                ->orWhere('slug_url', 'LIKE', '%,' . $slug)
                ->orWhere('slug_url', 'LIKE', '%,' . $slug . ',%')
                ->orWhere('slug_url', 'LIKE', $slug . ',%')
                ->update([
                    'shortDesc' => $short_desc_per,
                    'shortDescEng' => $short_desc_eng,
                ]);
        }
    }
    return new JsonResponse([
        'status' => 'success'
    ], 200);
})->name('dubbed-join.api');
// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
