<?php

namespace App\Http\Controllers;

use App\Http\Services\Division\ListActiveRolesService;
use App\Http\Services\Role\CreateRoleService;
use App\Http\Services\Role\DeleteRoleService;
use App\Http\Services\Role\FindRoleService;
use App\Http\Services\Role\UpdateRoleService;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Mostra a lista de funcionários / usuarios cadastrados
     */
    public function listActiveRoles()
    {
        try {
            $service = new ListActiveRolesService();
            $response = $service->listRoles();
            return response()->json(['status' => 'success', 'data' => $response], 200);
        } catch (\Exception $exception) {
            return response()->json(['status' => 'error', 'message' => $exception->getMessage()], 500);
        }
    }

    /**
     * Mostra uma Divisão em especifico.
     */
    public function findRole(int $id)
    {
        try {
            $service = new FindRoleService();
            $response = $service->findRole($id);
            return response()->json(['status' => 'success', 'data' => $response], 200);
        } catch (\Exception $exception) {
            return response()->json(['status' => 'error', 'message' => $exception->getMessage()], 500);
        }

    }

    /**
     * Cadastra os novas Divisões no sistema.
     */
    public function createRole(Request $request)
    {
        $request->validate([
            'name' => 'string',
            'base_salary' => 'numeric'
        ]);

        try {
            $service = new CreateRoleService(
                $request->name,
                $request->base_salary
            );

            $response = $service->createRole();
            return response()->json(['status' => 'success', 'message' => $response['message']], 201);
        } catch (\Exception $exception) {
            return response()->json(['status' => 'error', 'message' => $exception->getMessage()], 500);
        }
    }

    /**
     * Atualiza uma Divisão no sistema.
     */
    public function updateRole(Request $request, int $id)
    {
        $request->validate([
            'name' => 'string',
            'base_salary' => 'numeric'
        ]);

        try {
            $service = new UpdateRoleService(
                $request->name,
                $request->base_salary
            );

            $response = $service->updateRole($id);
            return response()->json(['status' => 'success', 'data' => $response], 200);
        } catch (\Exception $exception) {
            return response()->json(['status' => 'error', 'message' => $exception->getMessage()], 500);
        }
    }

    /**
     * Deleta uma Divisão do sistema.
     */
    public function deleteRole(int $id)
    {
        try {
            $service = new DeleteRoleService();
            $response = $service->deleteRole($id);

            return response()->json(['status' => 'success', 'message' => $response['message']], 200);
        } catch (\Exception $exception) {
            return response()->json(['status' => 'error', 'message' => $exception->getMessage()], 500);
        }
    }
}

