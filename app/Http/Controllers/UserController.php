<?php

namespace App\Http\Controllers;

use App\Contracts\Services\User\UserServiceInterface;
use App\Http\Requests\UserRequest;

class UserController extends Controller
{
    public function __construct(private UserServiceInterface $userServiceInterface)
    {
    }

    public function getAll()
    {
        $users = $this->userServiceInterface->getAll();
        return response()->json($users);
    }


    public function getById(int $id)
    {
        $user = $this->userServiceInterface->getById($id);
        return response()->json($user);
    }


    public function store(UserRequest $request)
    {
        $newUser = $this->userServiceInterface->save($request);
        return response()->json($newUser, 201);
    }

    public function update(UserRequest $request, int $id)
    {
        $updateUser = $this->userServiceInterface->updateById($request, $id);
        return response()->json($updateUser, 200);
    }


    public function destroy(int $id)
    {
        $this->userServiceInterface->deleteById($id);
        return response()->json(null, 204);
    }
}
