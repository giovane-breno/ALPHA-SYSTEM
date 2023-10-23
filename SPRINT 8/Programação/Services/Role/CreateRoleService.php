<?php

namespace App\Http\Services\Role;

use App\Enums\MessageEnum;
use App\Models\Role;
use Exception;

class CreateRoleService
{
    protected $name;
    protected $base_salary;

    public function __construct(
        $name,
        $base_salary,

    ) {
        $this->name = $name;
        $this->base_salary = $base_salary;
    }

    public function createRole()
    {
        // MessageEnum == MENSAGENS PREDEFINIDAS PARA EVITAR REPETIÇÃO DE CÓDIGO
        $message = MessageEnum::SUCCESS_CREATED;

        try {
            // Division::create == função utilizada para salvar os dados no banco de dados.
            $query = Role::create([
                'name' => $this->name,
                'base_salary' => $this->base_salary
            ]);

            return ['id' => $query->id, 'message' => $message];
        } catch (Exception $th) {
            throw new Exception(MessageEnum::FAILURE_CREATED );
        }
    }
}