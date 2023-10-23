<?php

namespace App\Http\Services\Company;

use App\Enums\MessageEnum;
use App\Models\Address;
use App\Models\Company;
use App\Models\CompanyAddress;
use App\Models\Phone;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Hash;

class CreateCompanyService
{
    protected $name;
    protected $corporate_name;
    protected $CNPJ;
    protected $town_registration;
    protected $state_registration;

    protected $address;

    public function __construct(
        $name,
        $corporate_name,
        $CNPJ,
        $town_registration,
        $state_registration,

        $address,
    ) {
        $this->name = $name;
        $this->corporate_name = $corporate_name;
        $this->CNPJ = $CNPJ;
        $this->town_registration = $town_registration;
        $this->state_registration = $state_registration;

        $this->address = $address;
    }

    public function createCompany()
    {
        // MessageEnum == MENSAGENS PREDEFINIDAS PARA EVITAR REPETIÇÃO DE CÓDIGO
        $message = MessageEnum::SUCCESS_CREATED;

        try {
            // User::create == função utilizada para salvar os dados no banco de dados.
            $query = Company::create([
                'name' => $this->name,
                'corporate_name' => $this->corporate_name,
                'CNPJ' => $this->CNPJ,
                'town_registration' => $this->town_registration,
                'state_registration' => $this->state_registration,
            ]);

            ($this->saveAddress($this->address));

            return ['message' => $message];
        } catch (Exception $th) {
            throw new Exception(MessageEnum::FAILURE_CREATED);
        }
    }

    private function saveAddress($address)
    {
        try {
            $query = CompanyAddress::create([
                'CEP' => $address->cep,
                'street' => $address->street,
                'district' => $address->district,
                'house_number' => $address->house_number,
                'complement' => $address->complement,
                'references' => $address->references
            ]);

            if ($query)
                return True;

        } catch (Exception $e) {
            throw new Exception(MessageEnum::FAILURE_CREATED . $e);
        }
    }
}