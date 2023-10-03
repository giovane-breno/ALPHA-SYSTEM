<?php

namespace App\Http\Services\User;

use App\Enums\MessageEnum;
use App\Http\Resources\User\UserCollection;
use App\Models\User;
use Carbon\Carbon;
use Exception;

class ListActiveUsersService
{
    public function listUsers()
    {
        // MessageEnum == MENSAGENS PREDEFINIDAS PARA EVITAR REPETIÇÃO DE CÓDIGO
        try {
            // filter() -- para pegar os filtros, como filtrar por cargo
            // orderByDesc -- para ordernar por id
            // paginate(10) -- para pegar somente 10 resultados por vez
            $active = User::filter()->orderByDesc('id')->paginate(10);
            return new UserCollection($active);
        } catch (Exception $th) {
            throw new Exception(MessageEnum::FAILURE_FIND.$th);
        }
    }
}