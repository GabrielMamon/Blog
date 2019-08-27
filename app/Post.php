<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $tables = 'post';

    protected $attributes = [
        'author', 'title', 'title_slugged', 'content', 'imagepath', 'category', 'featured'
    ];
}
