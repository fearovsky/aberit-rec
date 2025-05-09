<?php

namespace App\Repositories;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\EmployeeRepositoryI;

class EmployeeRepository implements EmployeeRepositoryI
{
    /**
     * @return Collection
     */
    public function getAll(): Collection
    {
        return Employee::all();
    }

    /**
     * @param int $id
     * @return Employee|null
     */
    public function getById(int $id): ?Employee
    {
        return Employee::findOrFail($id);
    }

    /**
     * @param array $data
     * @return Employee
     */
    public function create(array $data): Employee
    {
        return Employee::create($data);
    }

    /**
     * @param Employee $employee
     * @param array $data
     * @return bool
     */
    public function update(Employee $employee, array $data): bool
    {
        return $employee->update($data);
    }

    /**
     * @param Employee $employee
     * @return bool
     */
    public function delete(Employee $employee): bool
    {
        return $employee->deleteOrFail();
    }
}
