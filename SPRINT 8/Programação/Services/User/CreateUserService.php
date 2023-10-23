<?php

namespace App\Http\Services\User;

use App\Enums\MessageEnum;
use App\Models\Address;
use App\Models\Phone;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Hash;

class CreateUserService
{
    protected $name;
    protected $email;
    protected $cpf;
    protected $ctps;
    protected $pis;
    protected $company_id;
    protected $role_id;
    protected $division_id;

    protected $address;
    protected $phones;

    public function __construct(
        $name,
        $email,
        $cpf,
        $ctps,
        $pis,
        $company_id,
        $role_id,
        $division_id,
        $address,
        $phones,
    ) {
        $this->name = $name;
        $this->email = $email;
        $this->cpf = $cpf;
        $this->ctps = $ctps;
        $this->pis = $pis;
        $this->company_id = $company_id;
        $this->role_id = $role_id;
        $this->division_id = $division_id;

        $this->address = $address;
        $this->phones = $phones;
    }

    public function createUser()
    {
        // MessageEnum == MENSAGENS PREDEFINIDAS PARA EVITAR REPETIÇÃO DE CÓDIGO
        $message = MessageEnum::SUCCESS_CREATED;

        try {
            // User::create == função utilizada para salvar os dados no banco de dados.
            $query = User::create([
                'username' => ($this->generateUsername($this->cpf)),
                'password' => ($this->generatePassword($this->cpf)),
                'full_name' => $this->name,
                'email' => $this->email,
                'cpf' => $this->cpf,
                'ctps' => $this->ctps,
                'pis' => $this->pis,
                'company_id' => $this->company_id,
                'role_id' => $this->role_id,
                'division_id' => $this->division_id,
            ]);

            ($this->saveAddress($query->id, $this->address));
            ($this->savePhone($query->id, $this->phones));

            return ['id' => $query->id, 'message' => $message];
        } catch (Exception $th) {
            throw new Exception(MessageEnum::FAILURE_CREATED . $th);
        }
    }

    public function saveAddress($id, $address)
    {
        try {
            $query = Address::create([
                'user_id' => $id,
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

    public function savePhone($id, $phone)
    {
        try {
            $query = Phone::create([
                'user_id' => $id,
                'phone_number' => $phone
            ]);

            if ($query)
                return True;

        } catch (Exception $th) {
            throw new Exception(MessageEnum::FAILURE_CREATED);
        }
    }

    private function generateUsername($cpf)
    {
        $username = str_replace(['.', '-'], '', $cpf);
        return $username;
    }

    private function generatePassword($cpf)
    {
        $password_converted = substr(str_replace('.', '', $cpf), 0, 4);
        $password_encrypted = Hash::make($password_converted);
        return $password_encrypted;
    }

}