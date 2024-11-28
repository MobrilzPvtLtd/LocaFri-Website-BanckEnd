<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    public function booking()
    {
        return $this->hasOne(Booking::class, 'id', 'order_id');
    }
}
