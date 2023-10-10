<?php

namespace App\Http\Services\Finance;

use App\Enums\MessageEnum;
use App\Models\Payroll;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use stdClass;

class doPaymentService
{
    public function doPayment()
    {
        // MessageEnum == MENSAGENS PREDEFINIDAS PARA EVITAR REPETIÇÃO DE CÓDIGO
        $message = MessageEnum::SUCCESS_CREATED;
        $success = 0;
        $fail = 0;

        try {
            $userList = User::get(['id']);
            foreach ($userList as $id) {
                $userData = ($this->getUserData($id));
                if ($this->checkPayrollPeriod($id)) {
                    Payroll::create([
                        'company_id' => $userData->company_id,
                        'user_id' => $userData->user_id,
                        'full_name' => $userData->full_name,
                        'role' => $userData->role,
                        'base_salary' => $userData->base_salary,
                        'bonus' => $userData->bonus,
                        'benefits' => $userData->benefits,
                        'vacation' => $userData->vacation,
                        'discounts' => $userData->discounts,
                        'gross_salary' => $userData->gross_salary,
                        'net_salary' => $userData->net_salary,
                    ]);
                    $success++; // CONTAGEM DE PESSOAS QUE FORAM GERADAS
                } else {
                    $fail++; // CONTAGEM DE PESSOAS QUE NAO FORAM GERADAS
                }
            }

            return ['message' => $message, 'users' => ['generated' => $success, 'not generated' => $fail]];



        } catch (Exception $th) {
            throw new Exception(MessageEnum::FAILURE_CREATED . $th);
        }


    }

    public function getUserData($id)
    {
        $query = User::with('Role', 'Division', 'Company', 'Gratifications', 'Incidents', 'Vacations:user_id,bonus', 'Benefits')->findOrFail($id)->first();
        $discount = ($this->sumIncidents($query->incidents));
        $base_salary = $query->role->base_salary + $query->division->bonus;
        $bonus = ($this->sumGratifications($query->gratifications));
        $vacation = ($this->getUserVacation($query->vacations));
        $benefits = ($this->sumBenefits($query->benefits));
        $gross_salary = $query->role->base_salary + $query->division->bonus + $bonus + $vacation + $benefits;
        $net_salary = round($gross_salary - $discount, 2);

        $userData = new stdClass;
        $userData->company_id = $query->company->id;
        $userData->user_id = $query->id;
        $userData->full_name = $query->full_name;
        $userData->role = $query->role->name;
        $userData->base_salary = $base_salary;
        $userData->bonus = $bonus;
        $userData->benefits = $benefits;
        $userData->vacation = $vacation;
        $userData->discounts = $discount;
        $userData->gross_salary = $gross_salary;
        $userData->net_salary = $net_salary;

        return $userData;
    }

    private function getUserVacation($vacation)
    {
        if (!empty($vacation[0])) {
            return round(floatval($vacation[0]->bonus), 2);
        } else {
            return 0;
        }
    }

    private function sumIncidents($incidents_array)
    {
        $total = 0;
        $incidents_array = $incidents_array->pluck('discounted_amount');
        foreach ($incidents_array as $incident) {
            $total += floatval($incident);
        }

        return round($total, 2);
    }

    private function sumGratifications($gratifications_array)
    {
        $total = 0;
        $gratifications_array = $gratifications_array->pluck('bonus');
        foreach ($gratifications_array as $gratification) {
            $total += floatval($gratification);
        }

        return round($total, 2);

    }

    private function sumBenefits($benefits_array)
    {
        $total = 0;

        foreach ($benefits_array as $benefit) {
            $bonus = optional($benefit->benefitsType)->bonus;
            if (!is_null($bonus)) {
                $total += floatval($bonus);
            }
        }

        return $total;
    }

    private function checkPayrollPeriod($id)
    {
        try {
            $query = Payroll::orderBy('created_at', 'desc')->whereUserId($id->id)->firstOrFail()->created_at;
            if (!(Carbon::now()->isSameMonth($query))) {
                return True;
            } else {
                return False;
            }
        } catch (ModelNotFoundException $e) {
            return True;
        }
    }
}