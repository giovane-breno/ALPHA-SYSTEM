<?php

namespace App\Http\Controllers;

use App\Http\Services\Gratification\CreateGratificationService;
use App\Http\Services\Gratification\DeleteGratificationService;
use App\Http\Services\Gratification\FindGratificationService;
use App\Http\Services\Gratification\ListActiveGratificationsService;
use App\Http\Services\Gratification\UpdateGratificationService;
use Illuminate\Http\Request;

class GratificationController extends Controller
{
    public function listActiveGratifications()
    {
        try {
            $service = new ListActiveGratificationsService();
            $response = $service->listGratifications();
            return response()->json(['status' => 'success', 'data' => $response], 200);
        } catch (\Exception $exception) {
            return response()->json(['status' => 'error', 'message' => $exception->getMessage()], 500);
        }
    }
    
    /**
     * Mostra uma Divisão em especifico.
     */
    public function findGratification(int $id)
    {
        try {
            $service = new FindGratificationService();
            $response = $service->findGratification($id);
            return response()->json(['status' => 'success', 'data' => $response], 200);
        } catch (\Exception $exception) {
            return response()->json(['status' => 'error', 'message' => $exception->getMessage()], 500);
        }
    }

    /**
     * Cadastra os novas Divisões no sistema.
     */
    public function createGratification(Request $request)
    {
        $request->validate([
            'user_id' => 'numeric',
            'gratification_reason' => 'string',
            'bonus' => 'numeric',
            'start_date' => 'date',
            'end_date' => 'date'
        ]);

        try {
            $service = new CreateGratificationService(
                $request->user_id,
                $request->gratification_reason,
                $request->bonus,
                $request->start_date,
                $request->end_date
            );

            $response = $service->createGratification();
            return response()->json(['status' => 'success', 'message' => $response['message']], 201);
        } catch (\Exception $exception) {
            return response()->json(['status' => 'error', 'message' => $exception->getMessage()], 500);
        }
    }

    /**
     * Atualiza uma Divisão no sistema.
     */
    public function updateGratification(Request $request, int $id)
    {
        $request->validate([
            'user_id' => 'numeric',
            'gratification_reason' => 'string',
            'bonus' => 'numeric',
            'start_date' => 'date',
            'end_date' => 'date'
        ]);

        try {
            $service = new UpdateGratificationService(
                $request->user_id,
                $request->gratification_reason,
                $request->bonus,
                $request->start_date,
                $request->end_date
            );

            $response = $service->updateGratification($id);
            return response()->json(['status' => 'success', 'message' => $response['message']], 201);
        } catch (\Exception $exception) {
            return response()->json(['status' => 'error', 'message' => $exception->getMessage()], 500);
        }
    }

    /**
     * Deleta uma Divisão do sistema.
     */
    public function deleteGratification(int $id)
    {
        try {
            $service = new DeleteGratificationService();
            $response = $service->deleteGratification($id);

            return response()->json(['status' => 'success', 'message' => $response['message']], 200);
        } catch (\Exception $exception) {
            return response()->json(['status' => 'error', 'message' => $exception->getMessage()], 500);
        }
    }
}

