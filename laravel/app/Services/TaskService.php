<?php

namespace App\Services;

use App\Models\Task;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Collection;
use App\Enums\Cache\TaskCacheEnum;
use App\Repositories\TaskRepositoryI;

class TaskService implements TaskServiceI
{
    public function __construct(
        private TaskRepositoryI $taskRepository,
    ) {
    }

    public function getAll(): Collection
    {
        return Cache::remember(TaskCacheEnum::TASKS_ALL->key(), 1800, function () {
            return $this->taskRepository->getAll();
        });
    }

    public function getById(int $id): ?Task
    {
        return Cache::remember(TaskCacheEnum::TASK_BY_ID->key($id), 1800, function () use ($id) {
            return $this->taskRepository->getById($id);
        });
    }

    public function create(array $data): Task
    {
        $task = $this->taskRepository->create($data);

        Cache::forget(TaskCacheEnum::TASKS_ALL->key());

        return $task;
    }

    public function update(Task $task, array $data): bool
    {
        $result = $this->taskRepository->update($task, $data);

        if ($result) {
            Cache::forget(TaskCacheEnum::TASK_BY_ID->key($task->id));
            Cache::forget(TaskCacheEnum::TASKS_ALL->key());
        }

        return $result;
    }

    public function delete(Task $task): bool
    {
        $result = $this->taskRepository->delete($task);

        if ($result) {
            Cache::forget(TaskCacheEnum::TASK_BY_ID->key($task->id));
            Cache::forget(TaskCacheEnum::TASKS_ALL->key());
        }

        return $result;
    }
}
