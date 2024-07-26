<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{

    protected $table  = 'invoice';

    protected $fillable  = [
        'customer_id',
        'car_id',
        'selling_price',
        'date_handed_over'
    ];
    use HasFactory;
}
