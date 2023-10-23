<?php

namespace App\Http\Services\Admin;

use App\Enums\MessageEnum;
use App\Models\Admin;
use Exception;

class DemoteAdminService
{
    public function demoteAdmin(int $id)
    {
        $message = MessageEnum::SUCCESS_DELETED;
        try {
            $query = Admin::findOrFail($id);
            $query->delete();

            return ['message' => $message];
        } catch (Exception $th) {
            throw new Exception(MessageEnum::FAILURE_DELETED.$th);
        }
    }
}