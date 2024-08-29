<?php

namespace App\Http\Resources;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class BadRequestResponse extends MessageResponse
{
    protected int $status = Response::HTTP_BAD_REQUEST;

    public function __construct($resource = null)
    {
        parent::__construct($resource);
    }

    public function response($request = null): JsonResponse
    {
        return parent::response($request)->setStatusCode($this->status);
    }
}
