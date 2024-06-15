<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable = [

        'category_id',
        'photo_id',
        'title',
        'body'



    ];

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }



    public function user()
    {


        return $this->belongsTo('App\Models\User');
    }



    public function photo()
    {


        return $this->belongsTo('App\Models\Photo');
    }


    public function category()
    {


        return $this->belongsTo('App\Models\Category');
    }



    public function comments()
    {


        return $this->hasMany('App\Models\Comment', 'post_id');
    }


    public function photoPlaceholder()
    {


        return "http://placehold.it/700x200";
    }
}
