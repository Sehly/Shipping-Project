<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CityResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=> $this->id ,
            'city_name'=> $this->city_name ,
            'original_cost'=> $this->original_cost ,
            'pickup_cost'=> $this->pickup_cost ,
            'governorate_id' => $this->governorate_id,
        ];
    }
}
