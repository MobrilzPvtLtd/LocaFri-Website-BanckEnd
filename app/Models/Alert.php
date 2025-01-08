<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alert extends Model
{
    use HasFactory;
    protected $fillable = [
        'vehicle_id',
        'kilometer',
        'servicing',
        'status',
        'seen',
    ];
   public function vehicle() {
        return $this->belongsTo(Vehicle::class, 'vehicle_id');
    }
}
