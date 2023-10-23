<?php

namespace App\Http\Services\Finance;

use App\Enums\MessageEnum;
use App\Http\Resources\Benefit\BenefitCollection;
use App\Http\Resources\Payroll\PayrollCollection;
use App\Models\Benefit;
use App\Models\Payroll;
use Exception;

class ListActivePayrollsService
{
    public function listPayrolls()
    {
        // MessageEnum == MENSAGENS PREDEFINIDAS PARA EVITAR REPETIÇÃO DE CÓDIGO
        try {
            // filter() -- para pegar os filtros, como filtrar por cargo
            // orderByDesc -- para ordernar por id
            // paginate(10) -- para pegar somente 10 resultados por vez
            $active = Payroll::filter()->orderByDesc('id')->paginate(10);
            return new PayrollCollection($active);
        } catch (Exception $th) {
            throw new Exception(MessageEnum::FAILURE_FIND);
        }
    }
}