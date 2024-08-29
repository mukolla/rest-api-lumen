<?php

namespace App\Http\Controllers;

use App\Http\Resources\DataResponse;
use App\Services\CompanyCreationService;
use App\Services\CompanyListingService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class UserCompaniesController extends Controller
{
    /**
     * @throws ValidationException
     */
    public function create(Request $request, CompanyCreationService $companyCreationService): JsonResponse
    {
        $this->validate($request, [
            'title' => 'required|string',
            'phone' => 'required|string',
            'description' => 'required|string',
        ]);

        $user = $request->user();
        $companyData = $request->only(['title', 'phone', 'description']);

        $company = $companyCreationService->createCompanyForUser($companyData, $user);

        return (new DataResponse($company))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function list(Request $request, CompanyListingService $companyListingService): JsonResponse
    {
        $user = $request->user();
        $companies = $companyListingService->getUserCompanies($user);

        return (new DataResponse($companies))
            ->response();
    }
}
