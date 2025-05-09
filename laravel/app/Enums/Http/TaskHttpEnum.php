<?php

namespace App\Enums\Http;

enum TaskHttpEnum: string
{
    case TASK_ERROR_GET_ALL = 'task.error.get_all';
    case TASK_ERROR_GET_ONE = 'task.error.get_one';

    case TASK_ERROR_CREATE = 'task.error.create';
    case TASK_ERROR_UPDATE = 'task.error.update';
    case TASK_ERROR_DELETE = 'task.error.delete';

    case TASK_SUCCESS_CREATE = 'task.success.create';
    case TASK_SUCCESS_UPDATE = 'task.success.update';
    case TASK_SUCCESS_DELETE = 'task.success.delete';
}
