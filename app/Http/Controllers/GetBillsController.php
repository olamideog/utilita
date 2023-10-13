<?php

namespace App\Http\Controllers;

use App\Http\Requests\GetBillRequest;
use App\Http\Resources\BillResource;
use App\Http\Resources\EmptyResource;
use App\Models\EmptyModel;
use Illuminate\Http\Resources\Json\JsonResource;

class GetBillsController extends Controller
{
    public function __invoke(GetBillRequest $request): JsonResource
    {
        $meter = $request->user()->meter;
        if ($meter == null) {
            return new EmptyResource(new EmptyModel('User Meter Not Found', 'USER_METER_NOT_FOUND'));
        }

        $bills = $meter->bills;

        if ($bills->count() <= 0) {
            return new EmptyResource(new EmptyModel('Meter Bill Not Found', 'METER_BILL_NOT_FOUND'));
        }

        return BillResource::collection($bills);
    }
}
