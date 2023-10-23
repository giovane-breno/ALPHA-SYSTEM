<?php

namespace App\Http\Services\Vacation;

use App\Enums\MessageEnum;
use App\Models\Vacation;
use Exception;

class DeleteVacationService
{
    public function deleteVacation(int $id)
    {
        $message = MessageEnum::SUCCESS_DELETED;
        try {
            $user = Vacation::findOrFail($id);
            $user->delete();

            return ['message' => $message];
        } catch (Exception $th) {
            throw new Exception(MessageEnum::FAILURE_DELETED);
        }
    }
}