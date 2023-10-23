<?php

namespace App\Http\Services\Gratification;

use App\Enums\MessageEnum;
use App\Http\Resources\Gratification\GratificationCollection;
use App\Models\Gratification;
use Exception;

class ListActiveGratificationsService
{
    public function listGratifications()
    {
        // MessageEnum == MENSAGENS PREDEFINIDAS PARA EVITAR REPETIÇÃO DE CÓDIGO
        try {
            // filter() -- para pegar os filtros, como filtrar por cargo
            // orderByDesc -- para ordernar por id
            // paginate(10) -- para pegar somente 10 resultados por vez
            $active = Gratification::filter()->orderByDesc('id')->paginate(10);
            return new GratificationCollection($active);
        } catch (Exception $th) {
            throw new Exception(MessageEnum::FAILURE_FIND);
        }
    }


    public function listGratificationsByUserId(int $id)
    {
        try {
            // orderByDesc -- para ordernar por id
            // paginate(10) -- para pegar somente 10 resultados por vez
            $active = Gratification::whereUserId($id)->orderByDesc('id')->paginate(10);
            return new GratificationCollection($active);
        } catch (Exception $th) {
            throw new Exception(MessageEnum::FAILURE_FIND);
        }
    }

}