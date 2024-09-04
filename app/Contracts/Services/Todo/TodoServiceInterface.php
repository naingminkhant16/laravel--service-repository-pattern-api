<?php

namespace App\Contracts\Services\Todo;

use App\Http\Requests\TodoRequest;
use Illuminate\Http\Resources\Json\JsonResource;

interface TodoServiceInterface
{
  function getAll(): JsonResource;

  function getById($id): JsonResource;

  function save(TodoRequest $request): JsonResource;

  function updateById(TodoRequest $request, $id): JsonResource;

  function deleteById($id);

  function makeDone($id);
}
