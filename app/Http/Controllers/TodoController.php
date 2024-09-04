<?php

namespace App\Http\Controllers;

use App\Contracts\Services\Todo\TodoServiceInterface;
use App\Http\Requests\TodoRequest;
use App\Models\Todo;

class TodoController extends Controller
{

    public function __construct(protected TodoServiceInterface $todoServiceInterface)
    {

    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json([
            "message" => 'success',
            "data" => $this->todoServiceInterface->getAll()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TodoRequest $request)
    {
        return response()->json([
            "message" => 'success',
            "data" => $this->todoServiceInterface->save($request)
        ], 201);
    }

    /**
     * Make Todo Done
     */
    public function makeTodoDone($id)
    {
        $this->todoServiceInterface->makeDone($id);
        return response()->json(['message' => 'Successfully make Todo done.']);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return response()->json([
            "message" => "success",
            "data" => $this->todoServiceInterface->getById($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TodoRequest $request,  $id)
    {
        return response()->json([
            'message' => 'success',
            'data' => $this->todoServiceInterface->updateById($request, $id)
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->todoServiceInterface->deleteById($id);
        return response()->json([], 204);
    }
}
