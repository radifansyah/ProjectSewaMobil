<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Car extends Model
{
    //
    use HasFactory;/*  tambahkan  */

    protected $fillable = [
        'brand',
        'model',
        'license_plate',
        'rental_rate',
        'status',
    ];
}
