<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'name'=> $this->name ,
            'username'=> $this->username ,
            'email'=> $this->email,
            'password'=> $this->password,
            'role'=> $this->role,
            'company_name'=> $this->company_name,
            'group_id'=> $this->group_id,
            'phone'=> $this->phone,
            'address'=> $this->address,
            'branch_id'=> $this->branch_id,
            'created_at'=> $this->created_at ,
            'updated_at'=> $this->updated_at ,
            'governorate_id' => $this->governorate_id,
            'company_per' => $this->company_per,
            'status' => $this->status,
            'discount_type' => $this->discount_type,
        ];
    }
}
