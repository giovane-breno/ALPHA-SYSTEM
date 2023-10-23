<?php

namespace App\Http\Resources\Incident;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

class IncidentResource extends JsonResource
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
            'incident_reason' => $this->incident_reason,
            'discounted_amount' => $this->discounted_amount,
            'start_date' => Carbon::parse($this->start_date)->format('d/m/y'),
            'end_date' => Carbon::parse($this->end_date)->format('d/m/y'),
            'created_at' => $this->created_at->format('d/m/y H:i'),
            'updated_at' => $this->updated_at->format('d/m/y H:i'),
        ];
    }
}