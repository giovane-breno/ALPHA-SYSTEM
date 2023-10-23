<?php

namespace App\Http\Services\Role;

use App\Enums\MessageEnum;
use App\Http\Resources\Role\RoleCollection;
use App\Models\Division;
use App\Models\Role;
use Exception;

class ListActiveRolesService
{
    public function listRoles()
    {
        // MessageEnum == MENSAGENS PREDEFINIDAS PARA EVITAR REPETIÇÃO DE CÓDIGO
        try {
            // filter() -- para pegar os filtros, como filtrar por cargo
            // orderByDesc -- para ordernar por id
            // paginate(10) -- para pegar somente 10 resultados por vez
            $active = Role::filter()->orderByDesc('id')->paginate(10);
            return new RoleCollection($active);
        } catch (Exception $th) {
            throw new Exception(MessageEnum::FAILURE_FIND);
        }
    }
}