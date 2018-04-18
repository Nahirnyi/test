<?php

namespace App\Http\Controllers\Api;

use App\Container;
use App\Http\Requests\Api\ContainerRequest;
use App\Repositories\ContainerRepository;
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

        $container = $this->containerRepository->add(request(['name', 'ship_id', 'price']));

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
        $this->containerRepository->update($container, request(['name', 'ship_id', 'price']));

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
