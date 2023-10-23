<?php

namespace App\Http\Services\AdminRole;

use App\Enums\MessageEnum;
use App\Models\AdminRole;
use Exception;

class UpdateAdminRoleService
{
    protected $name;
    protected $abilities;

    public function __construct(
        $name,
        $abilities,
    ) {
        $this->name = $name;
        $this->abilities = $abilities;
    }

    public function updateAdminRole(int $id)
    {
        // MessageEnum == MENSAGENS PREDEFINIDAS PARA EVITAR REPETIÇÃO DE CÓDIGO
        $message = MessageEnum::SUCCESS_CREATED;

        try {
            // User::fill == função utilizada para atualizar os dados
            $query = AdminRole::findOrFail($id);
            $query::fill([
                'name' => $this->name,
                'abilities' => $this->abilities,
            ]);

            return ['message' => $message];
        } catch (Exception $th) {
            throw new Exception(MessageEnum::FAILURE_UPDATED);
        }
    }
}