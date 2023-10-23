<?php

namespace App\Http\Services\AdminRole;

use App\Enums\MessageEnum;
use App\Http\Resources\AdminRole\AdminRoleCollection;
use App\Models\AdminRole;
use Exception;

class ListActiveAdminRolesService
{
    public function listAdminRoles()
    {
        // MessageEnum == MENSAGENS PREDEFINIDAS PARA EVITAR REPETIÇÃO DE CÓDIGO
        try {
            // filter() -- para pegar os filtros, como filtrar por cargo
            // orderByDesc -- para ordernar por id
            // paginate(10) -- para pegar somente 10 resultados por vez
            $active = AdminRole::orderByDesc('id')->paginate(10);
            return new AdminRoleCollection($active);
        } catch (Exception $th) {
            throw new Exception(MessageEnum::FAILURE_FIND);
        }
    }
}