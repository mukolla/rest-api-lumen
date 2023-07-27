<?php

namespace App\Http\Resources;

use Illuminate\Http\Response;

class UnauthorizedResponse extends MessageResponse
{
    protected $status = Response::HTTP_UNAUTHORIZED;

    public function __construct($resource = null)
    {
        parent::__construct($resource);
    }

    public function response($request = null): \Illuminate\Http\JsonResponse
    {
        return parent::response($request)->setStatusCode($this->status);
    }

    public function toArray($request)
    {
        return [
            'error' => $this->resource['error'] ?? null,
        ];
    }

    public function with($request)
    {
        return [
            'error' => $this->resource['error'] ?? null,
        ];
    }
}
