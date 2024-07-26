<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employees extends Model
{

    protected $table  = 'employees';

    protected $fillable  = [
        'name',
        'email',
        'phone',
        'password',
        'hourly_rate',
        'profile_image',
        'address',
        'status'
    ];
    use HasFactory;
}
