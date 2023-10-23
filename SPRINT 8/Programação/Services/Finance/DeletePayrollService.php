<?php

namespace App\Http\Services\Finance;

use App\Enums\MessageEnum;
use App\Models\Payroll;
use Exception;

class DeletePayrollService
{
    public function deletePayroll(int $id)
    {
        $message = MessageEnum::SUCCESS_DELETED;
        try {
            $query = Payroll::findOrFail($id);
            $query->delete();

            return ['message' => $message];

        } catch (Exception $th) {
            throw new Exception(MessageEnum::FAILURE_DELETED);
        }
    }

}