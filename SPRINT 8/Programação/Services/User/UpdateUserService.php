<?php

namespace App\Http\Services\User;

use App\Enums\MessageEnum;
use App\Models\User;
use Exception;

class UpdateUserService
{
    protected $name;
    protected $email;
    protected $cpf;
    protected $ctps;
    protected $pis;
    protected $company_id;
    protected $role_id;
    protected $division_id;

    public function __construct(
        $name,
        $email,
        $cpf,
        $ctps,
        $pis,
        $company_id,
        $role_id,
        $division_id
    ) {
        $this->name = $name;
        $this->email = $email;
        $this->cpf = $cpf;
        $this->ctps = $ctps;
        $this->pis = $pis;
        $this->company_id = $company_id;
        $this->role_id = $role_id;
        $this->division_id = $division_id;
    }

    public function updateUser(int $id)
    {
        // MessageEnum == MENSAGENS PREDEFINIDAS PARA EVITAR REPETIÇÃO DE CÓDIGO
        $message = MessageEnum::SUCCESS_CREATED;

        try {
            // User::fill == função utilizada para atualizar os dados
            $query = User::findOrFail($id);
            $query::fill([
                'full_name' => $this->name,
                'email' => $this->email,
                'cpf' => $this->cpf,
                'ctps' => $this->ctps,
                'pis' => $this->pis,
                'company_id' => $this->company_id,
                'role_id' => $this->role_id,
                'division_id' => $this->division_id,
            ]);

            return ['id' => $query->id, 'message' => $message];
        } catch (Exception $th) {
            throw new Exception(MessageEnum::FAILURE_UPDATED);
        }
    }
}