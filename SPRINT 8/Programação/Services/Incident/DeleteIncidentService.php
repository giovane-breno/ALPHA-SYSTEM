<?php

namespace App\Http\Services\Incident;

use App\Enums\MessageEnum;
use App\Models\Incident;
use Exception;

class DeleteIncidentService
{
    public function deleteIncident(int $id)
    {
        $message = MessageEnum::SUCCESS_DELETED;
        try {
            $user = Incident::findOrFail($id);
            $user->delete();

            return ['message' => $message];
        } catch (Exception $th) {
            throw new Exception(MessageEnum::FAILURE_DELETED);
        }
    }
}