<?php

namespace App\Http\Services\Division;

use App\Enums\MessageEnum;
use App\Http\Resources\Division\DivisionCollection;
use App\Models\Division;
use Carbon\Carbon;
use Exception;

class ListActiveDivisionsService
{
    public function listDivisions()
    {
        // MessageEnum == MENSAGENS PREDEFINIDAS PARA EVITAR REPETIÇÃO DE CÓDIGO
        try {
            // filter() -- para pegar os filtros, como filtrar por cargo
            // orderByDesc -- para ordernar por id
            // paginate(10) -- para pegar somente 10 resultados por vez
            $active = Division::filter()->orderByDesc('id')->paginate(10);
            return new DivisionCollection($active);
        } catch (Exception $th) {
            throw new Exception(MessageEnum::FAILURE_FIND.$th);
        }
    }
}