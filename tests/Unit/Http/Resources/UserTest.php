<?php

namespace Tests\Unit\Http\Resources;

use App\Http\Resources\User;
use Illuminate\Http\Request;
use Tests\TestCase;

class UserTest extends TestCase
{
    public function testToArray()
    {
        $user = new \stdClass();
        $user->id = 1;
        $user->first_name = 'John';
        $user->last_name = 'Doe';
        $user->email = 'john.doe@example.com';
        $user->phone = '+123456789';
        $user->password = 'qwerty12345';

        $userResource = new User($user);

        $request = Request::create('/dummy-url');
        $responseArray = $userResource->toArray($request);

        $this->assertArrayHasKey('id', $responseArray);
        $this->assertArrayHasKey('first_name', $responseArray);
        $this->assertArrayHasKey('last_name', $responseArray);
        $this->assertArrayHasKey('email', $responseArray);
        $this->assertArrayHasKey('phone', $responseArray);
        $this->assertArrayNotHasKey('password', $responseArray);

        $this->assertEquals(1, $responseArray['id']);
        $this->assertEquals('John', $responseArray['first_name']);
        $this->assertEquals('Doe', $responseArray['last_name']);
        $this->assertEquals('john.doe@example.com', $responseArray['email']);
        $this->assertEquals('+123456789', $responseArray['phone']);
    }
}
