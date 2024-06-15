<?php

namespace app\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use App\Models\Role;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role_id', 'photo_id',  'photo_id', 'created_at', 'updated_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];



    public function role()
    {

        return $this->belongsTo(Role::class);
    }



    public function photo()
    {


        return $this->belongsTo("App\Models\Photo");
    }




    //    public function setPasswordAttribute($password){
    //
    //
    //        if(!empty($password)){
    //
    //
    //            $this->attributes['password'] = bcrypt($password);
    //
    //
    //        }
    //
    //
    //        $this->attributes['password'] = $password;
    //
    //
    //
    //
    //    }




    public function isAdmin()
    {


        if ($this->role->name  == "administrator") {


            return true;
        }


        return false;
    }



    public function posts()
    {


        return $this->hasMany('App\Models\Post', 'user_id');
    }



    public function getGravatarAttribute()
    {


        $hash = md5(strtolower(trim($this->attributes['email']))) . "?d=mm&s=";
        return "http://www.gravatar.com/avatar/$hash";
    }
}
