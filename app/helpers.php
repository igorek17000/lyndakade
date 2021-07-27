<?php

use App\CourseStatus;
use App\HashedData;
use App\Http\Controllers\CartController;
use App\LearnPath;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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

function get_course_state($course)
{
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
                foreach ($learn_path->courses as $current_course) {
                    if ($current_course->id == $course->id) {
                        $found = true;
                        break;
                    }
                }
            }
        }
    }

    if ($found) {
        $course_state = '1';
    } else {
        $course_state = (new CartController())->isAdded('1-' . $course->id) ? '2' : '3';
    }
    return $course_state;
}

function fromDLHost($path)
{
    if ($path == '')
        return '#';

    if ($json = json_decode($path))
        foreach ($json as $file)
            return "https://dl.lyndakade.ir/" . $file->download_link;

    if (strpos($path, 'http')) {
        return $path->replace('http:', 'https:');
    }
    return "https://dl.lyndakade.ir/" . $path;
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
    $lib = \App\Library::with(['software.courses', 'subjects.courses'])->find($id);
    if ($lib) {
        $ids = [];
        foreach ($lib->software as $soft) {
            foreach ($soft->courses as $course) {
                $ids[] = $course->id;
            }
        }
        foreach ($lib->subjects as $sub) {
            foreach ($sub->courses as $course) {
                $ids[] = $course->id;
            }
        }
        $ids = array_unique($ids);
        return \App\Course::whereIn('id', $ids)->get();
    }
    return collect([]);
}

function get_library_link($id)
{
    $lib = \App\Library::find($id);
    if ($lib)
        return route('home.show', [$lib->slug, $lib->id]);
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
    return 'بازاریابی آنلاین , لوگو , زیرنویس انگلیسی محصولات لیندا , graphic design , دانلود زیرنویس لیندا , فونت , photoshop brush , لیندا فارسی , زیرنویس فارسی لیندا , زیرنویس انگلیسیlynda , icons , آموزش فتوشاپ , subtitle , آموزش طراحی وب , computer graphic , کليپ آرت , دانلود آلبوم , farsi subtitle , آيکن , عکس , آموزش , lynda farsi , تجارت الکترونیک , vector art , دانلود رایگان آموزشهای لیندا , زیرنویس انگلیسی لیندا , آموزشهای lynda subtitle , زیرنویس آموزش لیندابرنامه نویسی , رایگان , gfx , پلاگين , فتوشاپ , آموزش وردپرس , فروش آنلاین , free clipart , free eps , گرافيک کامپيوتري , تصاوير بک گراند , دانلود رایگان , زیرنویس فارسی , دانلود فیلم آموزشی لیندا , سربرگ , آموزش فارسی , دانلود فیلم های آموزشی lynda , آموزش برنامه نویسی , بازاریابی ایمیلی , دوبله فارسی , آموزشهای لیندا , فیلم , لیندا دوبله فارسی , آموزش جاوا , آموزش ویدیویی , زیرنویس لیندا , آموزشهای لیندا با زیرنویس فارسی , دوبله لیندا , stock images , دانلود رایگان آموزشی , افترافکت , زیرنویس فارسی محصولات لیندا , دانلود فیلم های آموزشی لیندا , دانلود محصولات لیندا , دانلود لیندا با زیرنویس , آموزش برنامه نویسی ioslynda , آموزش php , persian , ترجمه لیندا , دانلود آموزش , free photo , ویدیو , دانلود براش , فارسی لیندا , logo , Lyndafarsi , اسليمي , graphic , جدیدترین آموزش های ویدیویی لیندا , آموزش زامارین , آموزش اینترنت اشیاء , vector , lynda subtitle , دانلود رایگان لیندا , گل , جدیدترین آموزشبازاریابی اینترنتی , آموزش asp.net , طراحي کارت , کسب و کار اینترنتی گرافيک , آموزش پایتون , آرم دانشگاه , ايلوستريتور , فیلم های آموزشی لیندا , cg , فارسی Lynda.com , لیندا زیرنویس , icon , photoshop , farsi , زیرنویس فیلمهای لیندا , download , دانلود , آموزش برنامه نویسی اندروید , وکتور , لیندا , آموزش های وبسایت لیندا به همراه زیرنویس';
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
