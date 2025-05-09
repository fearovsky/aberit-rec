<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'position',
    ];

    public function projects()
    {
        return $this->belongsToMany(Project::class, 'employee_project');
    }

    public function tasks()
    {
        return $this->belongsToMany(Task::class, 'employee_task');
    }
}
