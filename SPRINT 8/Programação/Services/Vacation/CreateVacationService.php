<?php

namespace App\Http\Services\Vacation;

use App\Enums\MessageEnum;
use App\Http\Services\Finance\DoPaymentService;
use App\Models\Vacation;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Carbon;

class CreateVacationService extends DoPaymentService
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

    public function createVacation()
    {
        // MessageEnum == MENSAGENS PREDEFINIDAS PARA EVITAR REPETIÇÃO DE CÓDIGO
        $message = MessageEnum::SUCCESS_CREATED;

        try {
            // User::create == função utilizada para salvar os dados no banco de dados.
            if ($this->checkVacationActive($this->user_id)) {
                $query = Vacation::create([
                    'user_id' => $this->user_id,
                    'bonus' => $this->calculateBonus($this->user_id),
                    'start_date' => $this->start_date,
                    'end_date' => $this->end_date,
                ]);
            } else {
                return ['message' => 'Usuário já está de férias no período escolhido.'];
            }


            return ['id' => $query->id, 'message' => $message];
        } catch (Exception $th) {
            throw new Exception(MessageEnum::FAILURE_CREATED);
        }
    }

    private function calculateBonus(int $id)
    {
        $userData = ($this->getUserData($id));
        $bonus = ($userData->gross_salary * 0.3);

        return $bonus;
    }

    private function checkVacationActive(int $id)
    {
        try {
            $query = Vacation::orderBy('created_at', 'desc')->whereUserId($id)->firstOrFail();

            $start_date = $query->start_date;
            $end_date = $query->end_date;

            if (!(Carbon::now()->between($start_date, $end_date))) {
                return True;
            } else {
                return False;
            }
        } catch (ModelNotFoundException $e) {
            return True;
        }
    }
}