<?php

namespace App\Http\Services\AdminRole;

use App\Enums\MessageEnum;
use App\Models\AdminRole;
use Exception;
class CreateAdminRolesService
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

    public function createAdminRole()
    {
        // MessageEnum == MENSAGENS PREDEFINIDAS PARA EVITAR REPETIÇÃO DE CÓDIGO
        $message = MessageEnum::SUCCESS_CREATED;

        try {
            // Benefit::create == função utilizada para salvar os dados no banco de dados.
            AdminRole::create([
                'name' => $this->name,
                'abilities' => $this->abilities,
            ]);

            return ['message' => $message];
        } catch (Exception $th) {
            throw new Exception(MessageEnum::FAILURE_CREATED);
        }
    }
}