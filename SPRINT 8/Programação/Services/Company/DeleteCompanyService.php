<?php

namespace App\Http\Services\Company;

use App\Enums\MessageEnum;
use App\Http\Resources\User\UserResource;
use App\Models\Company;
use App\Models\User;
use Exception;

class DeleteCompanyService
{
    public function deleteCompany(int $id)
    {
        $message = MessageEnum::SUCCESS_DELETED;
        try {
            $query = Company::findOrFail($id);
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
        $table = 'Empresas';

        $query = $model->exams()->exists();

        if ($query) {
            $relations = $model->exams()->get(['id', 'created_at']);
            return ['message' => $message, 'table' => $table, $relations];
        }

        return false;
    }
}