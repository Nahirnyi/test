<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\RouteRequest;
use App\Repositories\RouteRepository;
use App\Route;
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
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $routes = $this->routeRepository->all();

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
        $route = $this->routeRepository->add(request(['total_time', 'ship_id', 'total_distance', 'average_speed']));

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
        $this->routeRepository->delete($route);

        return response()->json([
            config('models.messages.message') => config('models.controllers.route.statuses.deleted')
        ], Response::HTTP_OK);
    }
}
