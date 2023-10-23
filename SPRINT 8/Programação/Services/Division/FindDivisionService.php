<?php

namespace App\Http\Services\Division;

use App\Enums\MessageEnum;
use App\Http\Resources\Division\DivisionResource;
use App\Http\Resources\User\UserResource;
use App\Models\Division;
use Exception;

class FindDivisionService
{
    public function findDivision(int $id)
    {
        try {
            $query = Division::findOrFail($id);
            return new DivisionResource($query);
        } catch (Exception $th) {
            throw new Exception(MessageEnum::FAILURE_FIND);
        }
    }
}