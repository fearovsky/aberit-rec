<?php

namespace App\Enums\Cache;

enum ProjectCacheEnum: string
{
    case PROJECTS_ALL = 'projects.all';
    case PROJECT_BY_ID = 'projects.%d';

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
