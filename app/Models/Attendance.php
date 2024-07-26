<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{

    protected $table  = 'attendance';
    protected $fillable  = [
        'employee_id',
        'clock_in',
        'clock_out',
        'date',
        'break_in',
        'break_out',
        'working_hours'

    ];
    use HasFactory;
}
