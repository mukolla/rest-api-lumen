<?php

namespace App\Http\Controllers;

use App\Http\Resources\DataResponse;
use App\Repositories\CompanyRepository;
use App\Services\CompanyFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class UserCompaniesController extends Controller
{
    private CompanyFactory $companyFactory;

    private CompanyRepository $companyRepository;

    public function __construct(CompanyFactory $companyFactory, CompanyRepository $companyRepository)
    {
        $this->companyFactory = $companyFactory;
        $this->companyRepository = $companyRepository;
    }

    /**
     * @throws ValidationException
     */
    public function create(Request $request): \Illuminate\Http\JsonResponse
    {
        $this->validate($request, [
            'title' => 'required|string',
            'phone' => 'required|string',
            'description' => 'required|string',
        ]);

        $user = $request->user();
        $companyData = $request->only(['title', 'phone', 'description']);

        $company = $this->companyFactory->create($companyData);
        $user->companies()->save($company);

        return (new DataResponse($company))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function list(Request $request): \Illuminate\Http\JsonResponse
    {
        $user = $request->user();
        $companies = $this->companyRepository->getUserCompanies($user);

        return (new DataResponse($companies))
            ->response();
    }
}
