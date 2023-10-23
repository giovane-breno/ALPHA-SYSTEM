<?php

namespace App\Http\Controllers;

use App\Http\Services\Division\DeleteDivisionService;
use App\Http\Services\Division\FindDivisionService;
use App\Http\Services\Division\UpdateDivisionService;
use App\Http\Services\Division\CreateDivisionService;
use App\Http\Services\Division\ListActiveDivisionsService;
use Illuminate\Http\Request;

class DivisionController extends Controller
{
    /**
     * Mostra a lista de funcionários / usuarios cadastrados
     */
    public function listActiveDivisions()
    {
        try {
            $service = new ListActiveDivisionsService();
            $response = $service->listDivisions();
            return response()->json(['status' => 'success', 'data' => $response], 200);
        } catch (\Exception $exception) {
            return response()->json(['status' => 'error', 'message' => $exception->getMessage()], 500);
        }
    }

    /**
     * Mostra uma Divisão em especifico.
     */
    public function findDivision(int $id)
    {
        try {
            $service = new FindDivisionService();
            $response = $service->findDivision($id);
            return response()->json(['status' => 'success', 'data' => $response], 200);
        } catch (\Exception $exception) {
            return response()->json(['status' => 'error', 'message' => $exception->getMessage()], 500);
        }

    }

    /**
     * Cadastra os novas Divisões no sistema.
     */
    public function createDivision(Request $request)
    {
        $request->validate([
            'name' => 'string',
            'bonus' => 'numeric'
        ]);

        try {
            $service = new CreateDivisionService(
                $request->name,
                $request->bonus
            );

            $response = $service->createDivision();
            return response()->json(['status' => 'success', 'message' => $response['message']], 201);
        } catch (\Exception $exception) {
            return response()->json(['status' => 'error', 'message' => $exception->getMessage()], 500);
        }
    }

    /**
     * Atualiza uma Divisão no sistema.
     */
    public function updateDivision(Request $request, int $id)
    {
        $request->validate([
            'name' => 'string',
            'bonus' => 'numeric'
        ]);

        try {
            $service = new UpdateDivisionService(
                $request->name,
                $request->bonus
            );

            $response = $service->updateDivision($id);
            return response()->json(['status' => 'success', 'message' => $response['message']], 201);
        } catch (\Exception $exception) {
            return response()->json(['status' => 'error', 'message' => $exception->getMessage()], 500);
        }
    }

    /**
     * Deleta uma Divisão do sistema.
     */
    public function deleteDivision(int $id)
    {
        try {
            $service = new DeleteDivisionService();
            $response = $service->deleteDivision($id);

            return response()->json(['status' => 'success', 'message' => $response['message']], 200);
        } catch (\Exception $exception) {
            return response()->json(['status' => 'error', 'message' => $exception->getMessage()], 500);
        }
    }
}

