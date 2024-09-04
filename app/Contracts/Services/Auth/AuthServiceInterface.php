<?php

namespace App\Contracts\Services\Auth;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\UserRequest;

interface AuthServiceInterface
{
    function login(LoginRequest $request);

    function register(UserRequest $request);

    function getAuthUser();

    function logout();
}
