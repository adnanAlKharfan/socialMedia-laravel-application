<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'users';
    protected $fillable = [
        'name',
        'email',
        'password', 'username', 'avatar'
    ];


    public function Role()
    {
        # code...
        return $this->belongsToMany('App\Models\Role', 'role_user');
    }
    public function Permission()
    {
        # code...
        return $this->belongsToMany('App\Models\Permission', 'permission_user');
    }
    public  function Post()
    {
        # code...
        return $this->hasMany("App\Models\Post");
    }
    public  function hasRole()
    {
        # code...

        foreach ($this->Role()->get() as $i) {
            if ($i->name == 'admin') return true;
        }

        return false;
    }
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
