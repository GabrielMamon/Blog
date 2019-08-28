<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'post';

    protected $attributes = [
        'author', 'title', 'title_slugged', 'content', 'imagepath', 'category', 'featured'
    ];

    public function user(){
        return $this->belongsTo('App\User','author');
    }


}
