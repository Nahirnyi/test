<?php

namespace App\Http\Controllers\Api\Ship;

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
     * @param Route $route
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Route $route)
    {
        $tracks = $this->trackRepository->all($route);

        return response()->json([
            compact('tracks')
        ], Response::HTTP_OK);
    }
}
