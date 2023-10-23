<?php

namespace App\Http\Controllers;

use App\Http\Services\Auth\AuthService;
use App\Http\Services\Auth\LoginService;
use Exception;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'string',
            'password' => 'string',
        ]);

        try {
            $service = new AuthService();
            $response = $service->login($request->username, $request->password);

            return response()->json(['status' => 'success', 'message'=> $response['message'], 'data' => $response['user']], 200);
        } catch (Exception $exception) {
            return response()->json(['status' => 'error', 'message' => $exception->getMessage()], 500);
        }
    }

    public function logout(Request $request)
    {
        try {
            //code...
        } catch (Exception $th) {
            //throw $th;
        }
    }
}


