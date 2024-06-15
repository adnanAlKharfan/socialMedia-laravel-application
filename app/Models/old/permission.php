<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class permission extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'slug'];
    public function Role()
    {
        # code...
        return $this->belongsToMany('App\Models\Role', 'permission_role');
    }
    public function User()
    {
        # code...
        return $this->belongsToMany('App\Models\User', 'users_permissions');
    }
}
