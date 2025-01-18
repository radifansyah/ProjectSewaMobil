<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Rental extends Model
{
    //
    use HasFactory;

    // Tentukan kolom yang dapat diisi
    protected $fillable = [
        'user_id',
        'car_id',
        'start_date',
        'end_date',
        'total_cost',
        'status',
    ];

      // Relasi dengan User
      public function user()
      {
          return $this->belongsTo(User::class);
      }

      // Relasi dengan Car
      public function car()
      {
          return $this->belongsTo(Car::class);
      }
}
