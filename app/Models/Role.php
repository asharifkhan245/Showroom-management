<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{

    protected $table = 'role_privilages';

    protected $fillable = [
        'name',
        'privilages'
    ];

    use HasFactory;
}
