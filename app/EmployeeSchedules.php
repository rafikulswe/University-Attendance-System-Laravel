<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmployeeSchedules extends Model
{
    protected $fillable = [
        'employee_id', 'semister_id', 'day_index', 'start_time', 'end_time',
    ];
}
