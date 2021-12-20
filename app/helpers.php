<?php

use App\Cart;
use App\Course;
use App\CourseStatus;
use App\Demand;
use App\HashedData;
use App\Http\Controllers\CartController;
use App\Http\Controllers\PaidController;
use App\LearnPath;
use App\Package;
use App\PackagePaid;
use App\Paid;
use App\UnlockedCourse;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

function yalda_time_remaining()
{
    // $to_date = Carbon::createFromFormat('Y-m-d H:s:i', '2021-12-25 00:00:00', 'GMT');
    $to_date = Carbon::createFromFormat('Y-m-d H:s:i', '2021-12-25 21:30:00', 'GMT')->tz('Asia/Tehran');
    $from_date = Carbon::now();
    $distance = $to_date->diffInMilliseconds($from_date);
    $days = floor($distance / (1000 * 60 * 60 * 24));
    $hours = floor(($distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    $minutes = floor(($distance % (1000 * 60 * 60)) / (1000 * 60));
    $seconds = floor(($distance % (1000 * 60)) / 1000);
    return $distance;
    return [
        'distance' => $distance,
        'days' => $days,
        'hours' => $hours,
        'minutes' => $minutes,
        'seconds' => $seconds,
    ];
}

function is_yalda_discount()
{
    return (yalda_time_remaining() > 0);
}

function get_course_price($course_price)
{
    if (is_yalda_discount()) {
        $off_percent = 25;
        $off_percent = (100 - $off_percent) / 100;
        return intval($course_price * $off_percent / 1000) * 1000;
    }
    return $course_price;
}
function prepare_course_file_name($filename)
{
    preg_match('/-\d{3,}.rar/', strtolower($filename), $matches);
    if ($matches) {
        return str_replace($matches[0], ".rar", $filename);
    }

    preg_match('/-\d{3,}.zip/', strtolower($filename), $matches);
    if ($matches) {
        return str_replace($matches[0], ".zip", $filename);
    }

    return $filename;
}

function number_of_courses_in_cart($carts)
{
    $res = 0;
    foreach ($carts as $cart) {
        if ($cart->course) {
            $res += 1;
        } else if ($cart->learn_path) {
            foreach (js_to_courses($cart->learn_path->_courses) as $c) {
                $res += 1;
            }
        }
    }
    return $res;
}

function end_date_of_available_package($user_id)
{
    $user_package_paid = PackagePaid::where('user_id', $user_id)
        ->where('end_date', '>=', now())
        ->first();

    // if has valid package for today
    if ($user_package_paid) {
        return Carbon::createFromTimestamp(strtotime($user_package_paid->end_date));
    }
    // no package paid is valid for today
    return null;
}


function number_of_available_package($user_id)
{
    $user_package_paid = PackagePaid::where('user_id', $user_id)
        ->where('end_date', '>=', now())
        ->first();

    // if has valid package for today
    if ($user_package_paid) {
        // get total unlocked count
        // $unlocked_count = UnlockedCourse::where('user_id', $user_id)
        //     ->where('created_at', '>=', $oldest_user_package->start_date)
        //     ->where('created_at', '<=', $latest_user_package->end_date)
        //     ->count();

        return $user_package_paid->count;
    }

    // no package paid is valid for today
    return -1;
}

function left_to_next_level()
{
    $total_paid_by_this_user = 0;
    foreach (auth()->user()->paids as $paid) {
        $total_paid_by_this_user += $paid->price;
    }

    if ($total_paid_by_this_user >= 1000000) {
        return 0;
    } else if ($total_paid_by_this_user >= 800000) {
        return 1000000 - $total_paid_by_this_user;
    } else if ($total_paid_by_this_user >= 600000) {
        return 800000 - $total_paid_by_this_user;
    } else if ($total_paid_by_this_user >= 400000) {
        return 600000 - $total_paid_by_this_user;
    } else if ($total_paid_by_this_user >= 200000) {
        return 400000 - $total_paid_by_this_user;
    }
    return 200000 - $total_paid_by_this_user;
}

function check_user_level_up()
{
    $total_paid_by_this_user = 0;
    foreach (auth()->user()->paids as $paid) {
        $total_paid_by_this_user += $paid->price;
    }

    if ($total_paid_by_this_user >= 1000000) {
        return 5;
    } else if ($total_paid_by_this_user >= 800000) {
        return 4;
    } else if ($total_paid_by_this_user >= 600000) {
        return 3;
    } else if ($total_paid_by_this_user >= 400000) {
        return 2;
    } else if ($total_paid_by_this_user >= 200000) {
        return 1;
    }
    return 0;
}

function percent_off_for_user()
{
    // $user_level = check_user_level_up();
    // return 1 - (0.05 * $user_level);
    $total_paid_by_this_user = 0;
    foreach (auth()->user()->paids as $paid) {
        $total_paid_by_this_user += $paid->price;
    }
    $res = 1;
    if ($total_paid_by_this_user >= 1000000) {
        $res = .75;
    } else if ($total_paid_by_this_user >= 800000) {
        $res = .8;
    } else if ($total_paid_by_this_user >= 600000) {
        $res = .85;
    } else if ($total_paid_by_this_user >= 400000) {
        $res = .9;
    } else if ($total_paid_by_this_user >= 200000) {
        $res = .95;
    }
    return $res;
}

function check_off_for_user(Int $amount)
{
    return intval($amount * percent_off_for_user() / 100) * 100;
}


function sendDemand(Demand $demand)
{
    $message = "new course request ON www.LyndaKade.ir";
    if ($demand->title && $demand->author) {
        $message .= "

Course Title: " . $demand->title . "
Course Author: " . $demand->author;
    } else {
        $message .= "

Link: $demand->link";
    }

    $message .=  "

Requested by " . $demand->user->name . " (user id: " . $demand->user->id . ")";

    $token = "1729049302:AAEMNCgF12whsXvjRoBvkKqssTxe4vTicBk";

    foreach ([
        '1601410204', // lyndakadeSupport
        '117727943', // hadi
    ] as $chat_id) {
        $data = [
            'text' => $message,
            'chat_id' => $chat_id
        ];

        file_get_contents("https://api.telegram.org/bot$token/sendMessage?" . http_build_query($data));
    }
    return $message;
}

function nPersian($string)
{
    $string = strval($string);
    if (is_numeric($string)) {
        $string = number_format($string);
    }

    $persian = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
    $english = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
    // $output = str_replace($persian, $english, $string);
    $output = str_replace($english, $persian, $string);
    return $output;
}

function create_hashed_data_if_not_exists($data)
{
    $hashed_data = HashedData::firstWhere('data', $data);
    $hashed = hash('sha256', $data);
    if (!$hashed_data) {
        $hashed_data = new HashedData();
        $hashed_data->data = $data;
        $hashed_data->hashed = $hashed;
        $hashed_data->save();
    }
    return $hashed;
}

function js_to_courses($courses)
{
    return $courses;
    $js_courses = json_decode($courses);
    $res = array();
    foreach ($js_courses as $c) {
        $course_id = $c->id;
        $course = Course::find($course_id);
        if ($course) {
            array_push($res, $course);
        }
    }
    return $res;
}

function formatBytes($bytes, $precision = 2)
{
    $units = array('B', 'KB', 'MB', 'GB', 'TB');
    $bytes = max($bytes, 0);
    $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
    $pow = min($pow, count($units) - 1);

    // Uncomment one of the following alternatives
    $bytes /= pow(1024, $pow);
    // $bytes /= (1 << (10 * $pow));

    return round($bytes, $precision) . ' ' . $units[$pow];
}

function zerofill($num, $zerofill = 2)
{
    return str_pad($num, $zerofill, '0', STR_PAD_LEFT);
}

function courseURL($course)
{
    // return route('courses.show.linkedin', [$course->slug_linkedin]);
    if ($course->slug_linkedin) {
        return route('courses.show.linkedin', [$course->slug_linkedin]);
    }
    if ($course->slug && $course->slug_url && $course->id) {
        return route('courses.show', [$course->slug_url, $course->slug, $course->id]);
    }
    return '#';
}

function get_learn_path_state($path)
{
    $user_id = auth()->id();
    if ($path->price() == 0) {
        $path_state = '3';
    } elseif ((new PaidController)->isPaid($path->id, $user_id, '2')) {
        $path_state = '3';
    } elseif (UnlockedCourse::where('user_id', $user_id)->where('learn_path_id', $path->id)->first()) {
        $path_state = '3';
    } else {
        $path_state = (new CartController())->isAdded('2-' . $path->id) ? '2' : '1';
    }
    // 1 show add button, 2 show remove button, 3 has been paid
    return $path_state;
}

function get_course_state($course)
{
    if (!Auth::check()) {
        return "3";
    }
    $user_id = auth()->id();
    if (Auth::user()->role->id == TCG\Voyager\Models\Role::firstWhere('name', 'admin')->id)
        return "1";
    $found = false;
    if (Auth::check()) {
        foreach (Auth::user()->paids as $paid) {
            if ($found) {
                break;
            }
            if ($paid->type == '1') {
                if ($paid->item_id == $course->id) {
                    $found = true;
                    break;
                }
            } else {
                $learn_path = LearnPath::find($paid->item_id);
                if ($learn_path) {
                    foreach (js_to_courses($learn_path->_courses) as $current_course) {
                        if ($current_course->id == $course->id) {
                            $found = true;
                            break;
                        }
                    }
                }
            }
        }


        if (
            !$found && UnlockedCourse::where('user_id', $user_id)
            ->where('course_id', $course->id)
            ->first()
        ) {
            $found = true;
        }

        $found2 = false;
        $user_unlocked_courses = UnlockedCourse::where('user_id', $user_id)->whereNotNull('learn_path_id')->get();
        foreach ($user_unlocked_courses as $user_unlocked_course) {
            foreach (js_to_courses(LearnPath::find($user_unlocked_course->learn_path_id)->_courses) as $learn_path_course) {
                if ($course->id == $learn_path_course->id)
                    $found2 = true;
            }
        }

        if (!$found && $found2) {
            $found = true;
        }
    }

    if ($found) {
        $course_state = '1';
    } else {
        $course_state = (new CartController())->isAdded('1-' . $course->id) ? '2' : '3';
    }
    return $course_state;
}

function urlencoding($url)
{
    // Add your custom encoding
    $entities = ['%3A', '%27', '%2F', '%3F'];
    $replacements = [":", "'", "/", "?"];

    $entities = ["#", "'"];
    $replacements = ["%23", "%27"];
    return str_replace($entities, $replacements, $url);
}

function fromDLHost($path)
{
    if ($path == '')
        return '#';

    if ($json = json_decode($path))
        foreach ($json as $file) {
            $path = str_replace("\\", "/", $file->download_link);
            return urlencoding("https://dl.lyndakade.ir/" . $path);
        }
    $path = str_replace("\\", "/", $path);
    if (strpos($path, 'http')) {
        return urlencoding($path->replace('http:', 'https:'));
    }
    return urlencoding("https://dl.lyndakade.ir/" . $path);
}

function get_number_of_authors_has_at_least_one_course()
{
    return \App\Author::has('courses')->get()->count();
}

function get_sum_of_all_courses_time()
{
    return \App\Course::sum('durationMinutes') + (\App\Course::sum('durationHours') * 60);
}

function get_sum_of_all_courses_part_numbers()
{
    return \App\Course::sum('partNumbers');
}

function get_number_of_all_courses()
{
    return \App\Course::count();
}

function get_number_of_all_paths()
{
    return \App\LearnPath::count();
}

function get_course_status($id)
{
    $course_state = CourseStatus::find($id);
    if ($course_state) {
        return $course_state->name;
    }
    return 'پیدا نشد';
}

function get_course_status_state($id)
{
    if (get_course_status($id) == 'دارد') {
        return true;
    }
    return false;
}

function get_courses_for_library($id)
{
    $lib = \App\Library::with(['subjects.courses'])->find($id);
    if ($lib) {
        $ids = [];
        foreach ($lib->subjects as $sub) {
            foreach ($sub->courses as $course) {
                $ids[] = $course->id;
            }
        }
        $ids = array_unique($ids);
        return \App\Course::orderBy('releaseDate', 'desc')->whereIn('id', $ids)->limit(4)->get();
    }
    return collect([]);
}

function get_library_link($id)
{
    $lib = \App\Library::find($id);
    if ($lib)
        return route('home.show', [$lib->slug]);
    return '#';
}


function date_get_seo_title($coursetype)
{
    if ($coursetype === 'newest') {
        return 'جدید ترین دوره های آموزشی';
    } elseif ($coursetype === 'best') {
        return 'محبوب ترین دوره های آموزشی';
    }
    return 'دوره های آموزشی رایگان';
}

function date_get_seo_title_eng($coursetype)
{
    if ($coursetype === 'newest') {
        return 'New Courses';
    } elseif ($coursetype === 'best') {
        return 'Popular Courses';
    }
    return 'Free Courses';
}

function date_get_seo_keywords($coursetype)
{
    if ($coursetype === 'newest') {
        return ' , جدید ترین دوره های آموزشی , ' . join(', ', explode(' ', 'جدید ترین دوره های آموزشی'));
    } elseif ($coursetype === 'best') {
        return ' , محبوب ترین دوره های آموزشی ,' . join(', ', explode(' ', 'جدید ترین دوره های آموزشی'));
    }
    return ' , دوره های آموزشی رایگان , ' . join(', ', explode(' ', 'دوره های آموزشی رایگان'));
}
function div($a, $b)
{
    return (int) ($a / $b);
}

function get_seo_keywords()
{
    $text = ", دانلود رايگان مجموعه ليندا, دانلود زيرنويس آموزش هاي ليندا, آموزش زبان انگليسي ليندا, دانلود آموزش با زيرنويس فارسي, دانلود از يودمي, زيرنويس فارسي محصولات ليندا, اپ ليندا, آموزش برنامه نويسي با زيرنويس فارسي, کد تخفيف فارسي ليندا, زيرنويس فارسي محصولات ليندا, دانلود رايگان مجموعه ليندا, فيلم آموزشي دوبله فارسي, آموزش زبان انگليسي ليندا, آموزش هاي udemy با زيرنويس فارسي, دانلود آموزش با زيرنويس فارسي, دانلود آموزش پايتون ليندا, کد تخفيف فارسي ليندا, دانلود زيرنويس فارسي lynda, دانلود زيرنويس آموزش هاي ليندا, آموزش هاي udemy با زيرنويس فارسي, دانلود آموزش با زيرنويس فارسي, فيلم آموزشي دوبله فارسي, آموزش موهو ليندا, آموزش عکاسي ليندا دوبله فارسي, آموزش زبان انگليسي ليندا, دانلود رايگان آموزش هاي ليندا, آموزش پايتون ليندا دوبله فارسي, دانلود زيرنويس فارسي lynda, زيرنويس فارسي محصولات ليندا, دانلود رايگان مجموعه ليندا, کد تخفيف فارسي ليندا, دانلود آموزش پايتون ليندا, دانلود آموزش پايتون ليندا, يودمي فارسي, آموزش هاي udemy با زيرنويس فارسي, دانلود رايگان مجموعه ليندا, آموزش زبان انگليسي ليندا, زيرنويس فارسي محصولات ليندا, آموزش پايتون ليندا دوبله فارسي, فيلم آموزشي دوبله فارسي, آموزش زبان انگليسي ليندا, دانلود رايگان مجموعه ليندا, اپ ليندا, يودمي فارسي, آموزش هاي udemy با زيرنويس فارسي, آموزش عکاسي ليندا دوبله فارسي, آموزش پايتون ليندا دوبله فارسي, درباره سايت ليندا, دانلود آموزش فتوشاپ با زيرنويس فارسي, دوره جامع فتوشاپ, قيمت پکيج آموزش فتوشاپ, دانلود زيرنويس فارسي آموزش هاي ليندا, دوره کامل فتوشاپ, آموزش زبان انگليسي ليندا, کاملترين آموزش فتوشاپ, پکيج آموزش فتوشاپ رايگان, دانلود زيرنويس آموزش هاي ليندا, زيرنويس فارسي محصولات ليندا, کد تخفيف فارسي ليندا, آموزش برنامه نويسي با زيرنويس فارسي, دانلود رايگان مجموعه ليندا, آموزش زبان انگليسي ليندا, اپ ليندا, درباره سايت ليندا, آموزش گام به گام لينکدين, دوره هاي لينکدين, آموزش حرفه اي لينکدين, دانلود رايگان کتاب آموزش لينکدين, آزمون هاي لينکدين, دانلود آموزش هاي لينکدين, کار با لينکدين, آموزش صفر تا صد لينکدين, آموزش حرفه اي لينکدين, آزمون هاي لينکدين, آموزش صفر تا صد لينکدين, آموزش گام به گام لينکدين, دانلود رايگان کتاب آموزش لينکدين, دانلود آموزش هاي لينکدين, دوره آموزشي لينکدين تخصصي, کار با لينکدين, linkedin courses with certificates, linkedin courses login, linkedin courses free, linkedin courses or certifications, linkedin courses free download, best linkedin courses, popular linkedin courses, linkedin free courses with certificate, linkedin free courses with certificate, free linkedin learning courses 2021, linkedin courses free download, linkedin courses with certificates, linkedin free courses 2021, linkedin free courses 2020, linkedin learning free courses 2020, linkedin learning free for students, linkedin free courses with certificates, linkedin courses with certificates, linkedin learning free for students, linkedin learning courses list, linkedin free courses 2020, free linkedin learning courses 2020, linkedin learning courses free download, best linkedin learning courses, linkedin free courses 2021, free linkedin learning courses 2021, linkedin courses with certificates, linkedin learning courses free download, how to get linkedin learning certificate for free, linkedin learning free for students, linkedin learning free courses covid, linkedin learning login, سايت لينکدين, دانلود رايگان از لينکدين, دانلود رايگان دوره هاي لينکدين, مسيرهاي آموزشي لينکدين, مسيرهاي آموزشي ليندا, مسيرهاي يادگيري لينکدين, مسيرهاي يادگيري ليندا";
    $text .= ", بازاریابی آنلاین , زیرنویس انگلیسی محصولات لیندا , graphic design , دانلود زیرنویس لیندا , photoshop brush , لیندا فارسی , زیرنویس فارسی لیندا , زیرنویس انگلیسی lynda , آموزش فتوشاپ , آموزش طراحی وب , computer graphic , farsi subtitle , آموزش , lynda farsi , تجارت الکترونیک , vector art , دانلود رایگان آموزشهای لیندا , زیرنویس انگلیسی لیندا , آموزشهای lynda subtitle , زیرنویس آموزش لیندا برنامه نویسی , رایگان , gfx , پلاگين , فتوشاپ , آموزش وردپرس , فروش آنلاین , دانلود رایگان , زیرنویس فارسی , دانلود فیلم آموزشی لیندا , آموزش فارسی , دانلود فیلم های آموزشی lynda , آموزش برنامه نویسی , بازاریابی ایمیلی , دوبله فارسی , آموزشهای لیندا , لیندا دوبله فارسی , آموزش جاوا , آموزش ویدیویی , زیرنویس لیندا , آموزشهای لیندا با زیرنویس فارسی , دوبله لیندا , دانلود رایگان آموزشی , زیرنویس فارسی محصولات لیندا , دانلود فیلم های آموزشی لیندا , دانلود محصولات لیندا , دانلود لیندا با زیرنویس , آموزش برنامه نویسی ioslynda , آموزش php , ترجمه لیندا , دانلود آموزش , فارسی لیندا , Lyndafarsi , جدیدترین آموزش های ویدیویی لیندا , آموزش زامارین , آموزش اینترنت اشیاء , vector , lynda subtitle , دانلود رایگان لیندا , جدیدترین آموزش بازاریابی اینترنتی , آموزش asp.net , طراحي کارت , کسب و کار اینترنتی گرافيک , آموزش پایتون , ايلوستريتور , فیلم های آموزشی لیندا , فارسی Lynda.com , لیندا زیرنویس , زیرنویس فیلمهای لیندا , آموزش برنامه نویسی اندروید , لیندا , آموزش های وبسایت لیندا به همراه زیرنویس";
    $text .= ", مغدیشنشیث , gdknh;ni";
    $text .= ", لیندا فارسی , lynda farsi , farsilynda , سایت لیندا , فارسی لیندا , ";
    return $text;
}

function get_seo_description()
{
    return 'لیندا کده | یکی از بروزترین وبسایت های آموزشی | دانلود ویدیوهای آموزشی لیندا با زیرنویس فارسی و انگلیسی و دوبله + برخی رایگان';
}

function gregorian_to_jalali($g_y, $g_m, $g_d, $str)
{
    $g_days_in_month = array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
    $j_days_in_month = array(31, 31, 31, 31, 31, 31, 30, 30, 30, 30, 30, 29);


    $gy = $g_y - 1600;
    $gm = $g_m - 1;
    $gd = $g_d - 1;

    $g_day_no = 365 * $gy + div($gy + 3, 4) - div($gy + 99, 100) + div($gy + 399, 400);

    for ($i = 0; $i < $gm; ++$i)
        $g_day_no += $g_days_in_month[$i];
    if ($gm > 1 && (($gy % 4 == 0 && $gy % 100 != 0) || ($gy % 400 == 0)))
        /* leap and after Feb */
        $g_day_no++;
    $g_day_no += $gd;

    $j_day_no = $g_day_no - 79;

    $j_np = div($j_day_no, 12053); /* 12053 = 365*33 + 32/4 */
    $j_day_no = $j_day_no % 12053;

    $jy = 979 + 33 * $j_np + 4 * div($j_day_no, 1461); /* 1461 = 365*4 + 4/4 */

    $j_day_no %= 1461;

    if ($j_day_no >= 366) {
        $jy += div($j_day_no - 1, 365);
        $j_day_no = ($j_day_no - 1) % 365;
    }

    for ($i = 0; $i < 11 && $j_day_no >= $j_days_in_month[$i]; ++$i)
        $j_day_no -= $j_days_in_month[$i];
    $jm = $i + 1;
    $jd = $j_day_no + 1;
    if ($str) return $jy . '/' . $jm . '/' . $jd;
    return array($jy, $jm, $jd);
}

function jalali_to_gregorian($j_y, $j_m, $j_d, $str)
{
    $g_days_in_month = array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
    $j_days_in_month = array(31, 31, 31, 31, 31, 31, 30, 30, 30, 30, 30, 29);


    $jy = (int)($j_y) - 979;
    $jm = (int)($j_m) - 1;
    $jd = (int)($j_d) - 1;

    $j_day_no = 365 * $jy + div($jy, 33) * 8 + div($jy % 33 + 3, 4);

    for ($i = 0; $i < $jm; ++$i)
        $j_day_no += $j_days_in_month[$i];

    $j_day_no += $jd;

    $g_day_no = $j_day_no + 79;

    $gy = 1600 + 400 * div($g_day_no, 146097); /* 146097 = 365*400 + 400/4 - 400/100 + 400/400 */
    $g_day_no = $g_day_no % 146097;

    $leap = true;
    if ($g_day_no >= 36525) /* 36525 = 365*100 + 100/4 */ {
        $g_day_no--;
        $gy += 100 * div($g_day_no,  36524); /* 36524 = 365*100 + 100/4 - 100/100 */
        $g_day_no = $g_day_no % 36524;

        if ($g_day_no >= 365)
            $g_day_no++;
        else
            $leap = false;
    }

    $gy += 4 * div($g_day_no, 1461); /* 1461 = 365*4 + 4/4 */
    $g_day_no %= 1461;

    if ($g_day_no >= 366) {
        $leap = false;

        $g_day_no--;
        $gy += div($g_day_no, 365);
        $g_day_no = $g_day_no % 365;
    }

    for ($i = 0; $g_day_no >= $g_days_in_month[$i] + ($i == 1 && $leap); $i++)
        $g_day_no -= $g_days_in_month[$i] + ($i == 1 && $leap);
    $gm = $i + 1;
    $gd = $g_day_no + 1;
    if ($str) return $gy . '/' . $gm . '/' . $gd;
    return array($gy, $gm, $gd);
}

/*
function comparedate($_date_mix_jalaly,$_date_mix_gregorian)
{
  $_date_arr_jalaly = explode('/', $_date_mix_jalaly);
  $_date_arr_gregorian = explode('/', $_date_mix_gregorian);

  $arr_jtg = jalali_to_gregorian($_date_arr_jalaly[0],$_date_arr_jalaly[1],$_date_arr_jalaly[2]);

  if($_date_arr_gregorian[0]> $arr_jtg[0])
    {
	 return  false;
	}

	else if($_date_arr_gregorian[0]== $arr_jtg[0] && $_date_arr_gregorian[1]>$arr_jtg[1])
	{
	 return false;
	}
	else if($_date_arr_gregorian[0]== $arr_jtg[0] && $_date_arr_gregorian[1]==$arr_jtg[1] && $_date_arr_gregorian[2]>$arr_jtg[2])
	{
	 return false;
	}
  return true ;
}
*/
