<?php

namespace App\Http\Controllers;

use App\Http\Services\BenefitType\CreateBenefitTypeService;
use App\Http\Services\BenefitType\DeleteBenefitTypeService;
use App\Http\Services\BenefitType\FindBenefitTypeService;
use App\Http\Services\BenefitType\ListActiveBenefitTypesService;
use App\Http\Services\BenefitType\UpdateBenefitTypeService;
use Illuminate\Http\Request;

class BenefitTypeController extends Controller
{
    /**
     * Mostra uma Divisão em especifico.
     */
    public function ListActiveBenefitTypes()
    {
        try {
            $service = new ListActiveBenefitTypesService();
            $response = $service->listBenefitTypes();
            return response()->json(['status' => 'success', 'data' => $response], 200);
        } catch (\Exception $exception) {
            return response()->json(['status' => 'error', 'message' => $exception->getMessage()], 500);
        }
    }

    public function findBenefit(int $id)
    {
        try {
            $service = new FindBenefitTypeService();
            $response = $service->findBenefitType($id);
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
            'name' => 'string',
            'bonus' => 'numeric'
        ]);

        try {
            $service = new CreateBenefitTypeService(
                $request->name,
                $request->bonus,
            );

            $response = $service->createBenefitType();
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
            'name' => 'string',
            'bonus' => 'numeric'
        ]);

        try {
            $service = new UpdateBenefitTypeService(
                $request->name,
                $request->bonus
            );

            $response = $service->updateBenefitType($id);
            return response()->json(['status' => 'success', 'data' => $response], 200);
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
            $service = new DeleteBenefitTypeService();
            $response = $service->deleteBenefitType($id);

            return response()->json(['status' => 'success', 'message' => $response['message']], 200);
        } catch (\Exception $exception) {
            return response()->json(['status' => 'error', 'message' => $exception->getMessage()], 500);
        }
    }
}

