<?php

namespace Tests\Unit\Http\Resources;

use App\Http\Resources\BadRequestResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Tests\TestCase;

class BadRequestTest extends TestCase
{
    public function testResponse()
    {
        $responseResource = new BadRequestResponse(['message' => 'error message']);

        $request = Request::create('/dummy-url');
        $jsonResponse = $responseResource->response($request);

        $this->assertEquals(Response::HTTP_BAD_REQUEST, $jsonResponse->getStatusCode());
        $this->assertEquals(['message' => 'error message'], $jsonResponse->getData(true));
    }
}
