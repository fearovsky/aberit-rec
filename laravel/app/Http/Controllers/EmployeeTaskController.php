<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use App\Http\Resources\TaskResource;
use App\Http\Resources\EmployeeResource;
use App\Enums\Http\EmployeeTaskHttpEnum;

class EmployeeTaskController extends Controller
{
    /**
     * Pobierz zadania pracownika
     */
    public function getTasks(Employee $employee): JsonResponse
    {
        try {
            $tasks = $employee->tasks;
        } catch (\Exception $e) {
            Log::error('Error fetching employee tasks: ' . $e->getMessage());

            return response()->json([
                'message' => EmployeeTaskHttpEnum::EMPLOYEE_TASK_ERROR_GET->value,
            ], 500);
        }

        return TaskResource::collection($tasks)
            ->response();
    }

    /**
     * Pobierz pracowników przypisanych do zadania
     */
    public function getEmployees(Task $task): JsonResponse
    {
        try {
            $employees = $task->employees;
        } catch (\Exception $e) {
            Log::error('Error fetching task employees: ' . $e->getMessage());

            return response()->json([
                'message' => EmployeeTaskHttpEnum::TASK_EMPLOYEE_ERROR_GET->value,
            ], 500);
        }

        return EmployeeResource::collection($employees)
            ->response();
    }

    /**
     * Przypisz pracownika do zadania
     */
    public function assignEmployee(Request $request, Task $task): JsonResponse
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
        ]);

        try {
            // Sprawdź, czy relacja już istnieje
            if (!$task->employees()->where('employee_id', $request->employee_id)->exists()) {
                $task->employees()->attach($request->employee_id);
            }
        } catch (\Exception $e) {
            Log::error('Error assigning employee to task: ' . $e->getMessage());

            return response()->json([
                'message' => EmployeeTaskHttpEnum::EMPLOYEE_TASK_ERROR_ASSIGN->value,
            ], 500);
        }

        return response()->json([
            'message' => EmployeeTaskHttpEnum::EMPLOYEE_TASK_SUCCESS_ASSIGN->value,
        ], 200);
    }

    /**
     * Przypisz zadanie do pracownika
     */
    public function assignTask(Request $request, Employee $employee): JsonResponse
    {
        $request->validate([
            'task_id' => 'required|exists:tasks,id',
        ]);

        try {
            // Sprawdź, czy relacja już istnieje
            if (!$employee->tasks()->where('task_id', $request->task_id)->exists()) {
                $employee->tasks()->attach($request->task_id);
            }
        } catch (\Exception $e) {
            Log::error('Error assigning task to employee: ' . $e->getMessage());

            return response()->json([
                'message' => EmployeeTaskHttpEnum::TASK_EMPLOYEE_ERROR_ASSIGN->value,
            ], 500);
        }

        return response()->json([
            'message' => EmployeeTaskHttpEnum::TASK_EMPLOYEE_SUCCESS_ASSIGN->value,
        ], 200);
    }

    /**
     * Usuń pracownika z zadania
     */
    public function removeEmployee(Task $task, $employeeId): JsonResponse
    {
        try {
            $task->employees()->detach($employeeId);
        } catch (\Exception $e) {
            Log::error('Error removing employee from task: ' . $e->getMessage());

            return response()->json([
                'message' => EmployeeTaskHttpEnum::EMPLOYEE_TASK_ERROR_REMOVE->value,
            ], 500);
        }

        return response()->json([
            'message' => EmployeeTaskHttpEnum::EMPLOYEE_TASK_SUCCESS_REMOVE->value,
        ], 200);
    }

    /**
     * Usuń zadanie od pracownika
     */
    public function removeTask(Employee $employee, $taskId): JsonResponse
    {
        try {
            $employee->tasks()->detach($taskId);
        } catch (\Exception $e) {
            Log::error('Error removing task from employee: ' . $e->getMessage());

            return response()->json([
                'message' => EmployeeTaskHttpEnum::TASK_EMPLOYEE_ERROR_REMOVE->value,
            ], 500);
        }

        return response()->json([
            'message' => EmployeeTaskHttpEnum::TASK_EMPLOYEE_SUCCESS_REMOVE->value,
        ], 200);
    }
}
