<?php

namespace App\Http\Controllers;

use App\Http\Requests\GetMeterReadingsRequest;
use App\Http\Resources\EmptyResource;
use App\Http\Resources\MeterReadingResource;
use App\Models\EmptyModel;
use Illuminate\Http\Resources\Json\JsonResource;

class GetMeterReadingsController extends Controller
{
    public function __invoke(GetMeterReadingsRequest $request): JsonResource
    {
        $readings = $request->user()->meter->readings;

        if ($readings == null) {
            return new EmptyResource(new EmptyModel('Meter Readings Not Found', 'METER_READINGS_NOT_FOUND'));
        }

        return MeterReadingResource::collection($readings);
    }
}
