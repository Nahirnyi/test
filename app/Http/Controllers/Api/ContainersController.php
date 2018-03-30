<?php

namespace App\Http\Controllers\Api;

use App\Container;
use App\Http\Requests\Api\ContainerRequest;
use App\Ship;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;

class ContainersController extends Controller
{
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
        $container = new Container();
        $container->name = request('name');
        $container->ship_id = $ship->id;
        $container->price = request('price');
        $container->save();

        return response()->json([
            'message' => 'Successfully created container!',
            compact('container')
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
            'message' => 'Successfully updated container!',
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
            'message' => 'Successfully deleted container!'
        ], Response::HTTP_OK);
    }
}
