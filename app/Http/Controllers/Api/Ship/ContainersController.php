<?php

namespace App\Http\Controllers\Api\Ship;

use App\Container;
use App\Http\Requests\Api\ContainerRequest;
use App\Ship;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use JWTAuth;

class ContainersController extends Controller
{
    /**
     * ContainersController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth.jwt')->except(['index', 'show']);
    }

    /**
     * @param Ship $ship
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Ship $ship)
    {
        $containers = $ship->containers()->get();

        return response()->json([
            compact('containers')
        ], Response::HTTP_OK);
    }

    /**
     * @param Ship $ship
     * @param ContainerRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Ship $ship, ContainerRequest $request)
    {
        $user = JWTAuth::parseToken()->toUser();

        $container = new Container();
        $container->name = request('name');
        $container->ship()->associate($ship);
        $container->price = request('price');
        $container->save();

        return response()->json([
            config('models.messages.message') => config('models.controllers.container.statuses.created'),
            compact('container', 'user')
        ], Response::HTTP_CREATED);
    }

    /**
     * @param Ship $ship
     * @param Container $container
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Ship $ship, Container $container)
    {
        return response()->json([
            compact('container')
        ], Response::HTTP_OK);
    }

    /**
     * @param ContainerRequest $request
     * @param Ship $ship
     * @param Container $container
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(ContainerRequest $request, Ship $ship, Container $container)
    {
        $container->name = request('name');
        $container->ship_id = $ship->id;
        $container->price = request('price');
        $container->save();

        return response()->json([
            config('models.messages.message') => config('models.controllers.container.statuses.updated'),
            compact('container')
        ], Response::HTTP_OK);
    }

    /**
     * @param Ship $ship
     * @param Container $container
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(Ship $ship, Container $container)
    {
        $container->delete();

        return response()->json([
            config('models.messages.message') => config('models.controllers.container.statuses.deleted')
        ], Response::HTTP_OK);
    }
}
