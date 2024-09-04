<?php

namespace App\Services\Todo;

use App\Contracts\Dao\Todo\TodoDaoInterface;
use App\Contracts\Services\Todo\TodoServiceInterface;
use App\Http\Requests\TodoRequest;
use App\Http\Resources\TodoResource;
use App\Models\Todo;
use Illuminate\Http\Resources\Json\JsonResource;

class TodoService implements TodoServiceInterface
{
  public function __construct(private TodoDaoInterface $todoDaoInterface)
  {
  }

  public function getAll(): JsonResource
  {
    return TodoResource::collection($this->todoDaoInterface->getAll());
  }

  public function getById($id): JsonResource
  {
    return new TodoResource($this->todoDaoInterface->getById($id));
  }

  public function save(TodoRequest $request): JsonResource
  {
    return new TodoResource($this->todoDaoInterface->save($request));
  }

  public function updateById(TodoRequest $request, $id): JsonResource
  {
    return new TodoResource($this->todoDaoInterface->updateById($request, $id));
  }

  public function deleteById($id)
  {
    $this->todoDaoInterface->deleteById($id);
  }

  public function makeDone($id)
  {
    $this->todoDaoInterface->makeDone($id);
  }
}
