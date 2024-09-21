<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            'status'=> $this->status ,
            'weight'=> $this->weight ,
            'created_date'=> $this->created_date ,
            'user_id'=> $this->user_id ,
            'branch_id'=> $this->branch_id ,
            'region_id'=> $this->region_id ,
            'cost'=> $this->cost,
            'max_weight'=> $this->max_weight,
            'city_id' => $this->city_id,
            'governorate_id' => $this->governorate_id,
            'orderType' => $this->orderType,
            'clientName' => $this->clientName,
            'phone1' => $this->phone1,
            'email' => $this->email,
            'village' => $this->village,
            'toVillage' => $this->toVillage,
            'shippingType' => $this->shippingType,
            'paymentType' => $this->paymentType,
            'notes' => $this->notes,
            'products' => ProductResource::collection($this->whenLoaded('products')), 
        ];
    }
}
