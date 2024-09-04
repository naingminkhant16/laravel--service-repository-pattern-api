<?php

namespace App\Services\User;

use App\Contracts\Dao\User\UserDaoInterface;
use App\Contracts\Services\User\UserServiceInterface;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Hash;

class UserService implements UserServiceInterface
{
  public function __construct(private UserDaoInterface $userDaoInterface)
  {
  }

  public function getAll(): JsonResource
  {
    return UserResource::collection($this->userDaoInterface->getAll());
  }

  public function getById(int $id): JsonResource
  {
    return new UserResource($this->userDaoInterface->getById($id));
  }

  public function save(UserRequest $request): JsonResource
  {
    return new UserResource($this->userDaoInterface->save([
      "name" => $request['name'],
      "email" => $request['email'],
      "password" => Hash::make($request['password'])
    ]));
  }

  public function updateById(UserRequest $userRequest, int $id): JsonResource
  {
    return new UserResource($this->userDaoInterface->updateById($userRequest, $id));
  }

  public function deleteById(int $id)
  {
    $this->userDaoInterface->deleteById($id);
  }
}
