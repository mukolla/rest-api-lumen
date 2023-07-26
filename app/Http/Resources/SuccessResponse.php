<?php

namespace App\Http\Resources;

use Illuminate\Http\Response;

class SuccessResponse extends MessageResponse
{
    protected $status = Response::HTTP_OK;

    public function __construct($resource = null)
    {
        parent::__construct($resource);
    }

    public function response($request = null): \Illuminate\Http\JsonResponse
    {
        return parent::response($request)->setStatusCode($this->status);
    }
}
