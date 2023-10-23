<?php

namespace App\Http\Services\Benefit;

use App\Enums\MessageEnum;
use App\Http\Resources\Benefit\BenefitCollection;
use App\Models\Benefit;
use Exception;

class FindBenefitService
{

    public function findBenefit(int $id)
    {
        try {
            $query = Benefit::whereUserId($id)->paginate(10);
            return new BenefitCollection($query);
        } catch (Exception $th) {
            throw new Exception(MessageEnum::FAILURE_FIND);
        }
    }
}