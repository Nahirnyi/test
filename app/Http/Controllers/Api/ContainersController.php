<?php

namespace App\Http\Controllers\Api;

use App\Container;
use App\Http\Requests\Api\ContainerRequest;
use App\Repositories\ContainerRepository;
use App\Ship;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;

class ContainersController extends Controller
{
    /**
     * @var ContainerRepository
     */
    private $containerRepository;

    /**
     * ContainersController constructor.
     * @param ContainerRepository $repository
     */
    public function __construct(ContainerRepository $repository)
    {
        $this->containerRepository = $repository;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $containers = $this->containerRepository->all();

        return response()->json([
            compact('containers')
        ], Response::HTTP_OK);
    }

    /**
     * @param ContainerRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(ContainerRequest $request)
    {
        $data = $request->only(['name', 'ship_id', 'price']);
        $ship = Ship::findOrFail(array_get($data, 'ship_id'));
        $container = $this->containerRepository->add($data, $ship);

        return response()->json([
            config('models.messages.message') => config('models.controllers.container.statuses.created'),
            compact('container')
        ], Response::HTTP_CREATED);
    }

    /**
     * @param Container $container
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Container $container)
    {
        return response()->json([
            compact('container')
        ], Response::HTTP_OK);
    }

    /**
     * @param ContainerRequest $request
     * @param Container $container
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(ContainerRequest $request, Container $container)
    {
        $data = $request->only(['name', 'ship_id', 'price']);
        $ship = Ship::findOrFail(array_get($data, 'ship_id'));
        $container = $this->containerRepository->update($container, $data, $ship);

        return response()->json([
            config('models.messages.message') => config('models.controllers.container.statuses.updated'),
            compact('container')
        ], Response::HTTP_OK);
    }

    /**
     * @param Container $container
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(Container $container)
    {
        $this->containerRepository->delete($container);

        return response()->json([
            config('models.messages.message') => config('models.controllers.container.statuses.deleted')
        ], Response::HTTP_OK);
    }
}
