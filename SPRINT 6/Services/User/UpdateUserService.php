<?php

namespace App\Http\Services\User;

use App\Enums\MessageEnum;
use App\Models\User;
use Exception;

class UpdateUserService
{
    protected $name;
    protected $cpf;
    protected $ctps;
    protected $pis;
    protected $company_id;
    protected $role_id;

    public function __construct(
        $name,
        $cpf,
        $ctps,
        $pis,
        $company_id,
        $role_id
    ) {
        $this->name = $name;
        $this->cpf = $cpf;
        $this->ctps = $ctps;
        $this->pis = $pis;
        $this->company_id = $company_id;
        $this->role_id = $role_id;
    }

    public function updateUser(int $id)
    {
        // MessageEnum == MENSAGENS PREDEFINIDAS PARA EVITAR REPETIÇÃO DE CÓDIGO
        $message = MessageEnum::SUCCESS_CREATED;

        try {
            // User::fill == função utilizada para atualizar os dados
            $query = User::findOrFail($id);
            $query::fill([
                'name' => $this->name,
                'cpf' => $this->cpf,
                'ctps' => $this->ctps,
                'pis' => $this->pis,
                'company_id' => $this->company_id,
                'role_id' => $this->role_id,
            ]);

            return ['id' => $query->id, 'message' => $message];
        } catch (Exception $th) {
            throw new Exception(MessageEnum::FAILURE_UPDATED);
        }
    }
}