<?php

namespace App\Http\Services\AdminRole;

use App\Enums\MessageEnum;
use App\Models\AdminRole;
use Exception;

class DeleteAdminRoleService
{
    public function deleteAdminRole(int $id)
    {
        $message = MessageEnum::SUCCESS_DELETED;
        try {
            $query = AdminRole::findOrFail($id);
            $query->delete();

            return ['message' => $message];
        } catch (Exception $th) {
            throw new Exception(MessageEnum::FAILURE_DELETED);
        }
    }
}