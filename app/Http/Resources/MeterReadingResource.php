<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MeterReadingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'meter' => new MeterResource($this->meter),
            'id' => $this->id,
            'reading' => $this->reading,
            'read_at' => $this->read_at,
        ];
    }
}
