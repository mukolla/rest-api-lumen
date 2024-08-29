<?php

namespace App\Services;

use App\Models\Company;
use App\Models\User;
use App\Repositories\CompanyRepository;
use App\Services\Factory\CompanyFactory;

class CompanyCreationService
{
    private CompanyFactory $companyFactory;

    private CompanyRepository $companyRepository;

    public function __construct(CompanyFactory $companyFactory, CompanyRepository $companyRepository)
    {
        $this->companyFactory = $companyFactory;
        $this->companyRepository = $companyRepository;
    }

    public function createCompanyForUser(array $companyData, User $user): Company
    {
        $company = $this->companyFactory->create($companyData);
        $this->companyRepository->saveCompanyForUser($company, $user);

        return $company;
    }
}
