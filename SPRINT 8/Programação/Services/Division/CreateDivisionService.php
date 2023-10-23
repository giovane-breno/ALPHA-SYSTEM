<?php

namespace App\Http\Services\Division;

use App\Enums\MessageEnum;
use App\Models\Address;
use App\Models\Division;
use App\Models\Phone;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Hash;

class CreateDivisionService
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

    public function createDivision()
    {
        // MessageEnum == MENSAGENS PREDEFINIDAS PARA EVITAR REPETIÇÃO DE CÓDIGO
        $message = MessageEnum::SUCCESS_CREATED;

        try {
            // Division::create == função utilizada para salvar os dados no banco de dados.
            $query = Division::create([
                'name' => $this->name,
                'bonus' => $this->bonus
            ]);

            return ['id' => $query->id, 'message' => $message];
        } catch (Exception $th) {
            throw new Exception(MessageEnum::FAILURE_CREATED );
        }
    }
}