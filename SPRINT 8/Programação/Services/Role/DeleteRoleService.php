<?php

namespace App\Http\Services\Role;

use App\Enums\MessageEnum;
use App\Models\Role;
use Exception;

class DeleteRoleService
{
    public function deleteRole(int $id)
    {
        $message = MessageEnum::SUCCESS_DELETED;
        try {
            $query = Role::findOrFail($id);
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
        $table = 'Cargos';

        $query = $model->exams()->exists();

        if ($query) {
            $relations = $model->exams()->get(['id', 'created_at']);
            return ['message' => $message, 'table' => $table, $relations];
        }

        return false;
    }
}