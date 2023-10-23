<?php

namespace App\Http\Services\Benefit;

use App\Enums\MessageEnum;
use App\Http\Resources\User\UserResource;
use App\Models\Benefit;
use App\Models\User;
use Exception;

class DeleteBenefitService
{
    public function deleteBenefit(int $id)
    {
        $message = MessageEnum::SUCCESS_DELETED;
        try {
            $query = Benefit::findOrFail($id);
            $query->delete();

            return ['message' => $message];
        } catch (Exception $th) {
            throw new Exception(MessageEnum::FAILURE_DELETED);
        }
    }
}