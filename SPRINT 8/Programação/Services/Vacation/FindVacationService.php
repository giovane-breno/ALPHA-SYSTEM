<?php

namespace App\Http\Services\Vacation;

use App\Enums\MessageEnum;
use App\Http\Resources\Vacation\VacationResource;
use App\Models\Vacation;
use Exception;

class FindVacationService
{
    public function findVacation(int $id)
    {
        try {
            $query = Vacation::findOrFail($id);
            return new VacationResource($query);
        } catch (Exception $th) {
            throw new Exception(MessageEnum::FAILURE_FIND);
        }
    }
}