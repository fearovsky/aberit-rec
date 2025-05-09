<?php

namespace App\Repositories;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Collection;
use Laravel\App\Repositories\EmployeeRepositoryI;

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
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function update(int $id, array $data): bool
    {
        $employee = $this->getById($id);
        if (!$employee) {
            return false;
        }

        return $employee->update($data);
    }

    /**
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        $employee = $this->getById($id);
        if (!$employee) {
            return false;
        }

        return $employee->deleteOrFail();
    }
}
