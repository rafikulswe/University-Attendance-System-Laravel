<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmployeeDepartment extends Model
{
    protected $fillable = [
        'depertment', 'sort_name',
    ];
}
