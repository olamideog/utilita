<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateMeterRequest;
use App\Http\Resources\EmptyResource;
use App\Http\Resources\MeterResource;
use App\Models\EmptyModel;
use App\Models\Meter;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;

class CreateMeterController extends Controller
{
    public function __invoke(CreateMeterRequest $request): JsonResource
    {
        $meter = $request->user()->meter;
        if ($meter != null) {
            return new EmptyResource(new EmptyModel('Meter Already exist', 'METER_CONFLICT', Response::HTTP_CONFLICT));
        }
        $meter = new Meter();
        $meter['user_id'] = $request->user()->id;
        $meter['number'] = $request->string('number')->trim();
        $meter->save();

        return new MeterResource($meter);
    }
}
