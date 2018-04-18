<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\TrackRequest;
use App\Jobs\ProcessTrack;
use App\Track;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;

class TracksController extends Controller
{
    /**
     * @param TrackRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(TrackRequest $request)
    {
        $track = new Track();
        $track->latitude = request('latitude');
        $track->longitude = request('longitude');
        $track->speed = request('speed');
        $track->route_id = request('route_id');
        ProcessTrack::dispatch($track);
        $track->save();

        return response()->json([
            config('models.messages.message') => config('models.controllers.track.statuses.created'),
            compact('track')
        ], Response::HTTP_CREATED);
    }
}
