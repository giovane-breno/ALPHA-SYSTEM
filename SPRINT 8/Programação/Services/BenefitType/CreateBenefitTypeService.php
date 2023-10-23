<?php

namespace App\Http\Services\BenefitType;

use App\Enums\MessageEnum;
use App\Models\Company;
use Exception;

class CreateBenefitTypeService
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

    public function createBenefitType()
    {
        // MessageEnum == MENSAGENS PREDEFINIDAS PARA EVITAR REPETIÇÃO DE CÓDIGO
        $message = MessageEnum::SUCCESS_CREATED;

        try {
            // User::create == função utilizada para salvar os dados no banco de dados.
            Company::create([
                'name' => $this->name,
                'corporate_name' => $this->bonus,
            ]);

            return ['message' => $message];
        } catch (Exception $th) {
            throw new Exception(MessageEnum::FAILURE_CREATED);
        }
    }
}