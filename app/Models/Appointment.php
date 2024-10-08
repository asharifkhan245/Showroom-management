<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{

    protected $table  = 'appointments';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'appointment_date',
        'appointment_time',
        'status'
    ];

    use HasFactory;
}
