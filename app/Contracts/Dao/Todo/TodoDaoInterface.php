<?php

namespace App\Contracts\Dao\Todo;

use App\Http\Requests\TodoRequest;
use App\Models\Todo;
use Illuminate\Database\Eloquent\Collection;

interface TodoDaoInterface
{
  function getAll(): Collection;

  function getById($id): Todo;

  function save(TodoRequest $request): Todo;

  function updateById(TodoRequest $request, $id): Todo;

  function deleteById($id);

  function makeDone($id);
}
