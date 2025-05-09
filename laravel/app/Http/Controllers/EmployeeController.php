<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Services\EmployeeServiceI;
use Illuminate\Support\Facades\Log;
use App\Enums\Database\EmployeeHttpEnum;
use App\Http\Resources\EmployeeResource;
use App\Http\Requests\{
    EmployeeStoreRequest,
    EmployeeUpdateRequest
};

class EmployeeController extends Controller
{
    public function __construct(
        private EmployeeServiceI $employeeService,
    ) {
    }

    public function index(): JsonResponse
    {
        try {
            $employees = $this->employeeService->getAll();
        } catch (\Exception $e) {
            Log::error('Error fetching employees: ' . $e->getMessage());

            return response()->json([
                'message' => EmployeeHttpEnum::EMPLOYEE_ERROR_GET_ALL->value,
            ], 500);
        }

        return EmployeeResource::collection($employees)
            ->response();
    }

    public function store(EmployeeStoreRequest $request)
    {
        try {
            $employee = $this->employeeService->create($request->validated());
        } catch (\Exception $e) {
            Log::error('Error creating employee: ' . $e->getMessage());

            return response()->json([
                'message' => EmployeeHttpEnum::EMPLOYEE_ERROR_CREATE->value,
            ], 500);
        }

        return EmployeeResource::make($employee)
            ->response()
            ->setStatusCode(201);
    }

    public function show(Employee $employee)
    {
        return EmployeeResource::make($employee)
            ->response();
    }

    public function update(EmployeeUpdateRequest $request, Employee $employee)
    {
        try {
            $employee = $this->employeeService->update($employee, $request->validated());
        } catch (\Exception $e) {
            Log::error('Error updating employee: ' . $e->getMessage());

            return response()->json([
                'message' => EmployeeHttpEnum::EMPLOYEE_ERROR_UPDATE->value,
            ], 500);
        }

        return EmployeeResource::make($employee)
            ->response()
            ->setStatusCode(200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        try {
            $this->employeeService->delete($employee);
        } catch (\Exception $e) {
            Log::error('Error deleting employee: ' . $e->getMessage());

            return response()->json([
                'message' => EmployeeHttpEnum::EMPLOYEE_ERROR_DELETE->value,
            ], 500);
        }

        return response()->json([
            'message' => EmployeeHttpEnum::EMPLOYEE_SUCCESS_DELETE->value,
        ], 200);
    }
}
