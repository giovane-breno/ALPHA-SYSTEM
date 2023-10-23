<?php

namespace App\Http\Services\Benefit;

use App\Enums\MessageEnum;
use App\Http\Resources\Benefit\BenefitCollection;
use App\Models\Benefit;
use Exception;

class ListActiveBenefitsService
{
    public function listBenefit()
    {
        // MessageEnum == MENSAGENS PREDEFINIDAS PARA EVITAR REPETIÇÃO DE CÓDIGO
        try {
            // filter() -- para pegar os filtros, como filtrar por cargo
            // orderByDesc -- para ordernar por id
            // paginate(10) -- para pegar somente 10 resultados por vez
            $active = Benefit::filter()->orderByDesc('id')->paginate(10);
            return new BenefitCollection($active);
        } catch (Exception $th) {
            throw new Exception(MessageEnum::FAILURE_FIND);
        }
    }
}