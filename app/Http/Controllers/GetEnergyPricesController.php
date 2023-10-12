<?php

namespace App\Http\Controllers;

use App\Http\Requests\GetEnergyPriceRequest;
use App\Http\Requests\GetMeterRequest;
use App\Http\Resources\EmptyResource;
use App\Http\Resources\EnergyPriceResource;
use App\Http\Resources\MeterResource;
use App\Models\EmptyModel;
use App\Models\EnergyPrice;
use Illuminate\Http\Resources\Json\JsonResource;

class GetEnergyPricesController extends Controller
{
    public function __invoke(GetEnergyPriceRequest $request): JsonResource
    {
        $energyPrices = EnergyPrice::get();

        return EnergyPriceResource::collection($energyPrices);
    }
}
