<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BillResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'usage' => $this->usage,
            'total' => '£'.$this->total,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'meter' => new MeterResource($this->meter),
        ];
    }
}
