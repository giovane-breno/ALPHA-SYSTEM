<?php

namespace App\Http\Services\Gratification;

use App\Enums\MessageEnum;
use App\Models\Gratification;
use Exception;

class DeleteGratificationService
{
    public function deleteGratification(int $id)
    {
        $message = MessageEnum::SUCCESS_DELETED;
        try {
            $user = Gratification::findOrFail($id);
            $user->delete();

            return ['message' => $message];
        } catch (Exception $th) {
            throw new Exception(MessageEnum::FAILURE_DELETED);
        }
    }
}