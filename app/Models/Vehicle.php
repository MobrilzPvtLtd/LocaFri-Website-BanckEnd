<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;


class Vehicle extends Model
{
    use HasFactory;
    use HasSlug;
    protected $fillable = [
        'vehicle_id','name','model','type','desc','mitter','image','body','seat','door','luggage','fuel','auth','trans','exterior','interior','featured','features','Dprice','wprice','mprice','location','status','available_time','permitted_kilometers_day','permitted_kilometers_week','permitted_kilometers_month'
    ];
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    public function vehicleStatus()
    {
        return $this->hasOne(Vehiclestatus::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }
    public function bookings()
    {
        return $this->hasMany(Booking::class, 'vehicle_id');
    }

}

