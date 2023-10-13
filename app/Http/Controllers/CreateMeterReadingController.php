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
use Illuminate\Support\Carbon;

class CreateMeterReadingController extends Controller
{
    public function __invoke(CreateMeterReadingRequest $request): JsonResource
    {
        $meter = $request->user()->meter;
        if ($meter == null) {
            return new EmptyResource(new EmptyModel('Meter Not Found', 'METER_NOT_FOUND', Response::HTTP_NOT_FOUND));
        }
        $previousReading = $meter->readings->count() > 0 ? $meter->readings->first() : null;

        $usage = $previousReading != null ? $request->reading - $previousReading->reading : $request->reading;
        $readAtTime = Carbon::parse($request->read_at)->format('H:i:s');

        if ($usage <= 0) {
            return new EmptyResource(new EmptyModel('Invalid Data', 'READING_NOT_ACCEPTED', Response::HTTP_NOT_ACCEPTABLE));
        }

        $energyRate = Rate::whereTime('start_time', '<=', $readAtTime)
            ->whereTime('end_time', '>=', $readAtTime)
            ->first();


        $reading = new MeterReading();
        $reading['meter_id'] = $meter->id;
        $reading['reading'] = $request->reading;
        $reading['usage'] = $usage;
        $reading['read_at'] = $request->read_at;
        $reading['rate'] = $energyRate->rate;
        $reading['status'] = ReconciliationStatus::DEFAULT->value;
        $reading->save();

        $meter->refresh();

        return new MeterResource($meter);
    }
}
