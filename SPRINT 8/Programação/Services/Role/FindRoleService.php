<?php

namespace App\Http\Services\Role;

use App\Enums\MessageEnum;
use App\Http\Resources\Role\RoleResource;
use App\Models\Role;
use Exception;

class FindRoleService
{
    public function findRole(int $id)
    {
        try {
            $query = Role::findOrFail($id);
            return new RoleResource($query);
        } catch (Exception $th) {
            throw new Exception(MessageEnum::FAILURE_FIND);
        }
    }
}