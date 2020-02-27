<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Video extends Model
{
    use SoftDeletes;
    protected $fillable = ['title', 'description', 'user_id', 'video_path', 'image'];



    public function comments()
    {
        return $this->morphMany('App\Coment', 'commentable');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
