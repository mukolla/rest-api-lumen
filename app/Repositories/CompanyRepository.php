<?php

namespace App\Repositories;

use App\Models\Company;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class CompanyRepository
{
    public function getUserCompanies(User $user): Collection
    {
        return $user->companies;
    }

    public function saveCompanyForUser(Company $company, User $user): void
    {
        $user->companies()->save($company);
    }
}
