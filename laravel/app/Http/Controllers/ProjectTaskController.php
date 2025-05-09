<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use App\Http\Resources\TaskResource;
use App\Enums\Http\ProjectTaskHttpEnum;
use App\Http\Requests\TaskStoreRequest;

class ProjectTaskController extends Controller
{
    /**
     * Pobierz zadania projektu
     */
    public function getTasks(Project $project): JsonResponse
    {
        try {
            $tasks = $project->tasks;
        } catch (\Exception $e) {
            Log::error('Error fetching project tasks: ' . $e->getMessage());

            return response()->json([
                'message' => ProjectTaskHttpEnum::PROJECT_TASK_ERROR_GET->value,
            ], 500);
        }

        return TaskResource::collection($tasks)
            ->response();
    }

    /**
     * Pobierz projekt dla zadania
     */
    public function getProject(Task $task): JsonResponse
    {
        try {
            $project = $task->project;

            if (!$project) {
                return response()->json([
                    'message' => ProjectTaskHttpEnum::TASK_PROJECT_ERROR_NOT_FOUND->value,
                ], 404);
            }
        } catch (\Exception $e) {
            Log::error('Error fetching task project: ' . $e->getMessage());

            return response()->json([
                'message' => ProjectTaskHttpEnum::TASK_PROJECT_ERROR_GET->value,
            ], 500);
        }

        return response()->json([
            'data' => $project
        ]);
    }

    /**
     * Utwórz zadanie dla projektu
     */
    public function createTask(TaskStoreRequest $request, Project $project): JsonResponse
    {
        try {
            // Uzupełnij dane zadania o ID projektu
            $taskData = $request->validated();
            $taskData['project_id'] = $project->id;

            $task = Task::create($taskData);
        } catch (\Exception $e) {
            Log::error('Error creating task for project: ' . $e->getMessage());

            return response()->json([
                'message' => ProjectTaskHttpEnum::PROJECT_TASK_ERROR_CREATE->value,
            ], 500);
        }

        return TaskResource::make($task)
            ->response()
            ->setStatusCode(201);
    }

    /**
     * Zmień projekt dla zadania
     */
    public function changeProject(Request $request, Task $task): JsonResponse
    {
        $request->validate([
            'project_id' => 'required|exists:projects,id',
        ]);

        try {
            $task->project_id = $request->project_id;
            $task->save();
        } catch (\Exception $e) {
            Log::error('Error changing task project: ' . $e->getMessage());

            return response()->json([
                'message' => ProjectTaskHttpEnum::TASK_PROJECT_ERROR_CHANGE->value,
            ], 500);
        }

        return response()->json([
            'message' => ProjectTaskHttpEnum::TASK_PROJECT_SUCCESS_CHANGE->value,
        ], 200);
    }
}
