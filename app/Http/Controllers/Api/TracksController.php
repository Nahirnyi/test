<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\TrackRequest;
use App\Jobs\ProcessTrack;
use App\Repositories\TrackRepository;
use App\Track;
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
        $track = $this->trackRepository->add(request(['latitude', 'longitude', 'speed', 'route_id']));

        return response()->json([
            config('models.messages.message') => config('models.controllers.track.statuses.created'),
            compact('track')
        ], Response::HTTP_CREATED);
    }
}
