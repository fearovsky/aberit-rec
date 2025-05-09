<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Services\TaskServiceI;
use Illuminate\Support\Facades\Log;
use App\Enums\Http\TaskHttpEnum;
use App\Http\Resources\TaskResource;
use App\Http\Requests\{
    TaskStoreRequest,
    TaskUpdateRequest
};

class TaskController extends Controller
{
    public function __construct(
        private TaskServiceI $taskService,
    ) {
    }

    public function index(): JsonResponse
    {
        try {
            $tasks = $this->taskService->getAll();
        } catch (\Exception $e) {
            Log::error('Error fetching tasks: ' . $e->getMessage());

            return response()->json([
                'message' => TaskHttpEnum::TASK_ERROR_GET_ALL->value,
            ], 500);
        }

        return TaskResource::collection($tasks)
            ->response();
    }

    public function store(TaskStoreRequest $request)
    {
        try {
            $task = $this->taskService->create($request->validated());
        } catch (\Exception $e) {
            Log::error('Error creating task: ' . $e->getMessage());

            return response()->json([
                'message' => TaskHttpEnum::TASK_ERROR_CREATE->value,
            ], 500);
        }

        return TaskResource::make($task)
            ->response()
            ->setStatusCode(201);
    }

    public function show(Task $task)
    {
        return TaskResource::make($task)
            ->response();
    }

    public function update(TaskUpdateRequest $request, Task $task)
    {
        try {
            $task = $this->taskService->update($task, $request->validated());
        } catch (\Exception $e) {
            Log::error('Error updating task: ' . $e->getMessage());

            return response()->json([
                'message' => TaskHttpEnum::TASK_ERROR_UPDATE->value,
            ], 500);
        }

        return TaskResource::make($task)
            ->response()
            ->setStatusCode(200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        try {
            $this->taskService->delete($task);
        } catch (\Exception $e) {
            Log::error('Error deleting task: ' . $e->getMessage());

            return response()->json([
                'message' => TaskHttpEnum::TASK_ERROR_DELETE->value,
            ], 500);
        }

        return response()->json([
            'message' => TaskHttpEnum::TASK_SUCCESS_DELETE->value,
        ], 200);
    }
}
