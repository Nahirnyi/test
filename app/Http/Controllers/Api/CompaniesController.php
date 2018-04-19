<?php

namespace App\Http\Controllers\Api;

use App\Company;
use App\Http\Requests\Api\CompanyRequest;
use App\Http\Controllers\Controller;
use App\Repositories\CompanyRepository;
use App\User;
use Illuminate\Http\Response;

class CompaniesController extends Controller
{
    /**
     * @var CompanyRepository
     */
    private $companyRepository;

    /**
     * CompaniesController constructor.
     * @param CompanyRepository $companyRepository
     */
    public function __construct(CompanyRepository $companyRepository)
    {
        $this->companyRepository = $companyRepository;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $companies = $this->companyRepository->all();

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
        $data = $request->only(['name', 'owner_id']);
        User::findOrFail(array_get($data, 'owner_id'));
        $company = $this->companyRepository->add($data);

        return response()->json([
            config('models.messages.message') => config('models.controllers.company.statuses.created'),
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
        $data = $request->only(['name', 'owner_id']);
        User::findOrFail(array_get($data, 'owner_id'));
        $company = $this->companyRepository->update($company, $data);

        return response()->json([
            config('models.messages.message') => config('models.controllers.company.statuses.updated'),
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
        $this->companyRepository->delete($company);

        return response()->json([
            config('models.messages.message') => config('models.controllers.company.statuses.deleted')
        ], Response::HTTP_OK);
    }
}
