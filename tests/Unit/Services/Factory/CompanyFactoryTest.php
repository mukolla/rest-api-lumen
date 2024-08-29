<?php

namespace Tests\Unit\Services\Factory;

use App\Models\Company;
use App\Services\Factory\CompanyFactory;
use Tests\TestCase;

class CompanyFactoryTest extends TestCase
{
    private CompanyFactory $service;

    public function setUp(): void
    {
        parent::setUp();

        $this->service = new CompanyFactory();
    }

    public function testCreate()
    {
        $companyData = [
            'title' => 'Example Company',
            'phone' => '+1111111111',
            'description' => 'This is an example company.',
        ];

        $company = $this->service->create($companyData);

        $this->assertInstanceOf(Company::class, $company);

        $this->assertEquals('Example Company', $company->title);
        $this->assertEquals('+1111111111', $company->phone);
        $this->assertEquals('This is an example company.', $company->description);
    }
}
