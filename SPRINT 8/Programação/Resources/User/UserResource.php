<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $data = [
            'id' => $this->id,
            'username' => $this->username,
            'full_name' => $this->full_name,
            'cpf' => $this->CPF,
            'ctps' => $this->CTPS,
            'pis' => $this->PIS,
            'company' => $this->Company,
            'role' => $this->Role,
            'division' => $this->Division,
            'created_at' => $this->created_at->format('d/m/y H:i'),
            'updated_at' => $this->updated_at->format('d/m/y H:i'),
        ];
        
        // Verifique se $this->isAdmin não é nulo e, se for verdadeiro, adicione 'isAdmin' ao array
        if ($this->isAdmin) {
            $data['isAdmin'] = $this->isAdmin->AdminRole;
        }
        
        return $data;
        
    }
}