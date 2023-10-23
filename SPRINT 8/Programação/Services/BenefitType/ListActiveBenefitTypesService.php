<?php

namespace App\Http\Services\BenefitType;

use App\Enums\MessageEnum;
use App\Http\Resources\BenefitType\BenefitTypeCollection;
use App\Models\BenefitType;
use App\Models\Company;
use Exception;

class ListActiveBenefitTypesService
{
    public function listBenefitTypes()
    {
        // MessageEnum == MENSAGENS PREDEFINIDAS PARA EVITAR REPETIÇÃO DE CÓDIGO
        try {
            // filter() -- para pegar os filtros, como filtrar por cargo
            // orderByDesc -- para ordernar por id
            // paginate(10) -- para pegar somente 10 resultados por vez
            $active = BenefitType::orderByDesc('id')->paginate(10);
            return new BenefitTypeCollection($active);
        } catch (Exception $th) {
            throw new Exception(MessageEnum::FAILURE_FIND);
        }
    }
}