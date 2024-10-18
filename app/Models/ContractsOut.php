<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContractsOut extends Model
{
    use HasFactory;

    // Specify the table name if it does not follow Laravel's conventions
    protected $table = 'contractsout';

    protected $fillable = [
        'contract_id',
        'name',
        'address',
        'postal_code',
        'email',
        'record_kilometers',
        'fuel_level',
        'vehicle_images',
        'vehicle_damage_comments',
        'customer_signature',
        'odometer_image' // Ensure this is included
    ];

    public function contract()
{
    return $this->belongsTo(Contract::class, 'contract_id');
}
public function booking()
{
    return $this->belongsTo(Booking::class, 'booking_id');
}

}
