<?php

namespace App\Http\Controllers\Api;

use App\Company;
use App\Http\Requests\Api\CompanyRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class CompaniesController extends Controller
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $companies = Company::all();

        return response()->json([
            compact('companies')
        ], Response::HTTP_OK);
    }

    /**
     * @param CompanyRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CompanyRequest $request)
    {
        $company = new Company();
        $company->name = request('name');
        $company->owner_id = request('owner_id');
        $company->save();

        return response()->json([
            'message' => 'Successfully created company!',
            compact('company')
        ], Response::HTTP_CREATED);
    }

    /**
     * @param Company $company
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Company $company)
    {
        return response()->json([
            compact('company')
        ], Response::HTTP_OK);
    }

    /**
     * @param CompanyRequest $request
     * @param Company $company
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(CompanyRequest $request, Company $company)
    {
        $company->name = request('name');
        $company->owner_id = request('owner_id');
        $company->save();

        return response()->json([
            'message' => 'Successfully updated company!',
            compact('company')
        ], Response::HTTP_OK);
    }

    /**
     * @param Company $company
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(Company $company)
    {
        $company->delete();

        return response()->json([
            'message' => 'Successfully deleted company!'
        ], Response::HTTP_OK);
    }
}
