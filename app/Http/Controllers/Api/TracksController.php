<?php

namespace App\Http\Controllers\Api;

use App\Route;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;

class TracksController extends Controller
{
    /**
     * @param Route $route
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Route $route)
    {
        $tracks = $route->tracks()->get();

        return response()->json([
            compact('tracks')
        ], Response::HTTP_OK);
    }
}
