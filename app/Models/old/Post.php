<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable = ['post_image', 'user_id', 'title', 'body'];
    public  function User()
    {
        # code...
        return $this->belongsTo("App\Models\User");
    }
}
