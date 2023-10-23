<?php

namespace App\Http\Resources\AdminRole;

use App\Http\Resources\AdminType\AdminTypeCollection;
use App\Http\Resources\AdminType\AdminTypeResource;
use Illuminate\Http\Resources\Json\JsonResource;

class AdminRoleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'abilities' => $this->abilities,
            'created_at' => $this->created_at->format('d/m/y H:i'),
            'updated_at' => $this->updated_at->format('d/m/y H:i'),

        ];
    }
}