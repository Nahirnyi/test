<?php

namespace App\Http\Controllers\Api\Statistic;

use App\Route;
use function Couchbase\defaultDecoder;
use http\Env\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use JWTAuth;

class StatisticsController extends Controller
{
    public function show(string $key)
    {
        $query = Route::query();

        switch ($key) {
            case 'latest' :
                $query->latest();
                break;
            case 'longest' :
                $query->oldest('total_distance');
                break;
            case 'max_average_speed' :
                $query->latest('average_speed');
            default :
                $query->latest();
                break;
        }

        $routes = $query->take(5)->get();

        return response()->json([
            'routes' => $routes
        ], Response::HTTP_OK);
    }
}
