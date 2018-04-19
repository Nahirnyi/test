<?php

namespace App\Http\Controllers\Api\Ship;

use App\Http\Requests\Api\RouteRequest;
use App\Repositories\RouteRepository;
use App\Route;
use App\Ship;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;

class RoutesController extends Controller
{
    /**
     * @var RouteRepository
     */
    private $routeRepository;

    /**
     * RoutesController constructor.
     * @param RouteRepository $repository
     */
    public function __construct(RouteRepository $repository)
    {
        $this->routeRepository = $repository;
    }

    /**
     * @param Ship $ship
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Ship $ship)
    {
        $routes = $this->routeRepository->all($ship);

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
        $route = $this->routeRepository->add(request(['total_time', 'total_distance', 'average_speed']), $ship);

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
        $this->routeRepository->delete($route);

        return response()->json([
            config('models.messages.message') => config('models.controllers.route.statuses.deleted')
        ], Response::HTTP_OK);
    }
}
