<?php

namespace App\Http\Controllers;

use App\Enums\ReconciliationStatus;
use App\Http\Requests\CreateMeterReadingRequest;
use App\Http\Resources\EmptyResource;
use App\Http\Resources\MeterResource;
use App\Models\EmptyModel;
use App\Models\MeterReading;
use App\Models\Rate;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;

class CreateMeterReadingController extends Controller
{
    public function __invoke(CreateMeterReadingRequest $request): JsonResource
    {
        $meter = $request->user()->meter;
        if ($meter == null) {
            return new EmptyResource(new EmptyModel('Meter Not Found', 'METER_NOT_FOUND', Response::HTTP_NOT_FOUND));
        }
        $previousReading = $meter->readings()->latest();
        $actualReading = $previousReading != null ? $request->reading - $previousReading->reading : $request->reading;

        if ($actualReading <= 0) {
            return new EmptyResource(new EmptyModel('Invalid Data', 'READING_NOT_ACCEPTED', Response::HTTP_NOT_ACCEPTABLE));
        }

        $energyRate = Rate::whereTime('start_time', '>=', $request->read_at->format('H:i:s'))
            ->whereTime('end_time', '<=', $request->read_at->format('H:i:s'))
            ->first();

        $reading = new MeterReading();
        $reading['meter_id'] = $meter->id;
        $reading['reading'] = $actualReading;
        $reading['read_at'] = $request->read_at;
        $reading['rate'] = $energyRate->rate;
        $reading['status'] = ReconciliationStatus::DEFAULT->value;
        $reading->save();

        return new MeterResource($meter);
    }
}
