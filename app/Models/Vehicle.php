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
        'name','model','type','desc','mitter','image','body','seat','door','luggage','fuel','auth','trans','exterior','interior','featured','features','Dprice','wprice','mprice','location','status','available',
    ];
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

}

