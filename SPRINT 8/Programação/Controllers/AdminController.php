<?php

namespace App\Http\Controllers;

use App\Http\Services\Admin\DemoteAdminService;
use App\Http\Services\Admin\FindAdminService;
use App\Http\Services\Admin\ListActiveAdminsService;
use App\Http\Services\Admin\PromoteAdminService;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function listAdmins()
    {
        try {
            $service = new ListActiveAdminsService();
            $response = $service->listAdmins();
            return response()->json(['status' => 'success', 'data' => $response], 200);
        } catch (\Exception $exception) {
            return response()->json(['status' => 'error', 'message' => $exception->getMessage()], 500);
        }
    }

    /**
     * Mostra um administrador específico.
     */
    public function findAdmin(int $id)
    {
        try {
            $service = new FindAdminService();
            $response = $service->findAdmin($id);
            return response()->json(['status' => 'success', 'data' => $response], 200);
        } catch (\Exception $exception) {
            return response()->json(['status' => 'error', 'message' => $exception->getMessage()], 500);
        }
    }

    /**
     * Cadastra novos administradores no sistema.
     */
    public function promoteAdmin(Request $request)
    {
        $request->validate([
            'user_id' => 'numeric',
            'admin_role_id' => 'numeric'
        ]);

        try {
            $service = new PromoteAdminService(
                $request->user_id,
                $request->admin_role_id,
            );

            $response = $service->promoteAdmin();
            return response()->json(['status' => 'success', 'message' => $response['message']], 201);
        } catch (\Exception $exception) {
            return response()->json(['status' => 'error', 'message' => $exception->getMessage()], 500);
        }
    }

    /**
     * Remove a função de administrador de um usuário.
     */
    public function demoteAdmin(int $id)
    {
        try {
            $service = new DemoteAdminService();
            $response = $service->demoteAdmin($id);

            return response()->json(['status' => 'success', 'message' => $response['message']], 200);
        } catch (\Exception $exception) {
            return response()->json(['status' => 'error', 'message' => $exception->getMessage()], 500);
        }
    }
}

