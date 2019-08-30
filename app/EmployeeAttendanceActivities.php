<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmployeeAttendanceActivities extends Model
{
    protected $fillable = [
        'attendance_id', 'employee_id', 'semister_id', 'attend_date', 'user_type', 'assign_advisor_id', 'seen_status',
    ];
}
