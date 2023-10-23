<?php

namespace App\Http\Controllers;

use App\Http\Services\User\CreateUserService;
use App\Http\Services\User\DeleteUserService;
use App\Http\Services\User\FindUserService;
use App\Http\Services\User\ListActiveUsersService;
use App\Http\Services\User\UpdateUserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Mostra a lista de funcionários / usuarios cadastrados
     */
    public function listActiveUsers()
    {
        try {
            $service = new ListActiveUsersService();
            $response = $service->listUsers();
            return response()->json(['status' => 'success', 'data' => $response], 200);
        } catch (\Exception $exception) {
            return response()->json(['status' => 'error', 'message' => $exception->getMessage()], 500);
        }
    }

    /**
     * Mostra um usuario em especifico.
     */
    public function findUser(int $id)
    {
        try {
            $service = new FindUserService();
            $response = $service->findUser($id);
            return response()->json(['status' => 'success', 'data' => $response], 200);
        } catch (\Exception $exception) {
            return response()->json(['status' => 'error', 'message' => $exception->getMessage()], 500);
        }

    }

    /**
     * Cadastra os novos funcionarios no sistema.
     */
    public function createUser(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'cpf' => 'required',
            'ctps' => 'required',
            'pis' => 'required',
            'company_id' => 'required',
            'role_id' => 'required',
            'division_id' => 'required',

            'address' => 'required',
            'phones' => 'required',
        ]);

        try {
            $service = new CreateUserService(
                $request->name,
                $request->email,
                $request->cpf,
                $request->ctps,
                $request->pis,
                $request->company_id,
                $request->role_id,
                $request->division_id,

                $request->address,
                $request->phones,
            );

            $response = $service->createUser();
            return response()->json(['status' => 'success', 'message' => $response['message']], 201);
        } catch (\Exception $exception) {
            return response()->json(['status' => 'error', 'message' => $exception->getMessage()], 500);
        }
    }

    /**
     * Atualiza um funcionario no sistema.
     */
    public function updateUser(Request $request, int $id)
    {
        $request->validate([
            'name' => 'string',
            'email' => 'string',
            'cpf' => 'string',
            'ctps' => 'string',
            'pis' => 'string',
            'company_id' => 'integer',
            'role_id' => 'integer',
            'division_id' => 'integer',
        ]);

        try {
            $service = new UpdateUserService(
                $request->name,
                $request->email,
                $request->cpf,
                $request->ctps,
                $request->pis,
                $request->company_id,
                $request->role_id,
                $request->division_id
            );

            $response = $service->updateUser($id);
            return response()->json(['status' => 'success', 'data' => $response], 200);
        } catch (\Exception $exception) {
            return response()->json(['status' => 'error', 'message' => $exception->getMessage()], 500);
        }
    }

    /**
     * Deleta um funcionário do sistema.
     */
    public function deleteUser(int $id)
    {
        try {
            $service = new DeleteUserService();
            $response = $service->deleteUser($id);

            return response()->json(['status' => 'success', 'message' => $response['message']], 200);
        } catch (\Exception $exception) {
            return response()->json(['status' => 'error', 'message' => $exception->getMessage()], 500);
        }
    }
}

