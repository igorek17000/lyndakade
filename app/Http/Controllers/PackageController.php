<?php

namespace App\Http\Controllers;

use App\Package;
use Illuminate\Http\Request;

class PackageController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return RedirectResponse|Response
     */
    public function index()
    {
        return view('packages.index', [
            // 'packages' => Package::all(),
            'packages' => [
                [
                    'id' => 1408,
                    'title' => 'هفتگی',
                    'days' => 7,
                    'count' => 10,
                    'price' => 160000,
                ],
                [
                    'id' => 1418,
                    'title' => 'هفتگی',
                    'days' => 7,
                    'count' => 17,
                    'price' => 260000,
                ],
                [
                    'id' => 1428,
                    'title' => 'ماهانه',
                    'days' => 30,
                    'count' => 20,
                    'price' => 300000,
                ],
                [
                    'id' => 1438,
                    'title' => 'ماهانه',
                    'days' => 30,
                    'count' => 35,
                    'price' => 500000,
                ],
                [
                    'id' => 1448,
                    'title' => 'سه ماهه',
                    'days' => 90,
                    'count' => 40,
                    'price' => 550000,
                ],
                [
                    'id' => 1458,
                    'title' => 'سه ماهه',
                    'days' => 90,
                    'count' => 50,
                    'price' => 650000,
                ],
                [
                    'id' => 1468,
                    'title' => 'شش ماهه',
                    'days' => 180,
                    'count' => 80,
                    'price' => 1000000,
                ],
                [
                    'id' => 1478,
                    'title' => 'شش ماهه',
                    'days' => 180,
                    'count' => 100,
                    'price' => 1200000,
                ],
                [
                    'id' => 1488,
                    'title' => 'سالانه',
                    'days' => 365,
                    'count' => 160,
                    'price' => 1900000,
                ],
                [
                    'id' => 1498,
                    'title' => 'سالانه',
                    'days' => 365,
                    'count' => 200,
                    'price' => 2200000,
                ],
            ]
        ]);
    }
}
