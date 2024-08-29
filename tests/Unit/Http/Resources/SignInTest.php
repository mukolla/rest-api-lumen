<?php

namespace Tests\Unit\Http\Resources;

use App\Http\Resources\SignIn;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class SignInTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    public function testToArray()
    {
        $user = User::factory()->make()->setAttribute('id', 17);

        Auth::shouldReceive('user')->once()->andreturn($user);
        Auth::shouldReceive('factory->getTTL')->once()->andReturn(60);

        $resource = 'sample_token';
        $signInResource = new SignIn($resource);

        $request = Request::create('/dummy-url');
        $responseArray = $signInResource->toArray($request);

        $this->assertArrayHasKey('access_token', $responseArray);
        $this->assertArrayHasKey('token_type', $responseArray);
        $this->assertArrayHasKey('user', $responseArray);
        $this->assertArrayHasKey('expires_in', $responseArray);

        $this->assertEquals('sample_token', $responseArray['access_token']);
        $this->assertEquals('bearer', $responseArray['token_type']);
        $this->assertEquals($user, $responseArray['user']);
        $this->assertEquals(60 * 60 * 24, $responseArray['expires_in']);
    }
}
