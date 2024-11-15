<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Checkout extends Model
{
    use HasFactory;
    protected $fillable = ['first_name', 'last_name', 'email',  'address_first','address_last',];

    public function booking()
    {
        return $this->belongsTo(Booking::class, 'booking_id', 'id');
    }

}

// In app/Models/Checkout.php
// public function booking()
// {
//     return $this->belongsTo(Booking::class, 'booking_id');
// }


// public function booking()
// {
//     return $this->hasOne(Booking::class, 'booking_id', 'id');
// }
