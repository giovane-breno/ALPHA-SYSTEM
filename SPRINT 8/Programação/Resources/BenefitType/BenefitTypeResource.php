<?php

namespace App\Http\Resources\BenefitType;

use Illuminate\Http\Resources\Json\JsonResource;

class BenefitTypeResource extends JsonResource
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
            'bonus' => $this->bonus,
        ];
    }
}