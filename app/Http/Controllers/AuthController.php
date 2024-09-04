<?php

namespace App\Http\Controllers;

use App\Contracts\Services\Auth\AuthServiceInterface;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function __construct(private AuthServiceInterface $authServiceInterface)
    {
    }

    public function login(LoginRequest $request)
    {
        $data = $this->authServiceInterface->login($request);

        return response()->json([
            'message' => 'success',
            "data" => $data
        ]);
    }

    public function register(UserRequest $request)
    {
        $regUser =  $this->authServiceInterface->register($request);

        return response()->json([
            'message' => 'success',
            'data' => $regUser
        ],201);
    }

    public function logout()
    {
        $this->authServiceInterface->logout();
        return response()->json([
            'message' => 'success'
        ]);
    }

    public function getAuthUser()
    {
        $authUser = $this->authServiceInterface->getAuthUser();
        return response()->json(['message' => 'success', 'data' => ['auth' => $authUser]]);
    }
}
