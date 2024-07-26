<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sub_Admin extends Model
{

    protected $table = 'sub_admins';

    protected $fillable = [
        'name',
        'email',
        'password',
        'permissions',
    ];
    
    use HasFactory;
}
