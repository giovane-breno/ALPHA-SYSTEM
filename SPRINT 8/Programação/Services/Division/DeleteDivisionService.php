<?php

namespace App\Http\Services\Division;

use App\Enums\MessageEnum;
use App\Models\Division;
use Exception;

class DeleteDivisionService
{
    public function deleteDivision(int $id)
    {
        $message = MessageEnum::SUCCESS_DELETED;
        try {
            $query = Division::findOrFail($id);
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
        $table = 'Divisões';

        $query = $model->exams()->exists();

        if ($query) {
            $relations = $model->exams()->get(['id', 'created_at']);
            return ['message' => $message, 'table' => $table, $relations];
        }

        return false;
    }
}