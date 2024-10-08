<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    protected $fillable = ['name' ];
    // , 'permissions'

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'group_permission');
    }
    
    public function users()
    {
        return $this->hasMany(User::class);
    }

}
