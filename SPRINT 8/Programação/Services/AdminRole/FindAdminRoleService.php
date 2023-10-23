<?php

namespace App\Http\Services\AdminRole;

use App\Enums\MessageEnum;
use App\Http\Resources\AdminRole\AdminRoleResource;
use App\Http\Resources\Benefit\BenefitCollection;
use App\Models\AdminRole;
use Exception;

class FindAdminRoleService
{

    public function findAdminRole(int $id)
    {
        try {
            $query = AdminRole::findOrFail($id);
            return new AdminRoleResource($query);
        } catch (Exception $th) {
            throw new Exception(MessageEnum::FAILURE_FIND);
        }
    }
}