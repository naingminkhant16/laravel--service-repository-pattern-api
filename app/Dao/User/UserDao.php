<?php

namespace App\Dao\User;

use App\Contracts\Dao\User\email;
use App\Contracts\Dao\User\UserDaoInterface;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Exceptions\HttpResponseException;
use RuntimeException;

class UserDao implements UserDaoInterface
{
  public function getAll(): Collection
  {
    return User::all();
  }

  public function getById(int $id): User
  {
    return User::where("id", $id)->first();
  }

  public function save(array $data): User
  {
    try {
      return User::create($data);
    } catch (RuntimeException $ex) {
      throw new HttpResponseException(response()->json(["message" => "Fail to create user."]));
    }
  }

  public function updateById(UserRequest $userRequest, int $id): User
  {
    try {
      $user =  User::findOrFail($id);
      $user['name'] = $userRequest['name'];
      $user['email'] = $userRequest['email'];
      $user['password'] = $userRequest['password'];
      $user->save();
      return $user;
    } catch (RuntimeException $ex) {
      throw new HttpResponseException(response()->json(["message" => $ex->getMessage()], 404));
    }
  }

  public function deleteById(int $id)
  {
    try {
      $user = User::findOrFail($id);
      $user->delete();
    } catch (RuntimeException $ex) {
      throw new HttpResponseException(response()->json(['message' => $ex->getMessage()], 500));
    }
  }

  public function getByEmail(String $email)
  {
    try {
      return User::where('email', $email)->first();
    } catch (RuntimeException $ex) {
      throw new HttpResponseException(response()->json(['message' => $ex->getMessage()], 500));
    }
  }
}
