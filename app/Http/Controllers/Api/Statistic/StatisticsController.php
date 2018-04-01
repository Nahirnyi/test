<?php

namespace App\Http\Controllers\Api\Statistic;

use App\Route;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;

class StatisticsController extends Controller
{
    public function index()
    {
        if (request('stat'))
        {
            if (request('stat') == 'latest')
            {
                $routes = Route::latest()->take(5)->get();
            }

            if (request('stat') == 'longest')
            {
                $routes = Route::orderBy('total_distance', 'desc')->take(5)->get();
            }

            if (request('stat') == 'max_average_speed')
            {
                $routes = Route::orderBy('average_speed', 'desc')->take(5)->get();
            }
        }

        return response()->json([
            compact('routes')
        ], Response::HTTP_OK);
    }
}
