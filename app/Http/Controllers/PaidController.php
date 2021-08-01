<?php

namespace App\Http\Controllers;

use App\Paid;
use App\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class PaidController extends Controller
{
    /**
     * return array of views for passed days
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function get_chart_price_data(Request $request)
    {
        return $this->get_chart_data($request, 'price');
    }

    /**
     * return array of views for passed days
     *
     * @param Request $request
     * @param $type
     * @return JsonResponse
     */
    private function get_chart_data(Request $request, $type)
    {
        $days = $request->get('days', 7);
        $response = array();

        $response['all_time_count'] = Paid::all()->count();

        $response['all_time_price'] = 0;
        foreach (Paid::all() as $item)
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
        return $this->get_chart_data($request, 'count');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

    public function isPaid($item_id, $user_id, $type)
    {
        if (!$user_id || !User::find($user_id)) {
            return false;
        }
        if (User::find($user_id)->isAdmin())
            return true;
        return Paid::where('user_id', $user_id)
            ->where('item_id', $item_id)
            ->where('type', $type)->count() > 0;
    }
}
