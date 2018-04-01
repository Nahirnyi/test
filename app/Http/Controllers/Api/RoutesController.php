<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\RouteRequest;
use App\Route;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;

class RoutesController extends Controller
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $routes = Route::all();

        return response()->json([
            compact('routes')
        ], Response::HTTP_OK);
    }

    /**
     * @param RouteRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(RouteRequest $request)
    {
        $route = new Route();
        $route->total_time = request('total_time');
        $route->ship_id = request('ship_id');
        $route->total_distance = request('total_distance');
        $route->average_speed = request('average_speed');
        $route->save();

        return response()->json([
            config('models.messages.message') => config('models.controllers.route.statuses.created'),
            compact('route')
        ], Response::HTTP_CREATED);
    }

    /**
     * @param Route $route
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Route $route)
    {
        return response()->json([
            compact('route')
        ], Response::HTTP_OK);
    }

    /**
     * @param Route $route
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(Route $route)
    {
        $route->delete();

        return response()->json([
            config('models.messages.message') => config('models.controllers.route.statuses.deleted')
        ], Response::HTTP_OK);
    }
}
