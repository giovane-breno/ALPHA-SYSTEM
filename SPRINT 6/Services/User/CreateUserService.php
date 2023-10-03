<?php

namespace App\Http\Services\User;

use App\Enums\MessageEnum;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Hash;

class CreateUserService
{
    protected $name;
    protected $cpf;
    protected $ctps;
    protected $pis;
    protected $company_id;
    protected $role_id;

    public function __construct(
        $name,
        $cpf,
        $ctps,
        $pis,
        $company_id,
        $role_id
    ) {
        $this->name = $name;
        $this->cpf = $cpf;
        $this->ctps = $ctps;
        $this->pis = $pis;
        $this->company_id = $company_id;
        $this->role_id = $role_id;
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
                'name' => $this->name,
                'cpf' => $this->cpf,
                'ctps' => $this->ctps,
                'pis' => $this->pis,
                'company_id' => $this->company_id,
                'role_id' => $this->role_id,
            ]);

            return ['id' => $query->id, 'message' => $message];
        } catch (Exception $th) {
            throw new Exception(MessageEnum::FAILURE_CREATED.$th);
        }
    }

    private function generateUsername($cpf){
        $username = str_replace(['.', '-'], '', $cpf);
        return $username;
    }

    private function generatePassword($cpf){
        $password_converted = substr(str_replace('.', '', $cpf), 0, 4);
        $password_encrypted = Hash::make($password_converted);
        return $password_encrypted;
    }
}