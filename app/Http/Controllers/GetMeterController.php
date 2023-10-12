<?php

namespace App\Http\Controllers;

use App\Http\Requests\GetMeterRequest;
use App\Http\Resources\EmptyResource;
use App\Http\Resources\MeterResource;
use App\Models\EmptyModel;
use Illuminate\Http\Resources\Json\JsonResource;

class GetMeterController extends Controller
{
    public function __invoke(GetMeterRequest $request): JsonResource
    {
        $meter = $request->user()->meter;
        if ($meter == null) {
            return new EmptyResource(new EmptyModel('Meter Not Found', 'METER_NOT_FOUND'));
        }

        return new MeterResource($meter);
    }
}
