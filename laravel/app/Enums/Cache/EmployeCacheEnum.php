<?php

namespace App\Enums\Cache;

enum EmployeCacheEnum: string
{
    case EMPLOYEES_ALL = 'employees.all';
    case EMPLOYEE_BY_ID = 'employees.%d';
    case EMPLOYEE_PROJECTS = 'employee.%d.projects';
    case EMPLOYEE_TASKS = 'employee.%d.tasks';

    /**
     * Generuj klucz cache z parametrami
     *
     * @param int|array $params
     * @return string
     */
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
