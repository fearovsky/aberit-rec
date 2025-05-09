<?php

namespace App\Enums\Database;

enum EmployeeTaskHttpEnum: string
{
    case EMPLOYEE_TASK_ERROR_GET = 'employee_task.error.get';
    case TASK_EMPLOYEE_ERROR_GET = 'task_employee.error.get';

    case EMPLOYEE_TASK_ERROR_ASSIGN = 'employee_task.error.assign';
    case TASK_EMPLOYEE_ERROR_ASSIGN = 'task_employee.error.assign';

    case EMPLOYEE_TASK_ERROR_REMOVE = 'employee_task.error.remove';
    case TASK_EMPLOYEE_ERROR_REMOVE = 'task_employee.error.remove';

    case EMPLOYEE_TASK_SUCCESS_ASSIGN = 'employee_task.success.assign';
    case TASK_EMPLOYEE_SUCCESS_ASSIGN = 'task_employee.success.assign';

    case EMPLOYEE_TASK_SUCCESS_REMOVE = 'employee_task.success.remove';
    case TASK_EMPLOYEE_SUCCESS_REMOVE = 'task_employee.success.remove';
}
