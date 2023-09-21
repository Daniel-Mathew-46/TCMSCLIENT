<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Task;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\TaskResource;
use App\Http\Requests\UpdateTaskRequest;

class UpdateTaskController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(UpdateTaskRequest $request, Task $task)
    {

        $task->update($request->validate());

        return TaskResource::make($task);
    }
}
