<?php

namespace App\Enums\Database;

enum ProjectHttpEnum: string
{
    case PROJECT_ERROR_GET_ALL = 'project.error.get_all';
    case PROJECT_ERROR_GET_ONE = 'project.error.get_one';

    case PROJECT_ERROR_CREATE = 'project.error.create';
    case PROJECT_ERROR_UPDATE = 'project.error.update';
    case PROJECT_ERROR_DELETE = 'project.error.delete';

    case PROJECT_SUCCESS_CREATE = 'project.success.create';
    case PROJECT_SUCCESS_UPDATE = 'project.success.update';
    case PROJECT_SUCCESS_DELETE = 'project.success.delete';
}
