<?php

namespace App\Services;

use App\Models\Task;
use Illuminate\Database\Eloquent\Collection;

interface TaskServiceI
{
    public function getAll(): Collection;

    public function getById(int $id): ?Task;

    public function create(array $data): Task;

    public function update(Task $task, array $data): bool;

    public function delete(Task $task): bool;
}
