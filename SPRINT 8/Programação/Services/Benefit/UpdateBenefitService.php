<?php

namespace App\Http\Services\Benefit;

use App\Enums\MessageEnum;
use App\Models\Benefit;
use Exception;

class UpdateBenefitService
{
    protected $user_id;
    protected $benefit_id;

    public function __construct(
        $user_id,
        $benefit_id,
    ) {
        $this->user_id = $user_id;
        $this->benefit_id = $benefit_id;
    }

    public function updateBenefit(int $id)
    {
        // MessageEnum == MENSAGENS PREDEFINIDAS PARA EVITAR REPETIÇÃO DE CÓDIGO
        $message = MessageEnum::SUCCESS_CREATED;

        try {
            // User::fill == função utilizada para atualizar os dados
            $query = Benefit::findOrFail($id);
            $query::fill([
                'user_id' => $this->user_id,
                'benefit_id' => $this->benefit_id,
            ]);

            return ['message' => $message];
        } catch (Exception $th) {
            throw new Exception(MessageEnum::FAILURE_UPDATED);
        }
    }
}