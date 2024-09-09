<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    use HasFactory;

    protected $fillable = ['name' , 'city' , 'governorate'];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
