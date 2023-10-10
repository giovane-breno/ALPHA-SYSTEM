<?php

namespace App\Http\Controllers;

use App\Http\Services\Finance\doPaymentService;
use Exception;
use Illuminate\Http\Request;

class FinanceController extends Controller
{
    public function doPayment()
    {
        try {
            $service = new doPaymentService();
            $response = $service->doPayment();
            
            return response()->json(['status' => 'success', 'data' => $response], 200);
        } catch (Exception $exception) {
            return response()->json(['status' => 'error', 'message' => $exception->getMessage()], 500);
        }
    }

    public function doIndividualPayment(int $id)
    {

    }
}