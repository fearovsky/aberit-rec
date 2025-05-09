<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Services\EmployeeServiceI;
use Illuminate\Support\Facades\Log;
use App\Enums\Database\EmployeeHttpEnum;
use App\Http\Resources\EmployeeResource;

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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Employee $employee)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        //
    }
}
