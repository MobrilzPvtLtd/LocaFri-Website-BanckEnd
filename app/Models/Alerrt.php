<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alerrt extends Model
{
    use HasFactory;
    protected $fillable = [
        'vehicle_id',
        'kilometer',
        'servicing',
        'status',
    ];
    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }
}
