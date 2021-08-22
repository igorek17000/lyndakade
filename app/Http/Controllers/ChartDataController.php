<?php

namespace App\Http\Controllers;

use App\View;
use App\Paid;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class ChartDataController extends Controller
{

    /**
     * return array of views for passed days
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function get_chart_price_data(Request $request)
    {
        return $this->get_chart_data_with_type($request, 'price');
    }

    /**
     * return array of views for passed days
     *
     * @param Request $request
     * @param $type
     * @return JsonResponse
     */
    private function get_chart_data_with_type(Request $request, $type)
    {
        $days = $request->get('days', 7);
        $response = array();

        $response['all_time_count'] = Paid::count();

        $response['all_time_price'] = 0;
        foreach (Paid::get('price') as $item)
            $response['all_time_price'] += $item->price;

        $i = $days;
        $listed_count = 0;
        $listed_price = 0;
        while ($i--) {
            $eventsForThisDay = DB::select('select * from paids' .
                ' where paids.created_at<"' . Carbon::tomorrow()->subDays($i)->toDateString() . '"' .
                ' and paids.created_at>="' . Carbon::today()->subDays($i)->toDateString() . '"');

            $data = array();
            $data['count'] = count($eventsForThisDay);
            $data['total'] = 0;
            foreach ($eventsForThisDay as $item)
                $data['total'] += $item->price;
            $listed_count += $data['count'];
            $listed_price += $data['total'];

            $response['data_count'][$days - $i] = $data['count'];
            $response['data_price'][$days - $i] = $data['total'];
            $response['label'][$days - $i] = Carbon::today()->subDays($i)->toDateString();
        }

        $response['total_count'] = $listed_count;
        $response['total_price'] = $listed_price;

        return response()->json($response);
    }

    /**
     * return array of views for passed days
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function get_chart_count_data(Request $request)
    {
        return $this->get_chart_data_with_type($request, 'count');
    }

    /**
     * return array of views for passed days
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function get_chart_data(Request $request)
    {
        $days = $request->get('days', 7);
        // $views = View::query()->whereDate('created_at', '>=', Carbon::today()->subDays($days));
        $response = array();
        $response['all_time'] = View::sum('views');
        $i = $days;
        $listed = 0;
        while ($i--) {
            $view = \App\View::firstWhere('date', Carbon::today()->subDays($i)->toDateString());
            if($view){
                $view = $view->views;
            }else{
                $view = 0;
            }
            $data = $view;
            $response['data'][$days - $i] = $data;
            $response['label'][$days - $i] = Carbon::today()->subDays($i)->toDateString();
//            $response['label'][$days - $i] = Carbon::today()->subDays($i)->dayName;
            $listed += $view;
        }
        $response['total'] = $listed;
        return response()->json($response);
    }
}
