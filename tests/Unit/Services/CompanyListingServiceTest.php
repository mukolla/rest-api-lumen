<?php

namespace Tests\Unit\Services;

use App\Models\User;
use App\Repositories\CompanyRepository;
use App\Services\CompanyListingService;
use Illuminate\Database\Eloquent\Collection;
use PHPUnit\Framework\MockObject\Exception;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class CompanyListingServiceTest extends TestCase
{
    private CompanyListingService $service;

    private MockObject|CompanyRepository $companyRepositoryMock;

    /**
     * @throws Exception
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->companyRepositoryMock = $this->createMock(CompanyRepository::class);

        $this->service = new CompanyListingService(
            $this->companyRepositoryMock
        );
    }

    /**
     * @throws Exception
     */
    public function testGetUserCompanies()
    {
        $user = (new User())->setAttribute('id', 12);

        $collection = new Collection;

        $this->companyRepositoryMock
            ->expects($this->once())
            ->method('getUserCompanies')
            ->with($user)
            ->willReturn($collection);

        $this->assertSame(
            $collection,
            $this->service->getUserCompanies($user)
        );
    }
}
