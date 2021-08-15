<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BMI extends Model
{
    use HasFactory;
    protected $fillable = [
        'bmi',
        'user_id',
        'date'
    ];
}
