<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{

    protected $table  = "expenses";

    protected $fillable = [
        'date',
        'reason',
        'amount',
        'attachments'
    ];
    use HasFactory;
}
