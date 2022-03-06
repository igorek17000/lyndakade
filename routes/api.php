<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

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
Route::middleware('guest')->post('/courses/get-for-instagram', 'CourseController@course_api_get_for_instagram')->name('course.api.get-for-instagram');
Route::middleware('guest')->post('/courses/get-hashed-data', 'CourseController@course_api_get_hashed_data')->name('course.api.get-hashed-data');
Route::middleware('guest')->post('/courses/check-token', 'CourseController@course_api_check_token')->name('course.api.check-token');
Route::middleware('guest')->post('/courses/with-link', 'CourseController@courses_with_link_api')->name('course.api.with-link');
Route::middleware('guest')->post('/courses/set-slug-linkedin', 'CourseController@courses_set_slug_linkedin')->name('course.api.set-slug-linkedin');
Route::middleware('guest')->get('/courses/add-view/{id}', 'CourseController@add_view')->name('courses.add-view.api');
Route::middleware('guest')->get('/courses/add-views/{id}/{count}', 'CourseController@add_views')->name('courses.add-views.api');
Route::middleware('guest')->get('/courses-all', 'CourseController@courses_all_api')->name('courses.all.api');
Route::middleware('guest')->get('/authors', 'AuthorController@authors_api')->name('authors.api');
Route::middleware('guest')->get('/authors/has-courses', 'AuthorController@authors_has_api')->name('authors.api');
Route::middleware('guest')->post('/authors/update/{id}', 'AuthorController@update_api')->name('authors.update.api');
Route::middleware('guest')->get('/views', 'DataController@views_api')->name('views.api');
Route::middleware('guest')->get('/course-set-view', 'CourseController@course_set_view_api')->name('courses.set-view.api');
Route::middleware('guest')->post('/course-set-thumbnail', 'CourseController@course_set_thumbnail_api')->name('courses.set-view.api');
Route::middleware('guest')->post('/course-set-img-thumbnail', 'CourseController@course_set_img_thumbnail_api')->name('courses.set-img-thumbnail.api');

Route::middleware('guest')->post('/courses/update-view-from-linkedin', 'CourseController@course_update_view_from_linkedin_api')->name('course.update.view.api');
Route::middleware('guest')->post('/course-subject/set', 'CourseController@course_subject_set_api')->name('course.subject.set.api');
Route::middleware('guest')->post('/subjects/add', 'SubjectController@subject_add_api')->name('subjects.add.api');

Route::middleware('guest')->get('/learn-path/get-all', 'LearnPathController@get_all_api')->name('learn-path.get-all.api');
Route::middleware('guest')->get('/learn-path/get', 'LearnPathController@get_api')->name('learn-path.get.api');
Route::middleware('guest')->post('/learn-path/set-img', 'LearnPathController@set_img_api')->name('learn-path.set-img.api');
Route::middleware('guest')->get('/learn-path/course-list/{slug}', 'LearnPathController@course_list_api')->name('learn-path.course-list.api');

Route::middleware('guest')->post('/course/set-price', 'CourseController@set_price_api')->name('course.set.price.api');

Route::middleware('guest')->post('/test', 'CourseController@test_api')->name('subjects.add.api');

Route::middleware('guest')->get('/test/urls', 'CourseController@test_urls_api')->name('courses.test.urls.api');

Route::middleware('guest')->get('/get-yalda-time', function () {
    return new JsonResponse([
        'data' => yalda_time_remaining()
    ]);
})->name('get-yalda-time');

Route::middleware('guest')->get('/test-query', function (Request $request) {
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

Route::middleware('guest')->get('/main-page/courses', function (Request $request) {
    $onlyFree = $request->get('onlyFree');
    $sortingOrder = $request->get('sortingOrder');
    $libraries = $request->get('libraries');
    if (!$sortingOrder || !$libraries) {
        return new JsonResponse([
            'data' => [],
            'status' => 'forbidden'
        ]);
    }
    return new JsonResponse([
        'data' => [],
        'status' => 'success'
    ]);
})->name('main-page.courses.api');

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
