<?php

namespace App\Http\Services\Division;

use App\Enums\MessageEnum;
use App\Models\Division;
use App\Models\User;
use Exception;

class UpdateDivisionService
{
    protected $name;
    protected $bonus;

    public function __construct(
        $name,
        $bonus,
    ) {
        $this->name = $name;
        $this->bonus = $bonus;
    }

    public function updateDivision(int $id)
    {
        // MessageEnum == MENSAGENS PREDEFINIDAS PARA EVITAR REPETIÇÃO DE CÓDIGO
        $message = MessageEnum::SUCCESS_CREATED;

        try {
            // Division::fill == função utilizada para atualizar os dados
            $query = Division::findOrFail($id);
            $query::fill([
                'name' => $this->name,
                'bonus' => $this->bonus,
            ]);

            return ['id' => $query->id, 'message' => $message];
        } catch (Exception $th) {
            throw new Exception(MessageEnum::FAILURE_UPDATED);
        }
    }
}