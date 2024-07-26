<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{

    protected $table = 'customers';

    protected $fillable  = [

        'name',
        'email',
        'phone',
        'billing_address',
        'id_card_number',
    ];
    use HasFactory;
}
