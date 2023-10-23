<?php

namespace App\Http\Services\Benefit;

use App\Enums\MessageEnum;
use App\Models\Benefit;
use Exception;

class CreateBenefitService
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

    public function createBenefit()
    {
        // MessageEnum == MENSAGENS PREDEFINIDAS PARA EVITAR REPETIÇÃO DE CÓDIGO
        $message = MessageEnum::SUCCESS_CREATED;

        try {
            // Benefit::create == função utilizada para salvar os dados no banco de dados.
            Benefit::create([
                'user_id' => $this->user_id,
                'benefit_id' => $this->benefit_id,
            ]);

            return ['message' => $message];
        } catch (Exception $th) {
            throw new Exception(MessageEnum::FAILURE_CREATED);
        }
    }
}