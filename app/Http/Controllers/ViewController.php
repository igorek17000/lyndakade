<?php

namespace App\Http\Controllers;

use App\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class ViewController extends Controller
{
    /**
     * return array of views for passed days
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function get_chart_data(Request $request)
    {
        $days = $request->get('days', 7);
        $views = View::query()->whereDate('created_at', '>=', Carbon::today()->subDays($days));
        $response = array();
        $response['all_time'] = View::all()->count();
        $i = $days;
        $listed = 0;
        while ($i--) {
            $eventsForThisDay = DB::select('select * from views' .
                ' where views.created_at<"' . Carbon::tomorrow()->subDays($i)->toDateString() . '"' .
                ' and views.created_at>="' . Carbon::today()->subDays($i)->toDateString() . '"');
            $data = count($eventsForThisDay);
            $response['data'][$days - $i] = $data;
            $response['label'][$days - $i] = Carbon::today()->subDays($i)->toDateString();
//            $response['label'][$days - $i] = Carbon::today()->subDays($i)->dayName;
            $listed += count($eventsForThisDay);
        }
        $response['total'] = $listed;
        return response()->json($response);
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
     * @param Request $request
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
     * @param Request $request
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
}
