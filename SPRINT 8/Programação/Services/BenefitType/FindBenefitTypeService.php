<?php

namespace App\Http\Services\BenefitType;

use App\Enums\MessageEnum;
use App\Http\Resources\BenefitType\BenefitTypeResource;
use App\Models\BenefitType;
use Exception;

class FindBenefitTypeService
{
    public function findBenefitType(int $id)
    {
        try {
            $query = BenefitType::findOrFail($id);
            return new BenefitTypeResource($query);
        } catch (Exception $th) {
            throw new Exception(MessageEnum::FAILURE_FIND);
        }
    }
}