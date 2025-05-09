<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use App\Http\Resources\ProjectResource;
use App\Http\Resources\EmployeeResource;
use App\Enums\Database\EmployeeProjectHttpEnum;

class EmployeeProjectController extends Controller
{
    /**
     * Pobierz projekty pracownika
     */
    public function getProjects(Employee $employee): JsonResponse
    {
        try {
            $projects = $employee->projects;
        } catch (\Exception $e) {
            Log::error('Error fetching employee projects: ' . $e->getMessage());

            return response()->json([
                'message' => EmployeeProjectHttpEnum::EMPLOYEE_PROJECT_ERROR_GET->value,
            ], 500);
        }

        return ProjectResource::collection($projects)
            ->response();
    }

    /**
     * Pobierz pracowników przypisanych do projektu
     */
    public function getEmployees(Project $project): JsonResponse
    {
        try {
            $employees = $project->employees;
        } catch (\Exception $e) {
            Log::error('Error fetching project employees: ' . $e->getMessage());

            return response()->json([
                'message' => EmployeeProjectHttpEnum::PROJECT_EMPLOYEE_ERROR_GET->value,
            ], 500);
        }

        return EmployeeResource::collection($employees)
            ->response();
    }

    /**
     * Przypisz pracownika do projektu
     */
    public function assignEmployee(Request $request, Project $project): JsonResponse
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
        ]);

        try {
            // Sprawdź, czy relacja już istnieje
            if (!$project->employees()->where('employee_id', $request->employee_id)->exists()) {
                $project->employees()->attach($request->employee_id);
            }
        } catch (\Exception $e) {
            Log::error('Error assigning employee to project: ' . $e->getMessage());

            return response()->json([
                'message' => EmployeeProjectHttpEnum::EMPLOYEE_PROJECT_ERROR_ASSIGN->value,
            ], 500);
        }

        return response()->json([
            'message' => EmployeeProjectHttpEnum::EMPLOYEE_PROJECT_SUCCESS_ASSIGN->value,
        ], 200);
    }

    /**
     * Przypisz projekt do pracownika
     */
    public function assignProject(Request $request, Employee $employee): JsonResponse
    {
        $request->validate([
            'project_id' => 'required|exists:projects,id',
        ]);

        try {
            // Sprawdź, czy relacja już istnieje
            if (!$employee->projects()->where('project_id', $request->project_id)->exists()) {
                $employee->projects()->attach($request->project_id);
            }
        } catch (\Exception $e) {
            Log::error('Error assigning project to employee: ' . $e->getMessage());

            return response()->json([
                'message' => EmployeeProjectHttpEnum::PROJECT_EMPLOYEE_ERROR_ASSIGN->value,
            ], 500);
        }

        return response()->json([
            'message' => EmployeeProjectHttpEnum::PROJECT_EMPLOYEE_SUCCESS_ASSIGN->value,
        ], 200);
    }

    /**
     * Usuń pracownika z projektu
     */
    public function removeEmployee(Project $project, $employeeId): JsonResponse
    {
        try {
            $project->employees()->detach($employeeId);
        } catch (\Exception $e) {
            Log::error('Error removing employee from project: ' . $e->getMessage());

            return response()->json([
                'message' => EmployeeProjectHttpEnum::EMPLOYEE_PROJECT_ERROR_REMOVE->value,
            ], 500);
        }

        return response()->json([
            'message' => EmployeeProjectHttpEnum::EMPLOYEE_PROJECT_SUCCESS_REMOVE->value,
        ], 200);
    }

    /**
     * Usuń projekt od pracownika
     */
    public function removeProject(Employee $employee, $projectId): JsonResponse
    {
        try {
            $employee->projects()->detach($projectId);
        } catch (\Exception $e) {
            Log::error('Error removing project from employee: ' . $e->getMessage());

            return response()->json([
                'message' => EmployeeProjectHttpEnum::PROJECT_EMPLOYEE_ERROR_REMOVE->value,
            ], 500);
        }

        return response()->json([
            'message' => EmployeeProjectHttpEnum::PROJECT_EMPLOYEE_SUCCESS_REMOVE->value,
        ], 200);
    }
}
