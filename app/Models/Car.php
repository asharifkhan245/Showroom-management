<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    protected $table  = 'cars';

    protected $fillable = [
        'brand',
        'model',
        'made_year',
        'horse_power',
        'title',
        'number_plate',
        'chassis_number',
        'engine_number',
        'cost',
        'price',
        'car_report_doc',
        'condition_description',
        'images',
        'features',
        'status',
        'qr_code_path'

    ];

    use HasFactory;
}
