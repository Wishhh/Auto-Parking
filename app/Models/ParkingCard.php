<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParkingCard extends Model
{
    use HasFactory;

    protected $fillable = [
        'entering_date',
        'car_number',
        'car_model',
        'car_size',
    ];
}
