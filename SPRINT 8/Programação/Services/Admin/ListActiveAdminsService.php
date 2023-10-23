<?php

namespace App\Http\Services\Admin;

use App\Enums\MessageEnum;
use App\Http\Resources\Admin\AdminCollection;
use App\Models\Admin;
use Exception;

class ListActiveAdminsService
{
    public function listAdmins()
    {
        // MessageEnum == MENSAGENS PREDEFINIDAS PARA EVITAR REPETIÇÃO DE CÓDIGO
        try {
            // filter() -- para pegar os filtros, como filtrar por cargo
            // orderByDesc -- para ordernar por id
            // paginate(10) -- para pegar somente 10 resultados por vez
            $active = Admin::filter()->orderByDesc('id')->paginate(10);
            return new AdminCollection($active);
        } catch (Exception $th) {
            throw new Exception(MessageEnum::FAILURE_FIND);
        }
    }
}