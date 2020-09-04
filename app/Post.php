<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //
    protected $fillable = [
    'category_id',
     'user_id',
     'title',
     'content',
     'slug',
     'featured_image',
     'is_featured',
     'is_published'
     ];
}
