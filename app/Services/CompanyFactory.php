<?php

namespace App\Services;

use App\Models\Company;

class CompanyFactory
{
    public function create(array $data): Company
    {
        return new Company([
            'title' => $data['title'],
            'phone' => $data['phone'],
            'description' => $data['description'],
        ]);
    }
}
