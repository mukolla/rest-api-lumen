<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DataResponse extends JsonResource
{
    /**
     * The “data” wrapper that should be applied.
     *
     * @var string | null
     */
    public static $wrap = 'data';

    public function response($request = null): \Illuminate\Http\JsonResponse
    {
        return parent::response($request);
    }

    public function __construct($resource)
    {
        parent::__construct($resource);
    }
}
