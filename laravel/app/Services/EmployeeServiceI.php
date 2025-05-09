<?php

namespace App\Services;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Collection;

interface EmployeeServiceI
{
    public function getAll(): Collection;

    public function getById(int $id): ?Employee;

    public function create(array $data): Employee;

    public function update(Employee $employee, array $data): bool;

    public function delete(Employee $employee): bool;
}
