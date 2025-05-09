<?php

namespace App\Enums\Database;

enum EmployeeHttpEnum: string
{
    case EMPLOYEE_ERROR_GET_ALL = 'employee.error.get_all';
    case EMPLOYEE_ERROR_GET_ONE = 'employee.error.get_one';

    case EMPLOYEE_ERROR_CREATE = 'employee.error.create';
    case EMPLOYEE_ERROR_UPDATE = 'employee.error.update';

    case EMPLOYE_SUCCESS_CREATE = 'employee.success.create';
    case EMPLOYEE_SUCCESS_UPDATE = 'employee.success.update';
}
