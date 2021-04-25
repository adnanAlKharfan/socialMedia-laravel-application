<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'slug'];
    public function permission()
    {
        # code...
        return $this->belongsToMany('App\Models\Permission', 'permission_role');
    }
    public function User()
    {
        # code...
        return $this->belongsToMany('App\Models\User', 'users_roles');
    }
}
