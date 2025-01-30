<?php

namespace App\Http\Controllers\Api\V2;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Task;
use App\Http\Controllers\Controller;
use App\Http\Resources\TaskResource;
use Illuminate\Support\Facades\Gate;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    use ApiResponse;
    public function index(Request $request)
    {
        Gate::authorize('viewAny', Task::class);
        $tasks = auth()->user()->tasks()->paginate($request->input('per_page', 10));
        $tasks = TaskResource::collection($tasks);
        return $this->successResponse(
            [
                'data' => $tasks,
                'meta' => [
                    'total' => $tasks->total(),
                    'per_page' => $tasks->perPage(),
                    'current_page' => $tasks->currentPage(),
                    'last_page' => $tasks->lastPage(),
                    'from' => $tasks->firstItem(),
                    'to' => $tasks->lastItem(),
                ],
                'links' => [
                    'self' => url()->current(),
                    'first' => $tasks->url(1),
                    'last' => $tasks->url($tasks->lastPage()),
                    'prev' => $tasks->previousPageUrl(),
                    'next' => $tasks->nextPageUrl(),
                ],
            ],
            'Tasks retrieved successfully'
        );
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
        $task = $request->user()->tasks()->create($request->validated());

        return $this->created(TaskResource::make($task), 'Task created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        Gate::authorize('view', $task);

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
        if ($request->user()->cannot('update', $task)) {
            return $this->forbidden('You are not authorized to update this task', null);
        }
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
