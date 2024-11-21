<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;


    protected $fillable = [
        'name',
        'Dprice',
        'wprice',
        'mprice',
        'total_price',
        'day_count',
        'week_count',
        'month_count',
        'additional_driver',
        'booster_seat',
        'child_seat',
        'exit_permit',
        'pickUpLocation',
        'dropOffLocation',
        'pickUpDate',
        'pickUpTime',
        'collectionTime',
        'collectionDate',
        'targetDate',
        'status',
        'payment_type',
        'is_viewbooking',
        'is_rejected',
        'is_contract',
        'Actions'
    ];


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function ContractIn()
    {
        return $this->hasOne(ContractIn::class, 'booking_id', 'id');
    }

    // Define relationship with Checkout
    public function checkout()
    {
        return $this->hasOne(Checkout::class, 'booking_id', 'id');
    }

    public function ContractOut()
    {
        return $this->hasOne(ContractOut::class, 'contract_id');
    }

    public function transaction()
    {
        return $this->hasOne(Transaction::class, 'order_id');
    }

}



