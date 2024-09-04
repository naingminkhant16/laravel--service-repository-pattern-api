<?php

namespace App\Dao\Todo;

use App\Contracts\Dao\Todo\TodoDaoInterface;
use App\Http\Requests\TodoRequest;
use App\Models\Todo;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Exceptions\HttpResponseException;
use RuntimeException;

class TodoDao implements TodoDaoInterface
{
  public function getAll(): Collection
  {
    try {
      return Todo::where('user_id', auth()->id())->get();
    } catch (RuntimeException $ex) {
      throw new HttpResponseException(response()->json(['message' => $ex->getMessage()], 500));
    }
  }

  public function getById($id): Todo
  {
    try {
      return Todo::where('user_id', auth()->id())
        ->findOrFail($id);
    } catch (RuntimeException $ex) {
      throw new HttpResponseException(response()->json(['message' => $ex->getMessage()], 400));
    }
  }

  public function save(TodoRequest $request): Todo
  {
    try {
      return Todo::create([
        'name' => $request->name,
        'description' => $request->description,
        'user_id' => auth()->id()
      ]);
    } catch (RuntimeException $ex) {
      throw new HttpResponseException(response()->json(['message' => $ex->getMessage()], 500));
    }
  }

  public function updateById(TodoRequest $request, $id): Todo
  {
    $todo = $this->getById($id);
    try {
      $todo->name = $request->name;
      $todo->description = $request->description;
      $todo->updated_at = now();
      $todo->save();
      return $todo;
    } catch (RuntimeException $ex) {
      throw new HttpResponseException(response()->json(['message' => $ex->getMessage()], 500));
    }
  }

  public function deleteById($id)
  {
    $todo = $this->getById($id);
    try {
      $todo->delete();
    } catch (RuntimeException $ex) {
      throw new HttpResponseException(response()->json(['message' => $ex->getMessage()], 500));
    }
  }

  public function makeDone($id)
  {
    $todo = $this->getById($id);
    try {
      $todo->is_done = true;
      $todo->updated_at = now();
      $todo->save();
    } catch (RuntimeException $ex) {
      throw new HttpResponseException(response()->json(['message' => $ex->getMessage()], 500));
    }
  }
}
