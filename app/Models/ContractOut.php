<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContractOut extends Model
{
    use HasFactory;

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
        'fuel_image'
    ];

    public function contractIn()
    {
        return $this->hasOne(ContractIn::class, 'contract_id', 'id');
    }

}
