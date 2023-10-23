<?php

namespace App\Http\Services\Finance;

use App\Enums\MessageEnum;
use App\Http\Resources\Benefit\BenefitCollection;
use App\Http\Resources\Payroll\PayrollCollection;
use App\Models\Benefit;
use App\Models\Payroll;
use Exception;

class FindPayrollService
{

    public function findPayroll(int $id)
    {
        try {
            $query = Payroll::whereUserId($id)->paginate(10);
            return new PayrollCollection($query);
        } catch (Exception $th) {
            throw new Exception(MessageEnum::FAILURE_FIND);
        }
    }
}