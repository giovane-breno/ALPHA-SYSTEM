<?php

namespace App\Http\Resources\Benefit;

use App\Http\Resources\BenefitType\BenefitTypeCollection;
use App\Http\Resources\BenefitType\BenefitTypeResource;
use Illuminate\Http\Resources\Json\JsonResource;

class BenefitResource extends JsonResource
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
            'user' => $this->User,
            'benefit' => $this->Benefit,
            'created_at' => $this->created_at->format('d/m/y H:i'),
            'updated_at' => $this->updated_at->format('d/m/y H:i'),

        ];
    }
}