<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{

    public function comments()
    {

        return $this->hasMany(Comment::class);

    }

    public function user()
    {

        return $this->belongsTo(User::class);


    }

    public function author()
    {

        return $this->belongsTo(User::class);
    }
    

}
