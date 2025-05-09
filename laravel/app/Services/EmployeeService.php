<?php

namespace Laravel\App\Services;

use App\Models\Employee;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Collection;
use Laravel\App\Enums\Cache\EmployeCacheEnum;
use Laravel\App\Repositories\EmployeeRepositoryI;

class EmployeeService implements EmployeeServiceI
{
    public function __construct(
        private EmployeeRepositoryI $employeeRepository,
    ) {
    }

    public function getAll(): Collection
    {
        return Cache::remember(EmployeCacheEnum::EMPLOYEES_ALL->key(), 1800, function () {
            return $this->employeeRepository->getAll();
        });
    }

    public function getById(int $id): ?Employee
    {
        return Cache::remember(EmployeCacheEnum::EMPLOYEE_BY_ID->key($id), 1800, function () use ($id) {
            return $this->employeeRepository->getById($id);
        });
    }

    public function create(array $data): Employee
    {
        $employee = $this->employeeRepository->create($data);

        Cache::forget(EmployeCacheEnum::EMPLOYEES_ALL->key());

        return $employee;
    }

    public function update(int $id, array $data): bool
    {
        $result = $this->employeeRepository->update($id, $data);

        if ($result) {
            Cache::forget(EmployeCacheEnum::EMPLOYEE_BY_ID->key($id));
            Cache::forget(EmployeCacheEnum::EMPLOYEES_ALL->key());
        }

        return $result;
    }

    public function delete(int $id): bool
    {
        $result = $this->employeeRepository->delete($id);

        if ($result) {
            Cache::forget(EmployeCacheEnum::EMPLOYEE_BY_ID->key($id));
            Cache::forget(EmployeCacheEnum::EMPLOYEES_ALL->key());
        }

        return $result;
    }

}
