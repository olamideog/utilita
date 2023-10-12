<?php

namespace App\Http\Controllers;

use App\Http\Requests\GetEnergyPriceRequest;
use App\Http\Resources\EnergyPriceResource;
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
