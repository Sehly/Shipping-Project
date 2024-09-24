<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GroupPermissionResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'group' => new GroupResource($this->whenLoaded('group')),
            'permission' => new PermissionResource($this->whenLoaded('permission')),
        ];
    }
}
