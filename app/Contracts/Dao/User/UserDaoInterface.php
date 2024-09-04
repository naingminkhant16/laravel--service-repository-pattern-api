<?php

namespace App\Contracts\Dao\User;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

interface UserDaoInterface
{
  public function getAll(): Collection;

  public function getById(int $id): User;

  public function save(array $data): User;

  public function updateById(UserRequest $userRequest, int $id): User;

  public function deleteById(int $id);

  public function getByEmail(String $email);
}
