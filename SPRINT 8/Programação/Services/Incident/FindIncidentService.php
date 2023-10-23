<?php

namespace App\Http\Services\Incident;

use App\Enums\MessageEnum;
use App\Http\Resources\Incident\IncidentResource;
use App\Models\Incident;
use Exception;

class FindIncidentService
{
    public function findIncident(int $id)
    {
        try {
            $query = Incident::findOrFail($id);
            return new IncidentResource($query);
        } catch (Exception $th) {
            throw new Exception(MessageEnum::FAILURE_FIND);
        }
    }
}