<?php

namespace App\Contracts\Services\User;

use App\Http\Requests\UserRequest;
use Illuminate\Http\Resources\Json\JsonResource;

interface UserServiceInterface
{
  public function getAll(): JsonResource;

  public function getById(int $id): JsonResource;

  public function save(UserRequest $userRequest): JsonResource;

  public function updateById(UserRequest $userRequest, int $id): JsonResource;

  public function deleteById(int $id);
}
