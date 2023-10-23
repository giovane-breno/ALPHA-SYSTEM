<?php

namespace App\Http\Services\Admin;

use App\Enums\MessageEnum;
use App\Http\Resources\Admin\AdminCollection;
use App\Models\Admin;
use Exception;

class FindAdminService
{

    public function findAdmin(int $id)
    {
        try {
            $query = Admin::whereUserId($id)->paginate(10);
            return new AdminCollection($query);
        } catch (Exception $th) {
            throw new Exception(MessageEnum::FAILURE_FIND);
        }
    }
}