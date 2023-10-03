<?php

namespace App\Http\Services\User;

use App\Enums\MessageEnum;
use App\Http\Resources\User\UserResource;
use App\Models\User;
use Exception;

class FindUserService
{
    public function findUser(int $id)
    {
        try {
            $user = User::findOrFail($id);
            return new UserResource($user);
        } catch (Exception $th) {
            throw new Exception(MessageEnum::FAILURE_FIND);
        }
    }
}