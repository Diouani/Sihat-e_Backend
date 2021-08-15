<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Glucose extends Model
{
    use HasFactory;

    protected $fillable = [
        'mg',
        'user_id',
        'date'
    ];
}
