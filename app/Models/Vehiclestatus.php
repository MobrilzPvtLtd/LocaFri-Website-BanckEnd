<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehiclestatus extends Model
{
    use HasFactory;

    // Specify the table name if it is different from the default plural name
    protected $table = 'vehiclestatuses';  // Use plural name to match the migration table name

    protected $fillable = [
        'vehicle_id',
        'name',
        'kilometer',
        'fule',
        'damage',
    ];

    // Define the relationship to the Vehicle model
    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }
}
