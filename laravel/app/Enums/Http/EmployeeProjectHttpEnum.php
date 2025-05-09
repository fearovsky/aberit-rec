<?php

namespace App\Enums\Http;

enum EmployeeProjectHttpEnum: string
{
    case EMPLOYEE_PROJECT_ERROR_GET = 'employee_project.error.get';
    case PROJECT_EMPLOYEE_ERROR_GET = 'project_employee.error.get';

    case EMPLOYEE_PROJECT_ERROR_ASSIGN = 'employee_project.error.assign';
    case PROJECT_EMPLOYEE_ERROR_ASSIGN = 'project_employee.error.assign';

    case EMPLOYEE_PROJECT_ERROR_REMOVE = 'employee_project.error.remove';
    case PROJECT_EMPLOYEE_ERROR_REMOVE = 'project_employee.error.remove';

    case EMPLOYEE_PROJECT_SUCCESS_ASSIGN = 'employee_project.success.assign';
    case PROJECT_EMPLOYEE_SUCCESS_ASSIGN = 'project_employee.success.assign';

    case EMPLOYEE_PROJECT_SUCCESS_REMOVE = 'employee_project.success.remove';
    case PROJECT_EMPLOYEE_SUCCESS_REMOVE = 'project_employee.success.remove';
}
