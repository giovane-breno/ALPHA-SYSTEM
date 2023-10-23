<?php

namespace App\Http\Services\Gratification;

use App\Enums\MessageEnum;
use App\Http\Resources\Gratification\GratificationResource;
use App\Models\Gratification;
use Exception;

class FindGratificationService
{
    public function findGratification(int $id)
    {
        try {
            $query = Gratification::findOrFail($id);
            return new GratificationResource($query);
        } catch (Exception $th) {
            throw new Exception(MessageEnum::FAILURE_FIND);
        }
    }
}