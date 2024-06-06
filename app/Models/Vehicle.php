<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Vehicle extends Model
{
    use HasFactory;
    protected $fillable = [
        'name','model','type','mitter','image','body','seat','door','luggage','fuel','auth','trans','exterior','interior','featured',
    ];


}

