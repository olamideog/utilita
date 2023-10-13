<?php

namespace App\Http\Controllers;

use App\Http\Requests\GetRateRequest;
use App\Http\Resources\RateResource;
use App\Models\Rate;
use Illuminate\Http\Resources\Json\JsonResource;

class GetRatesController extends Controller
{
    public function __invoke(GetRateRequest $request): JsonResource
    {
        $rates = Rate::get();

        return RateResource::collection($rates);
    }
}
