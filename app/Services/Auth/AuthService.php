<?php

namespace App\Services\Auth;

use App\Contracts\Dao\User\UserDaoInterface;
use App\Contracts\Services\Auth\AuthServiceInterface;
use App\Contracts\Services\User\UserServiceInterface;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Hash;

class AuthService implements AuthServiceInterface
{
    public function __construct(
        private UserServiceInterface $userServiceInterface,
        private UserDaoInterface $userDaoInterface
    ) {
    }

    public function login(LoginRequest $request)
    {
        $user = $this->userDaoInterface->getByEmail($request->email);

        if (empty($user) || !Hash::check($request->password, $user->password)) {
            throw new HttpResponseException(
                response()->json(["message" => "Incorrect email or password"], 401)
            );
        }

        $token = $user->createToken($user->name . '-AuthToken')->plainTextToken;

        //set expiration time
        $tokenModel=$user->tokens()->where('id', explode('|',$token)[0])->first();
        $tokenModel->expires_at=now()->addHours(6);
        $tokenModel->save();

        return ['_token' => $token, 'auth' => new UserResource($user)];
    }

    public function register(UserRequest $request)
    {
        return $this->userServiceInterface->save($request);
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();
    }

    public function getAuthUser()
    {
        return new UserResource(auth()->user());
    }
}
