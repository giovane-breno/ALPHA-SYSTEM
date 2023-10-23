<?php

namespace App\Http\Resources\Payroll;

use Illuminate\Http\Resources\Json\JsonResource;

class PayrollResource extends JsonResource
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
            'company' => $this->Company,
            'user_id' => $this->User,
            'full_name' => $this->full_name,
            'role' => $this->role,
            'base_salary' => $this->base_salary,
            'bonus' => $this->bonus,
            'benefits' => $this->benefits,
            'vacation' => $this->vacation,
            'discounts' => $this->discounts,
            'gross_salary' => $this->gross_salary,
            'net_salary' => $this->net_salary,
            'created_at' => $this->created_at->format('d/m/y H:i'),
            'updated_at' => $this->updated_at->format('d/m/y H:i'),
        ];
    }
}