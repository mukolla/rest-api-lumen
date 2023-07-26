<?php

namespace App\Repositories;

use App\Models\User;

class CompanyRepository
{
    public function getUserCompanies(User $user)
    {
        return $user->companies;
    }
}
