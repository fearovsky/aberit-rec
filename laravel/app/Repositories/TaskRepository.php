<?php

namespace App\Repositories;

use App\Models\Task;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\TaskRepositoryI;

class TaskRepository implements TaskRepositoryI
{
    /**
     * @return Collection
     */
    public function getAll(): Collection
    {
        return Task::all();
    }

    /**
     * @param int $id
     * @return Task|null
     */
    public function getById(int $id): ?Task
    {
        return Task::findOrFail($id);
    }

    /**
     * @param array $data
     * @return Task
     */
    public function create(array $data): Task
    {
        return Task::create($data);
    }

    /**
     * @param Task $task
     * @param array $data
     * @return bool
     */
    public function update(Task $task, array $data): bool
    {
        return $task->update($data);
    }

    /**
     * @param Task $task
     * @return bool
     */
    public function delete(Task $task): bool
    {
        return $task->deleteOrFail();
    }
}
