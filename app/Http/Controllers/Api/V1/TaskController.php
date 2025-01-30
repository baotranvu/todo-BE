<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Task;
use App\Http\Controllers\Controller;
use App\Http\Resources\TaskResource;
use App\Traits\ApiResponse;


class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    use ApiResponse;
    public function index()
    {
        return $this->successResponse(TaskResource::collection(Task::all()), 'Tasks retrieved successfully');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request)
    {
        $task = Task::create($request->validated());

        return $this->created(TaskResource::make($task), 'Task created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        return $this->successResponse(TaskResource::make($task), 'Task retrieved successfully');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreTaskRequest $request, Task $task)
    {
        $task->update($request->validated());

        return $this->successResponse(TaskResource::make($task), 'Task updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $task->delete();

        return $this->noContent();
    }
}
