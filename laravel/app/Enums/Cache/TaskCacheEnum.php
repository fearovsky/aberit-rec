<?php

namespace App\Enums\Cache;

enum TaskCacheEnum: string
{
    case TASKS_ALL = 'tasks.all';
    case TASK_BY_ID = 'tasks.%d';

    public function key(int|array $params = []): string
    {
        if (is_int($params)) {
            return sprintf($this->value, $params);
        }

        if (empty($params)) {
            return $this->value;
        }

        return sprintf($this->value, ...$params);
    }
}
