<?php

namespace App\Http\Services\User;

use App\Enums\MessageEnum;
use App\Http\Resources\User\UserResource;
use App\Models\User;
use Exception;

class DeleteUserService
{
    public function deleteUser(int $id)
    {
        $message = MessageEnum::SUCCESS_DELETED;
        try {
            $user = User::findOrFail($id);
            $user->delete();

            return ['message' => $message];
        } catch (Exception $th) {
            throw new Exception(MessageEnum::FAILURE_DELETED);
        }
    }
}