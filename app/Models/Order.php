<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['status' , 'weight' , 'cost' , 'max_weight' , 'created_date' , 'branch_id' , 'region_id' , 'user_id' , 'city_id', 'governorate_id', 'orderType' , 'clientName' , 'phone1' , 'email' , 'village', 'toVillage' , 'shippingType' , 'paymentType' , 'notes'];
    

    public function products()
    {
        return $this->hasMany(Product::class);
    }
    
    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function governorate()
    {
        return $this->belongsTo(Governorate::class);
    }
    
    public function city()
    {
        return $this->belongsTo(City::class);
    }

}
