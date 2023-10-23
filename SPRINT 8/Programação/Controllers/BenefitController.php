<?php

namespace App\Http\Controllers;

use App\Http\Services\Benefit\CreateBenefitService;
use App\Http\Services\Benefit\DeleteBenefitService;
use App\Http\Services\Benefit\FindBenefitService;
use App\Http\Services\Benefit\ListActiveBenefitsService;
use App\Http\Services\Benefit\UpdateBenefitService;
use Illuminate\Http\Request;

class BenefitController extends Controller
{
    public function ListActiveBenefit()
    {
        try {
            $service = new ListActiveBenefitsService();
            $response = $service->listBenefit();
            return response()->json(['status' => 'success', 'data' => $response], 200);
        } catch (\Exception $exception) {
            return response()->json(['status' => 'error', 'message' => $exception->getMessage()], 500);
        }
    }

    /**
     * Mostra uma Divisão em especifico.
     */
    public function findBenefit(int $id)
    {
        try {
            $service = new FindBenefitService();
            $response = $service->findBenefit($id);
            return response()->json(['status' => 'success', 'data' => $response], 200);
        } catch (\Exception $exception) {
            return response()->json(['status' => 'error', 'message' => $exception->getMessage()], 500);
        }
    }

    /**
     * Cadastra os novas Divisões no sistema.
     */
    public function createBenefit(Request $request)
    {
        $request->validate([
            'user_id' => 'numeric',
            'benefit_id' => 'numeric'
        ]);

        try {
            $service = new CreateBenefitService(
                $request->user_id,
                $request->benefit_id,
            );

            $response = $service->createBenefit();
            return response()->json(['status' => 'success', 'message' => $response['message']], 201);
        } catch (\Exception $exception) {
            return response()->json(['status' => 'error', 'message' => $exception->getMessage()], 500);
        }
    }

    /**
     * Atualiza uma Divisão no sistema.
     */
    public function updateBenefit(Request $request, int $id)
    {
        $request->validate([
            'user_id' => 'numeric',
            'benefit_id' => 'numeric'
        ]);

        try {
            $service = new UpdateBenefitService(
                $request->user_id,
                $request->benefit_id
            );

            $response = $service->updateBenefit($id);
            return response()->json(['status' => 'success', 'message' => $response['message']], 200);
        } catch (\Exception $exception) {
            return response()->json(['status' => 'error', 'message' => $exception->getMessage()], 500);
        }
    }

    /**
     * Deleta uma Divisão do sistema.
     */
    public function deleteBenefit(int $id)
    {
        try {
            $service = new DeleteBenefitService();
            $response = $service->deleteBenefit($id);

            return response()->json(['status' => 'success', 'message' => $response['message']], 200);
        } catch (\Exception $exception) {
            return response()->json(['status' => 'error', 'message' => $exception->getMessage()], 500);
        }
    }
}

