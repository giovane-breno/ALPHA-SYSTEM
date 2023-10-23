<?php

namespace App\Http\Services\Incident;

use App\Enums\MessageEnum;
use App\Models\Incident;
use Exception;

class CreateIncidentService
{
    protected $user_id;
    protected $incident_reason;
    protected $discounted_amount;
    protected $start_date;
    protected $end_date;

    public function __construct(
        $user_id,
        $incident_reason,
        $discounted_amount,
        $start_date,
        $end_date,
    ) {
        $this->user_id = $user_id;
        $this->incident_reason = $incident_reason;
        $this->discounted_amount = $discounted_amount;
        $this->start_date = $start_date;
        $this->end_date = $end_date;
    }

    public function createIncident()
    {
        // MessageEnum == MENSAGENS PREDEFINIDAS PARA EVITAR REPETIÇÃO DE CÓDIGO
        $message = MessageEnum::SUCCESS_CREATED;

        try {
            // User::create == função utilizada para salvar os dados no banco de dados.
            Incident::create([
                'user_id' => $this->user_id,
                'incident_reason' => $this->incident_reason,
                'discounted_amount' => $this->discounted_amount,
                'start_date' => $this->start_date,
                'end_date' => $this->end_date,
            ]);

            return ['message' => $message];
        } catch (Exception $th) {
            throw new Exception(MessageEnum::FAILURE_CREATED);
        }
    }
}