<?php

namespace App\Http\Controllers\Api;

use App\Gpx;
use App\Http\Requests\Api\GpxRequest;
use App\Repositories\GpxRepository;
use App\Http\Controllers\Controller;
use App\Route;
use App\Track;
use Illuminate\Http\Response;

class GpxController extends Controller
{
    /**
     * @var GpxRepository
     */
    private $gpxRepository;

    /**
     * GpxController constructor.
     * @param GpxRepository $repository
     */
    public function __construct(GpxRepository $repository)
    {
        $this->gpxRepository = $repository;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $gpxes = $this->gpxRepository->all();

        return response()->json([
            compact('gpxes')
        ], Response::HTTP_OK);
    }

    /**
     * @param GpxRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(GpxRequest $request)
    {
        $gpxFile = $request->file(['file']);
        $fileName = $this->gpxRepository->uploadFile($gpxFile);
        $gpxes = $this->gpxRepository->store($fileName);

        return response()->json([
            config('models.messages.message') => config('models.controllers.gpx.statuses.created'),
            compact('gpxes')
        ], Response::HTTP_CREATED);
    }

    /**
     * @param Gpx $gpx
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(Gpx $gpx)
    {
        $this->gpxRepository->delete($gpx);

        return response()->json([
            config('models.messages.message') => config('models.controllers.gpx.statuses.deleted')
        ], Response::HTTP_OK);
    }

    public function success(Route $route, Gpx $gpx)
    {
        $countTracks = $this->gpxRepository->parseGpxFile($route, $gpx);

        return response()->json([
            config('models.messages.message') => config('models.controllers.gpx.statuses.parse'),
            compact('countTracks')
        ], Response::HTTP_OK);
    }
}
