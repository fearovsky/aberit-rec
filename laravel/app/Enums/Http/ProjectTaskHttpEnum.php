<?php

namespace App\Enums\Database;

enum ProjectTaskHttpEnum: string
{
    case PROJECT_TASK_ERROR_GET = 'project_task.error.get';
    case TASK_PROJECT_ERROR_GET = 'task_project.error.get';

    case PROJECT_TASK_ERROR_CREATE = 'project_task.error.create';
    case TASK_PROJECT_ERROR_CHANGE = 'task_project.error.change';

    case TASK_PROJECT_ERROR_NOT_FOUND = 'task_project.error.not_found';

    case TASK_PROJECT_SUCCESS_CHANGE = 'task_project.success.change';
}
