<?php

namespace App\Http\Controllers\Api\V2;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\ApiResponse;

class CompleteTaskController extends Controller
{
    /**
     * Handle the incoming request.
     */
    use ApiResponse;
    public function __invoke(Request $request)
    {
        $task = $request->user()->tasks()->find($request->task);

        if (!$task) {
            return $this->notFound('Task not found');
        }

        $task->update([
            'is_completed' => true,
        ]);

        return $this->successResponse(null, 'Task completed');
    }
}
