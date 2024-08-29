<?php

namespace Tests\Unit\Models;

use App\Models\Company;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Tests\TestCase;

class CompanyTest extends TestCase
{
    public function testUserRelation()
    {
        $company = new Company();
        $relation = $company->user();

        $this->assertInstanceOf(BelongsTo::class, $relation);

        $this->assertEquals('user_id', $relation->getForeignKeyName());
        $this->assertEquals('id', $relation->getOwnerKeyName());
    }
}
