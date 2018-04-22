<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\TrackRequest;
use App\Repositories\TrackRepository;
use App\Route;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;

class TracksController extends Controller
{
    /**
     * @var TrackRepository
     */
    private $trackRepository;

    /**
     * TracksController constructor.
     * @param TrackRepository $repository
     */
    public function __construct(TrackRepository $repository)
    {
        $this->trackRepository = $repository;
    }

    /**
     * @param TrackRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(TrackRequest $request)
    {
        $data = $request->only(['latitude', 'longitude', 'speed', 'route_id']);

        Route::findOrFail(array_get($data, 'route_id'));

        $track = $this->trackRepository->add($data);

        return response()->json([
            config('models.messages.message') => config('models.controllers.track.statuses.created'),
            compact('track')
        ], Response::HTTP_CREATED);
    }

    /**
     * @param Route $route
     * @return Route
     */
    public function save(Route $route)
    {
        $data = $this->trackRepository->saveToDB($route);

        return $data;
    }
}
