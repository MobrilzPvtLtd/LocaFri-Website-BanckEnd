<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContractIn extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'address', 'postal_code',  'email','license_photo','record_kilometers','fuel_level','vehicle_images','vehicle_damage_comments','customer_signature','booking_id'];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
}
