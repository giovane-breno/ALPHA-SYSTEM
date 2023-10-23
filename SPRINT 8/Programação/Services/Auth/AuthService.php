<?php

namespace App\Http\Services\Auth;

use App\Enums\MessageEnum;
use App\Http\Resources\User\UserResource;
use App\Models\AdminRole;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthService
{
    public function login($username, $password)
    {
        $message = MessageEnum::SUCCESS_LOGIN;

        $credentials = ['username' => $username, 'password' => $password];
        if (Auth::attempt($credentials)) {
            $user = User::with('company', 'role', 'division')->find(Auth::id());

            $user->tokens()->delete();

            $tokenResult = $user->createToken('Personal Access Token');

            return [
                'message' => $message,
                'user' => ['token' => $tokenResult->plainTextToken, 'user' => new UserResource($user)],
            ];
        } else {
            throw new Exception('Credenciais invalidas');
        }
    }

    public function logout(Request $request)
    {
        $message = MessageEnum::SUCCESS_LOGOUT;

        $user = Auth::user();
        $user->tokens()->delete();

        return ['message' => $message];
    }
}