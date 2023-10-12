<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateMeterReadingRequest;
use App\Http\Requests\CreateMeterRequest;
use App\Http\Resources\EmptyResource;
use App\Http\Resources\MeterResource;
use App\Models\EmptyModel;
use App\Models\Meter;
use App\Models\MeterReading;
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

        if($actualReading <= 0){
            return new EmptyResource(new EmptyModel('Invalid Data', 'READING_NOT_ACCEPTED', Response::HTTP_NOT_ACCEPTABLE));
        }


        $reading = new MeterReading();
        $reading['meter_id'] = $meter->id;
        $reading['reading'] = $actualReading;
        $reading['read_at'] = $request->read_at;
        $reading->save();

        return new MeterResource($meter);
    }
}
