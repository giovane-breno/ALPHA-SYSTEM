<?php

namespace App\Http\Services\BenefitType;

use App\Enums\MessageEnum;
use App\Models\BenefitType;
use Exception;

class UpdateBenefitTypeService
{
    protected $name;
    protected $bonus;

    public function __construct(
        $name,
        $bonus,
    ) {
        $this->name = $name;
        $this->bonus = $bonus;
    }

    public function updateBenefitType(int $id)
    {
        // MessageEnum == MENSAGENS PREDEFINIDAS PARA EVITAR REPETIÇÃO DE CÓDIGO
        $message = MessageEnum::SUCCESS_CREATED;

        try {
            // User::fill == função utilizada para atualizar os dados
            $query = BenefitType::findOrFail($id);
            $query::fill([
                'name' => $this->name,
                'corporate_name' => $this->bonus,
            ]);

            return ['id' => $query->id, 'message' => $message];
        } catch (Exception $th) {
            throw new Exception(MessageEnum::FAILURE_UPDATED);
        }
    }
}