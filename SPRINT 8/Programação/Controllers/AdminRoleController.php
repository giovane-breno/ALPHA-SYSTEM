<?php

namespace App\Http\Controllers;

use App\Http\Services\AdminRole\CreateAdminRoleService;
use App\Http\Services\AdminRole\DeleteAdminRoleService;
use App\Http\Services\AdminRoles\ListActiveAdminRolesService;
use App\Http\Services\Benefit\FindAdminRoleService;
use App\Http\Services\Benefit\UpdateAdminRoleService;
use Illuminate\Http\Request;

class AdminRoleController extends Controller
{
    public function ListActiveAdminRole()
    {
        try {
            $service = new ListActiveAdminRolesService();
            $response = $service->listAdminRoles();
            return response()->json(['status' => 'success', 'data' => $response], 200);
        } catch (\Exception $exception) {
            return response()->json(['status' => 'error', 'message' => $exception->getMessage()], 500);
        }
    }

    /**
     * Mostra uma Divisão em especifico.
     */
    public function findAdminRole(int $id)
    {
        try {
            $service = new FindAdminRoleService();
            $response = $service->findAdminRole($id);
            return response()->json(['status' => 'success', 'data' => $response], 200);
        } catch (\Exception $exception) {
            return response()->json(['status' => 'error', 'message' => $exception->getMessage()], 500);
        }
    }

    /**
     * Cadastra os novas Divisões no sistema.
     */
    public function createAdminRole(Request $request)
    {
        $request->validate([
            'name' => 'string',
            'abilities' => 'array'
        ]);

        try {
            $service = new CreateAdminRoleService(
                $request->name,
                $request->abilities,
            );

            $response = $service->createAdminRole();
            return response()->json(['status' => 'success', 'message' => $response['message']], 201);
        } catch (\Exception $exception) {
            return response()->json(['status' => 'error', 'message' => $exception->getMessage()], 500);
        }
    }

    /**
     * Atualiza uma Divisão no sistema.
     */
    public function updateAdminRole(Request $request, int $id)
    {
        $request->validate([
            'name' => 'string',
            'abilities' => 'array'
        ]);

        try {
            $service = new UpdateAdminRoleService(
                $request->name,
                $request->abilities
            );

            $response = $service->updateAdminRole($id);
            return response()->json(['status' => 'success', 'message' => $response['message']], 200);
        } catch (\Exception $exception) {
            return response()->json(['status' => 'error', 'message' => $exception->getMessage()], 500);
        }
    }

    /**
     * Deleta uma Divisão do sistema.
     */
    public function deleteAdminRole(int $id)
    {
        try {
            $service = new DeleteAdminRoleService();
            $response = $service->deleteAdminRole($id);

            return response()->json(['status' => 'success', 'message' => $response['message']], 200);
        } catch (\Exception $exception) {
            return response()->json(['status' => 'error', 'message' => $exception->getMessage()], 500);
        }
    }
}


