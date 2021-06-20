<?php

namespace App\Http\Controllers;

use App\Author;
use App\Course;
use App\LearnPath;
use App\Software;
use App\Subject;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Throwable;
use function Clue\StreamFilter\fun;

class SearchController extends Controller
{
    private function prepare_categories_filter_item(Request $request, $title, $search_key, $collection, $courses_id)
    {
        $item = [];
        $item['title'] = $title;
        $item['items'] = [];
        $item['key'] = $search_key;

        foreach ($collection as $subject) {
            $a = [];
            if ($subject->title) {
                $query = $_GET;
                $query[$search_key] = $subject->title;
                $query_result = $request->url() . '?' . http_build_query($query);
                $a['link'] = $query_result;
                $a['title'] = $subject->title;
            } else {
                $query = $_GET;
                $query[$search_key] = $subject->name;
                $query_result = $request->url() . '?' . http_build_query($query);
                $a['link'] = $query_result;
                $a['title'] = $subject->name;
            }
            $a['count'] = count($subject->courses->whereIn('id', $courses_id));
            array_push($item['items'], $a);
        }
        $item['hasMore'] = count($collection) > 5;

        usort($item['items'], function ($a, $b) {
            if ($a['count'] == $b['count']) {
                return 0;
            }
            return ($a['count'] > $b['count']) ? -1 : 1;
        });
        return $item;
    }

    /**
     * @param Request $request
     * @return Application|ResponseFactory|Response
     * @throws Throwable
     */
    public function show_search_page(Request $request)
    {
        $search_text = $request->has('q') ? $request->get('q') : '';

        $categories_filter = [];

        $courses = Course::query()
            ->where('title', 'LIKE', "%{$search_text}%")
            ->orWhere('titleEng', 'LIKE', "%{$search_text}%");

        $filter_items = [
            [
                'key' => 'subject',
                'model' => Subject::class,
                'model_column' => 'title',
                'table' => 'course_subject',
                'table_column' => 'subject_id',
            ],
            [
                'key' => 'software',
                'model' => Software::class,
                'model_column' => 'title',
                'table' => 'course_software',
                'table_column' => 'software_id',
            ],
            [
                'key' => 'author',
                'model' => Author::class,
                'model_column' => 'name',
                'table' => 'author_course',
                'table_column' => 'author_id',
            ],
        ];

        foreach ($filter_items as $filter_item) {
            if ($request->has($filter_item['key'])) {
                $subject = $filter_item['model']::query()
                    ->where($filter_item['model_column'], $request->get($filter_item['key']))
                    ->get()->first();
                if (!$subject)
                    dd($filter_item);
                $courses_id = [];
                $course_subject = DB::table($filter_item['table'])->where($filter_item['table_column'], $subject->id)->get();
                foreach ($course_subject as $course_sub) {
                    array_push($courses_id, $course_sub->course_id);
                }
                if (count($courses_id) > 0)
                    $courses->whereIn('id', $courses_id);
            }
        }

        $selected_skill_title = '';
        if (isset($_GET['skill'])) {
            switch ($_GET['skill']) {
                case 'Beginner':
                case '1':
                    $courses->where('skillLevel', 1);
                    $selected_skill_title = 'مبتدی';
                    break;
                case 'Intermediate':
                case '2':
                    $courses->where('skillLevel', 2);
                    $selected_skill_title = 'متوسط';
                    break;
                case 'Advanced':
                case '3':
                    $courses->where('skillLevel', 3);
                    $selected_skill_title = 'حرفه ای';
                    break;
            }
        }
        $courses = $courses
            ->orderByRaw('locate(\'' . $search_text . '\', titleEng, 1) ASC, titleEng ASC')
            ->get();

        $subjects_id = [];
        $softwares_id = [];
        $authors_id = [];
        $courses_id = [];

        foreach ($courses as $course) {
            array_push($courses_id, $course->id);
            foreach ($course->subjects as $item)
                array_push($subjects_id, $item->id);
            foreach ($course->softwares as $item)
                array_push($softwares_id, $item->id);
            foreach ($course->authors as $item)
                array_push($authors_id, $item->id);
        }
        $subjects_id = array_unique($subjects_id);
        $softwares_id = array_unique($softwares_id);
        $authors_id = array_unique($authors_id);
        $subjects_id = Subject::all()->whereIn('id', $subjects_id);
        $softwares_id = Software::all()->whereIn('id', $softwares_id);
        $authors_id = Author::all()->whereIn('id', $authors_id);
        $query = $_GET;
        $query['skill'] = 'Beginner';
        $beginner_link = $request->url() . '?' . http_build_query($query);
        $query['skill'] = 'Intermediate';
        $intermediate_link = $request->url() . '?' . http_build_query($query);
        $query['skill'] = 'Advanced';
        $advanced_link = $request->url() . '?' . http_build_query($query);
        array_push($categories_filter,
            [
                'title' => 'سطح',
                'items' => [
                    [
                        'title' => 'مبتدی',
                        'titleEng' => 'Beginner',
                        'link' => $beginner_link,
                        'count' => count($courses->where('skillLevel', 1)),
                    ],
                    [
                        'title' => 'متوسط',
                        'titleEng' => 'Intermediate',
                        'link' => $intermediate_link,
                        'count' => count($courses->where('skillLevel', 2)),
                    ],
                    [
                        'title' => 'حرفه ای',
                        'titleEng' => 'Advanced',
                        'link' => $advanced_link,
                        'count' => count($courses->where('skillLevel', 3)),
                    ],
                ],
                'hasMore' => false,
                'key' => 'skill',
            ]
        );
        array_push($categories_filter,
            $this->prepare_categories_filter_item($request, 'دسته ها', 'subject', $subjects_id, $courses_id)
        );
        array_push($categories_filter,
            $this->prepare_categories_filter_item($request, 'نرم افزار ها', 'software', $softwares_id, $courses_id)
        );
        array_push($categories_filter,
            $this->prepare_categories_filter_item($request, 'مدرسان', 'author', $authors_id, $courses_id)
        );

        $filtered_items_c = $_GET;
        unset($filtered_items_c['q']);
        if (isset($filtered_items_c['skill']))
            $filtered_items_c['skill'] = $selected_skill_title;

        $filtered_items = [];
        foreach ($filtered_items_c as $key => $filtered_item) {
            $a = [];
            $a['key'] = $key;
            $a['title'] = $filtered_item;
            $query = $_GET;
            unset($query[$key]);
            $query_result = $request->url() . '?' . http_build_query($query);
            $a['link'] = $query_result;

            array_push($filtered_items, $a);
        }

        return view('search.search', [
            'q' => $search_text,
            'filtered_items' => $filtered_items,
            'result_count' => count($courses),
            'courses' => count($courses) > 15 ? $courses->take(15) : $courses,
            'categories_filter' => $categories_filter,
        ]);
    }
}
