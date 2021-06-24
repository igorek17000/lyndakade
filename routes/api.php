<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('guest')->get('/subjects', 'SubjectController@subjects_api')->name('subjects.api');
Route::middleware('guest')->get('/software', 'SoftwareController@software_api')->name('software.api');
Route::middleware('guest')->get('/software/has-courses', 'SoftwareController@software_has_api')->name('software.api');
Route::middleware('guest')->post('/set-software', 'SoftwareController@set_software_api')->name('software.set.api');
Route::middleware('guest')->get('/courses/set/{id}', 'CourseController@courses_api_set')->name('courses.set.api');
Route::middleware('guest')->get('/courses', 'CourseController@courses_api')->name('courses.api');
Route::middleware('guest')->get('/courses/{id}', 'CourseController@course_api')->name('course.api');
Route::middleware('guest')->post('/courses/get-for-aparat', 'CourseController@course_api_get_for_aparat')->name('course.api.get-for-aparat');
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
Route::middleware('guest')->get('/views', 'DataController@views_api')->name('authors.api');

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
