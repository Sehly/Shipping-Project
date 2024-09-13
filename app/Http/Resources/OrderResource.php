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
        ];
    }
}
