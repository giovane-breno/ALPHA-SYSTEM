<?php

namespace App\Http\Services\Gratification;

use App\Enums\MessageEnum;
use App\Models\Gratification;
use Exception;

class CreateGratificationService
{
    protected $user_id;
    protected $gratification_reason;
    protected $bonus;
    protected $start_date;
    protected $end_date;

    public function __construct(
        $user_id,
        $gratification_reason,
        $bonus,
        $start_date,
        $end_date,
    ) {
        $this->user_id = $user_id;
        $this->gratification_reason = $gratification_reason;
        $this->bonus = $bonus;
        $this->start_date = $start_date;
        $this->end_date = $end_date;
    }

    public function createGratification()
    {
        // MessageEnum == MENSAGENS PREDEFINIDAS PARA EVITAR REPETIÇÃO DE CÓDIGO
        $message = MessageEnum::SUCCESS_CREATED;

        try {
            // User::create == função utilizada para salvar os dados no banco de dados.
            Gratification::create([
                'user_id' => $this->user_id,
                'gratification_reason' => $this->gratification_reason,
                'bonus' => $this->bonus,
                'start_date' => $this->start_date,
                'end_date' => $this->end_date,
            ]);

            return ['message' => $message];
        } catch (Exception $th) {
            throw new Exception(MessageEnum::FAILURE_CREATED);
        }
    }
}