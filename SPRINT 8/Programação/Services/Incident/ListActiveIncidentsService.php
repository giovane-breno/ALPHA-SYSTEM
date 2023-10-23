<?php

namespace App\Http\Services\Incident;

use App\Enums\MessageEnum;
use App\Http\Resources\Incident\IncidentCollection;
use App\Models\Incident;
use Exception;

class ListActiveIncidentsService
{
    public function listIncidents()
    {
        // MessageEnum == MENSAGENS PREDEFINIDAS PARA EVITAR REPETIÇÃO DE CÓDIGO
        try {
            // filter() -- para pegar os filtros, como filtrar por cargo
            // orderByDesc -- para ordernar por id
            // paginate(10) -- para pegar somente 10 resultados por vez
            $active = Incident::filter()->orderByDesc('id')->paginate(10);
            return new IncidentCollection($active);
        } catch (Exception $th) {
            throw new Exception(MessageEnum::FAILURE_FIND);
        }
    }
}