<?php

use App\Course;
use App\Http\Controllers\CourseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;
use TCG\Voyager\Facades\Voyager;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('email/verify', 'Auth\VerificationController@show')->name('verification.notice');
// Route::get('email/verify/{id}', 'Auth\VerificationController@verify')->name('verification.verify');
// Route::get('email/resend', 'Auth\VerificationController@resend')->name('verification.resend');

Auth::routes();


Route::get('/{slug}/{$id}-0.html', function ($slug, $id) {
    return redirect()->route('root.home')->with('error', 'hey there');

    $slug = str_replace("-training-tutorials", "", $slug);
    $slug = str_replace("-tutorials", "", $slug);
    $title = str_replace("-", " ", $slug);

    $lib = \App\Library::where('slug', $slug)->orWhere('id', $id)->orWhere('titleEng', $title)->first();
    if ($lib) {
        return redirect()->route('home.show', [$lib->slug]);
    }
    $sub = \App\Subject::where('slug', $slug)->orWhere('id', $id)->orWhere('titleEng', $title)->first();
    if ($sub) {
        return redirect()->route('home.show', [$sub->slug]);
    }
    $aut = \App\Author::where('slug', $slug)->orWhere('id', $id)->orWhere('name', $title)->first();
    if ($aut) {
        return redirect()->route('authors.show', [$sub->slug]);
    }
    return redirect()->route('search', ['q' => $slug]);
})->name('home.show.alternate');


Route::get('/tests', function () {
    return response()->view('test', []);
});

Route::get('/faq', function () {
    return response()->view('faq', []);
})->name('faq');

Route::get('/packages', 'PackageController@index')->name('packages.index');

Route::group(
    ['middleware' => 'auth'],
    function () {
        Route::get('/packages/unlockcourses', 'PackageController@unlock_courses')->name('packages.unlock_courses');
        Route::get('/packages/payment', 'PackageController@payment')->name('packages.payment');
        Route::get('/packages/callback', 'PackageController@callback')->name('packages.callback');
    }
);

// learning paths
Route::get('/learning-paths/', 'LearnPathController@index')->name('learn.paths.index');
Route::get('/learning/paths/{learn_path_slug}', 'LearnPathController@show')->name('learn.paths.show');
// "see all" button, for each library, in navbar
// Route::get('/learning/paths/{library_slug}', 'LearnPathController@show_category')->name('learn.paths.show_category');

Route::get('/learning/courses/newest', 'CourseController@newest')->name('courses.newest');
Route::get('/learning/courses/best', 'CourseController@best')->name('courses.best');
Route::get('/learning/courses/free', 'CourseController@free')->name('courses.free');

// courses
Route::get('/', 'CourseController@index')->name('root.home');
Route::get('/{slug_url}/{slug}/{id}-2.html', function (Illuminate\Http\Request $request, $slug_url, $slug, $id) {
    $course = Course::firstWhere('id', $id);
    if ($course) {
        if ($course->slug_linkedin) {
            return redirect()->route('courses.show.linkedin', [$course->slug_linkedin]);
        }
        return (new CourseController)->show($request, $slug_url, $slug, $id);
        // return redirect()->route('courses.show', [$course->slug_url, $course->slug, $course->id]);
    }

    $course = Course::firstWhere('slug', $slug);
    if ($course) {
        if ($course->slug_linkedin) {
            return redirect()->route('courses.show.linkedin', [$course->slug_linkedin]);
        }
        return (new CourseController)->show($request, $slug_url, $slug, $id);
        // return redirect()->route('courses.show', [$course->slug_url, $course->slug, $course->id]);
    }
    // abort(404);
    return redirect()->route('root.home')->with('error', 'صفحه مورد نظر یافت نشد.');
})->name('courses.show');
Route::get('/learning/{slug_linkedin}', 'CourseController@show_linkedin')->name('courses.show.linkedin');
Route::get('/learning/{slug_linkedin}/{video_slug}', 'CourseController@show_linkedin')->name('courses.show.linkedin.video');
Route::get('/ajax/player/transcript', 'CourseController@subtitle_content')->name('courses.subtitle_content');
Route::get('courses/download/{id}', 'CourseController@download_course')->name('courses.download');
Route::post('/report-issues/courses', 'CourseController@report_issues')->name('courses.report-issues');
Route::get('/c/{id}', function ($id) {
    $course = Course::firstWhere('id', $id);
    if ($course) {
        if ($course->slug_linkedin) {
            return redirect()->route('courses.show.linkedin', [$course->slug_linkedin]);
        }
        return redirect()->route('courses.show', [$course->slug_url, $course->slug, $course->id]);
    }
    // abort(404);
    return redirect()->route('root.home')->with('error', 'صفحه مورد نظر یافت نشد.');
})->name('courses.show.short');

// Route::get('authors/json', 'HomeController@json_data_authors')->name('authors.json');
// Route::get('courses/json', 'HomeController@json_data_courses')->name('courses.json');
// Route::get('learn-paths/json', 'HomeController@json_data_learn_paths')->name('learn.paths.json');
// Route::get('libraries/json', 'HomeController@json_data_libraries')->name('libraries.json');
// Route::get('software/json', 'HomeController@json_data_software')->name('software.json');
// Route::get('subjects/json', 'HomeController@json_data_subjects')->name('subjects.json');


// authors
Route::get('/authors', 'AuthorController@index')->name('authors.index');
Route::get('/instructors/{slug}', 'AuthorController@show')->name('authors.show');


// subjects & software & libraries
Route::get('/topics/{slug}', 'HomeController@show')->name('home.show');


// needs to be logged in, for request course
Route::group(['middleware' => 'auth'], function () {
    Route::name('demands.')->group(function () {
        Route::get('/request-course', 'DemandController@create')->name('create');
        Route::post('/request-course', 'DemandController@store')->name('store');
    });
});

// logging with google account
Route::get('auth/google', 'Auth\LoginController@redirectToGoogle')->name('login.google');
Route::get('auth/google/callback', 'Auth\LoginController@handleGoogleCallback')->name('login.google.callback');

Route::get('/contact-us', 'HomeController@contact_us')->name('root.contact.us');
Route::post('/contact-us', 'HomeController@contact_us_post')->name('root.contact.us.post');
Route::get('/search', 'HomeController@search_page')->name('search');

Route::group(['middleware' => 'auth'], function () {
    Route::name('cart.')->group(function () {
        Route::get('/cart/', 'CartController@index')->name('index');
        Route::post('/cart/', 'CartController@index')->name('index');
        Route::post('/cart/add', 'CartController@add')->name('add');
        Route::post('/cart/remove', 'CartController@remove')->name('remove');
        Route::post('/cart/remove/all', 'CartController@remove_all')->name('remove_all');
    });

    Route::get('payment/send', 'CartController@send_to_pay')->name('payment.send');
    Route::post('payment/redirect', 'CartController@redirect')->name('payment.redirect');
    Route::get('payment/callback', 'CartController@pay_callback')->name('payment.callback');

    Route::get('my-courses', 'ProfileController@my_courses')->name('courses.mycourses');
});


//Route::fallback(function () {
//    $course = new CourseController();
//    return $course->not_found();
//});
Route::fallback('CourseController@not_found');

// Route::view('/contactUs', 'contactUs')->name('');

// Route::view('/aboutUs', 'aboutUs');

// Route::view('/payment', 'payment');

// get data for charts in admin dashboard
Route::post('data/get-views-for-days', 'ChartDataController@get_chart_data')->name('views.data');
Route::post('data/get-purchases-count-for-days', 'ChartDataController@get_chart_count_data')->name('purchases.count.data');
Route::post('data/get-purchases-price-for-days', 'ChartDataController@get_chart_price_data')->name('purchases.price.data');

Route::get('profile', 'UserController@my_profile')->name('my-profile');
Route::get('profile/edit', 'UserController@edit')->name('my-profile.edit');
Route::post('profile/edit', 'UserController@update')->name('my-profile.update');

Route::post('users/username/check', 'UserController@username_check')->name('users.username-check');

Route::get('/454247.txt', function () {
    $fileText = "";
    $myName = "454247.txt";
    $headers = [
        'Content-type' => 'text/plain',
        'Content-Disposition' => sprintf('attachment; filename="%s"', $myName),
        'Content-Length' => strlen($fileText)
    ];
    return response()->make($fileText, 200, $headers);
});

Route::get('/sitemap.xml', 'SiteMapController@sitemap');

Route::get('/sitemap-authors.xml', 'SiteMapController@sitemap_authors');

Route::get('/sitemap-partials.xml', 'SiteMapController@sitemap_partials');

Route::get('/sitemap-subjects.xml', 'SiteMapController@sitemap_subjects');

Route::get('/sitemap-courses-{year}-{month}.xml', 'SiteMapController@sitemap_courses');

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
