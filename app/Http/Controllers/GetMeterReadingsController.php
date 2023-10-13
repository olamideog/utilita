<?php

namespace App\Http\Controllers;

use App\Http\Requests\GetMeterReadingsRequest;
use App\Http\Resources\EmptyResource;
use App\Http\Resources\MeterReadingResource;
use App\Http\Resources\MeterResource;
use App\Models\EmptyModel;
use Illuminate\Http\Resources\Json\JsonResource;

class GetMeterReadingsController extends Controller
{
    public function __invoke(GetMeterReadingsRequest $request): JsonResource
    {
        $meter = $request->user()->meter;
        if ($meter == null) {
            return new EmptyResource(new EmptyModel('Meter Not Found', 'METER_NOT_FOUND'));
        }

        $readings = $meter->readings;

        if ($readings->count() <= 0) {
            return new EmptyResource(new EmptyModel('Meter Readings Not Found', 'METER_READINGS_NOT_FOUND'));
        }

        return new MeterResource($meter);
    }
}
