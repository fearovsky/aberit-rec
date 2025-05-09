<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;

use App\Models\Employee;

interface EmployeeRepositoryI
{
    public function getAll(): Collection;

    public function getById(int $id): ?Employee;

    public function create(array $data): Employee;

    public function update(int $id, array $data): bool;

    public function delete(int $id): bool;
}
