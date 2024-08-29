<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\CompanyRepository;
use Illuminate\Database\Eloquent\Collection;

class CompanyListingService
{
    private CompanyRepository $companyRepository;

    public function __construct(CompanyRepository $companyRepository)
    {
        $this->companyRepository = $companyRepository;
    }

    public function getUserCompanies(User $user): Collection
    {
        return $this->companyRepository->getUserCompanies($user);
    }
}
