<?php

namespace App\Http\Controllers\Api;

use App\Company;
use App\Http\Requests\Api\ShipRequest;
use App\Ship;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class ShipsController extends Controller
{
    /**
     * @param Company $company
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Company $company)
    {
        $ships = $company->ships()->get();

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
        $ship = new Ship();
        $ship->name = request('name');
        $ship->company_id = $company->id;
        $ship->save();

        return response()->json([
            'message' => 'Successfully created ship!',
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
        $ship->name = request('name');
        $ship->company_id = $company->id;
        $ship->save();

        return response()->json([
            'message' => 'Successfully updated ship!',
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
        $ship->delete();

        return response()->json([
            'message' => 'Successfully deleted ship!'
        ], Response::HTTP_OK);
    }
}
