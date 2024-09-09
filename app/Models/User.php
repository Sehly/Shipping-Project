<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    protected $fillable = ['name' , 'username' , 'email' , 'password' , 'role' , 'company_name' , 'group_id'];


        public function group()
        {
            return $this->belongsTo(Group::class);
        }
        
        public function orders()
        {
            return $this->hasMany(Order::class);
        }
}
