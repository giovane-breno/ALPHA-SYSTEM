<?php

namespace App\Http\Services\BenefitType;

use App\Enums\MessageEnum;
use App\Models\BenefitType;
use App\Models\User;
use Exception;

class DeleteBenefitTypeService
{
    public function deleteBenefitType(int $id)
    {
        $message = MessageEnum::SUCCESS_DELETED;
        try {
            $query = BenefitType::findOrFail($id);
            $relations = $this->checkRelations($query);

            if (!($relations)) {
                $query->delete();
                return ['message' => $message];
            }

            return $relations;
        } catch (Exception $th) {
            throw new Exception(MessageEnum::FAILURE_DELETED);
        }
    }

    private function checkRelations($model)
    {
        $message = MessageEnum::ATTR_RELATION;
        $table = 'Tipos de Benefícios';

        $query = $model->exams()->exists();

        if ($query) {
            $relations = $model->exams()->get(['id', 'created_at']);
            return ['message' => $message, 'table' => $table, $relations];
        }

        return false;
    }
}