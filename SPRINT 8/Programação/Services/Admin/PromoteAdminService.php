<?php

namespace App\Http\Services\Admin;

use App\Enums\MessageEnum;
use App\Models\Admin;
use Exception;

class PromoteAdminService
{
    protected $user_id;
    protected $admin_role_id;

    public function __construct(
        $user_id,
        $admin_role_id,
    ) {
        $this->user_id = $user_id;
        $this->admin_role_id = $admin_role_id;
    }

    public function promoteAdmin()
    {
        // MessageEnum == MENSAGENS PREDEFINIDAS PARA EVITAR REPETIÇÃO DE CÓDIGO
        $message = MessageEnum::SUCCESS_CREATED;

        try {
            // Admin::create == função utilizada para salvar os dados no banco de dados.
            Admin::updateOrCreate([
                'user_id' => $this->user_id,
            ],
            [
                'admin_role_id' => $this->admin_role_id,
            ]);

            return ['message' => $message];
        } catch (Exception $th) {
            throw new Exception(MessageEnum::FAILURE_CREATED.$th);
        }
    }
}