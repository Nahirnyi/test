<?php

namespace App\Http\Controllers\Api\Ship;

use App\Http\Requests\Api\RouteRequest;
use App\Route;
use App\Ship;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;

class RoutesController extends Controller
{
    /**
     * @param Ship $ship
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Ship $ship)
    {
        $routes = $ship->routes()->get();

        return response()->json([
            compact('routes')
        ], Response::HTTP_OK);
    }

    /**
     * @param RouteRequest $request
     * @param Ship $ship
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(RouteRequest $request, Ship $ship)
    {
        $route = new Route();
        $route->total_time = request('total_time');
        $route->ship_id = $ship->id;
        $route->total_distance = request('total_distance');
        $route->average_speed = request('average_speed');
        $route->save();

        return response()->json([
            config('models.messages.message') => config('models.controllers.route.statuses.created'),
            compact('route')
        ], Response::HTTP_CREATED);
    }

    /**
     * @param Ship $ship
     * @param Route $route
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Ship $ship, Route $route)
    {
        return response()->json([
            compact('route')
        ], Response::HTTP_OK);
    }

    /**
     * @param Ship $ship
     * @param Route $route
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(Ship $ship, Route $route)
    {
        $route->delete();

        return response()->json([
            config('models.messages.message') => config('models.controllers.route.statuses.deleted')
        ], Response::HTTP_OK);
    }
}
