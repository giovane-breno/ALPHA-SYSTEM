<?php

namespace App\Http\Services\Vacation;

use App\Enums\MessageEnum;
use App\Http\Resources\Vacation\VacationCollection;
use App\Models\Vacation;
use Exception;

class ListActiveVacationsService
{
    public function listVacations()
    {
        // MessageEnum == MENSAGENS PREDEFINIDAS PARA EVITAR REPETIÇÃO DE CÓDIGO
        try {
            // filter() -- para pegar os filtros, como filtrar por cargo
            // orderByDesc -- para ordernar por id
            // paginate(10) -- para pegar somente 10 resultados por vez
            $active = Vacation::filter()->orderByDesc('id')->paginate(10);
            return new VacationCollection($active);
        } catch (Exception $th) {
            throw new Exception(MessageEnum::FAILURE_FIND);
        }
    }


    public function listVacationsByUserId(int $id)
    {
        try {
            // orderByDesc -- para ordernar por id
            // paginate(10) -- para pegar somente 10 resultados por vez
            $active = Vacation::whereUserId($id)->orderByDesc('id')->paginate(10);
            return new VacationCollection($active);
        } catch (Exception $th) {
            throw new Exception(MessageEnum::FAILURE_FIND);
        }
    }
    
}