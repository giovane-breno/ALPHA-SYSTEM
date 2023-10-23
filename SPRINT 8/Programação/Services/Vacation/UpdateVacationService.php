<?php

namespace App\Http\Services\Vacation;

use App\Enums\MessageEnum;
use App\Models\Vacation;
use Exception;

class UpdateVacationService
{
    protected $user_id;
    protected $start_date;
    protected $end_date;

    public function __construct(
        $user_id,
        $start_date,
        $end_date,
    ) {
        $this->user_id = $user_id;
        $this->start_date = $start_date;
        $this->end_date = $end_date;
    }

    public function updateVacation(int $id)
    {
        // MessageEnum == MENSAGENS PREDEFINIDAS PARA EVITAR REPETIÇÃO DE CÓDIGO
        $message = MessageEnum::SUCCESS_CREATED;

        try {
            // Vacation::fill == função utilizada para atualizar os dados
            $query = Vacation::findOrFail($id);
            $query::fill([
                'user_id' => $this->user_id,
                'start_date' => $this->start_date,
                'end_date' => $this->end_date,
            ]);

            return ['id' => $query->id, 'message' => $message];
        } catch (Exception $th) {
            throw new Exception(MessageEnum::FAILURE_UPDATED);
        }
    }
}