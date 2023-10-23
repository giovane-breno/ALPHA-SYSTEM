<?php

namespace App\Http\Controllers;

use App\Http\Services\Incident\CreateIncidentService;
use App\Http\Services\Incident\DeleteIncidentService;
use App\Http\Services\Incident\FindIncidentService;
use App\Http\Services\Incident\ListActiveIncidentsService;
use App\Http\Services\Incident\UpdateIncidentService;
use Illuminate\Http\Request;

class IncidentController extends Controller
{
    public function listActiveIncidents()
    {
        try {
            $service = new ListActiveIncidentsService();
            $response = $service->listIncidents();
            return response()->json(['status' => 'success', 'data' => $response], 200);
        } catch (\Exception $exception) {
            return response()->json(['status' => 'error', 'message' => $exception->getMessage()], 500);
        }
    }

    /**
     * Mostra uma Divisão em especifico.
     */
    public function findIncident(int $id)
    {
        try {
            $service = new FindIncidentService();
            $response = $service->findIncident($id);
            return response()->json(['status' => 'success', 'data' => $response], 200);
        } catch (\Exception $exception) {
            return response()->json(['status' => 'error', 'message' => $exception->getMessage()], 500);
        }
    }

    /**
     * Cadastra os novas Divisões no sistema.
     */
    public function createIncident(Request $request)
    {
        $request->validate([
            'user_id' => 'numeric',
            'incident_reason' => 'string',
            'bonus' => 'numeric',
            'start_date' => 'date',
            'end_date' => 'date'
        ]);

        try {
            $service = new CreateIncidentService(
                $request->user_id,
                $request->incident_reason,
                $request->discounted_amount,
                $request->start_date,
                $request->end_date
            );

            $response = $service->createIncident();
            return response()->json(['status' => 'success', 'message' => $response['message']], 201);
        } catch (\Exception $exception) {
            return response()->json(['status' => 'error', 'message' => $exception->getMessage()], 500);
        }
    }

    /**
     * Atualiza uma Divisão no sistema.
     */
    public function updateIncident(Request $request, int $id)
    {
        $request->validate([
            'user_id' => 'numeric',
            'incident_reason' => 'string',
            'discounted_amount' => 'numeric',
            'start_date' => 'date',
            'end_date' => 'date'
        ]);

        try {
            $service = new UpdateIncidentService(
                $request->user_id,
                $request->incident_reason,
                $request->discounted_amount,
                $request->start_date,
                $request->end_date
            );

            $response = $service->updateIncident($id);
            return response()->json(['status' => 'success', 'message' => $response['message']], 201);
        } catch (\Exception $exception) {
            return response()->json(['status' => 'error', 'message' => $exception->getMessage()], 500);
        }
    }

    /**
     * Deleta uma Divisão do sistema.
     */
    public function deleteIncident(int $id)
    {
        try {
            $service = new DeleteIncidentService();
            $response = $service->deleteIncident($id);

            return response()->json(['status' => 'success', 'message' => $response['message']], 200);
        } catch (\Exception $exception) {
            return response()->json(['status' => 'error', 'message' => $exception->getMessage()], 500);
        }
    }
}

