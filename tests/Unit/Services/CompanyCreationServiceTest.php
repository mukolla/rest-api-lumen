<?php

namespace Tests\Unit\Services;

use App\Models\Company;
use App\Models\User;
use App\Repositories\CompanyRepository;
use App\Services\CompanyCreationService;
use App\Services\Factory\CompanyFactory;
use PHPUnit\Framework\MockObject\Exception;
use PHPUnit\Framework\MockObject\MockObject;
use Tests\TestCase;

class CompanyCreationServiceTest extends TestCase
{
    private CompanyCreationService $service;

    private MockObject|CompanyFactory $companyFactoryMock;

    private MockObject|CompanyRepository $companyRepositoryMock;

    /**
     * @throws Exception
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->companyFactoryMock = $this->createMock(CompanyFactory::class);
        $this->companyRepositoryMock = $this->createMock(CompanyRepository::class);

        $this->service = new CompanyCreationService(
            $this->companyFactoryMock,
            $this->companyRepositoryMock
        );
    }

    public function testCreateCompanyForUser()
    {
        $companyData = [
            'title' => 'example company LLC',
            'phone' => '+1111111',
            'description' => 'super company',
        ];

        $company = (new Company())->setAttribute('id', 7);
        $user = (new User())->setAttribute('id', 12);

        $this->companyFactoryMock
            ->expects($this->once())
            ->method('create')
            ->with($companyData)
            ->willReturn($company);

        $this->companyRepositoryMock
            ->expects($this->once())
            ->method('saveCompanyForUser')
            ->with($company, $user);

        $this->assertSame(
            $company,
            $this->service->createCompanyForUser($companyData, $user)
        );
    }
}
