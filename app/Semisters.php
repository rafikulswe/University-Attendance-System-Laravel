<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Semisters extends Model
{
    protected $fillable = [
        'employee_id', 'semister_name', 'year', 'version', 'user_type', 'approval_status', 'approved_by',
    ];
}
