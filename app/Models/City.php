<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $fillable = [
        'city_name',
        'original_cost',
        'pickup_cost',
        'governorate_id',
    ];
    
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function governorate()
    {
        return $this->belongsTo(Governorate::class);
    }
}
