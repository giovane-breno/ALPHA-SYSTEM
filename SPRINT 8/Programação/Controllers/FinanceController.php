<?php

namespace App\Http\Controllers;

use App\Http\Services\Finance\FindPayrollService;
use App\Http\Services\Finance\ListActivePayrollsService;
use App\Http\Services\Finance\DoPaymentService;
use App\Http\Services\Finance\DeletePayrollService;
use Exception;
use Illuminate\Http\Request;

class FinanceController extends Controller
{
    public function ListActivePayrolls()
    {
        try {
            $service = new ListActivePayrollsService();
            $response = $service->listPayrolls();
            return response()->json(['status' => 'success', 'data' => $response], 200);
        } catch (Exception $exception) {
            return response()->json(['status' => 'error', 'message' => $exception->getMessage()], 500);
        }
    }

    public function doPayment()
    {
        try {
            $service = new doPaymentService();
            $response = $service->doPayment();

            return response()->json(['status' => 'success', 'message' => $response['message'], 'data' => $response['data']], 200);
        } catch (Exception $exception) {
            return response()->json(['status' => 'error', 'message' => $exception->getMessage()], 500);
        }
    }

    public function doIndividualPayment(int $id)
    {
        try {
            $service = new doPaymentService();
            $response = $service->doIndividualPayment($id);

            return response()->json(['status' => 'success', 'message' => $response['message']], 200);
        } catch (Exception $exception) {
            return response()->json(['status' => 'error', 'message' => $exception->getMessage()], 500);
        }
    }

    public function findPayroll(int $id)
    {
        try {
            $service = new FindPayrollService();
            $response = $service->findPayroll($id);

            return response()->json(['status' => 'success', 'data' => $response], 200);
        } catch (Exception $exception) {
            return response()->json(['status' => 'error', 'message' => $exception->getMessage()], 500);
        }
    }

    public function deletePayroll(int $id)
    {
        try {
            $service = new DeletePayrollService();
            $response = $service->deletePayroll($id);
            return response()->json(['status' => 'success', 'message' => $response['message']], 200);
        } catch (Exception $exception) {
            return response()->json(['status' => 'error', 'message' => $exception->getMessage()], 500);
        }
    }
}

