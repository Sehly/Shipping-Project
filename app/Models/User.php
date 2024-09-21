<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
// use Illuminate\Database\Eloquent\Model;
// use Illuminate\Contracts\Auth\MustVerifyEmail;




class User extends Authenticatable
{
    use HasApiTokens, Notifiable;
    // use HasFactory;

    protected $fillable = ['name' , 'username' , 'email' , 'password' , 'role' , 'company_name' , 'group_id' ,'phone' , 'address', 'branch_id'];

        public function group()
        {
            return $this->belongsTo(Group::class);
        }
        
        public function orders()
        {
            return $this->hasMany(Order::class);
        }

        public function branches()
        {
            return $this->belongsTo(Branch::class);
        }

}
