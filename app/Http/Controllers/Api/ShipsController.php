<?php

namespace App\Http\Controllers\Api;

use App\Company;
use App\Http\Requests\Api\ShipRequest;
use App\Repositories\ShipRepository;
use App\Ship;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class ShipsController extends Controller
{
    /**
     * @var ShipRepository
     */
    private $shipRepository;

    /**
     * ShipsController constructor.
     * @param ShipRepository $repository
     */
    public function __construct(ShipRepository $repository)
    {
        $this->shipRepository = $repository;
    }

    /**
     * @param Company $company
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Company $company)
    {
        $ships = $this->shipRepository->all($company);

        return response()->json([
            compact('ships')
        ], Response::HTTP_OK);
    }

    /**
     * @param Company $company
     * @param ShipRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Company $company, ShipRequest $request)
    {
        $data = $request->only(['name']);
        $ship = $this->shipRepository->add($company, $data);

        return response()->json([
            config('models.messages.message') => config('models.controllers.ship.statuses.created'),
            compact('ship')
        ], Response::HTTP_CREATED);
    }

    /**
     * @param Company $company
     * @param Ship $ship
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Company $company, Ship $ship)
    {
        return response()->json([
            compact('ship')
        ], Response::HTTP_OK);
    }

    /**
     * @param ShipRequest $request
     * @param Company $company
     * @param Ship $ship
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(ShipRequest $request, Company $company, Ship $ship)
    {
        $data = $request->only(['name']);
        $this->shipRepository->update($company, $ship, $data);

        return response()->json([
            config('models.messages.message') => config('models.controllers.ship.statuses.updated'),
            compact('ship')
        ], Response::HTTP_OK);
    }

    /**
     * @param Company $company
     * @param Ship $ship
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(Company $company, Ship $ship)
    {
        $this->shipRepository->delete($ship);

        return response()->json([
            config('models.messages.message') => config('models.controllers.ship.statuses.deleted'),
        ], Response::HTTP_OK);
    }
}
