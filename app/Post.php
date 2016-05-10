<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

    protected $table = 'posts';

    protected $fillable = ['category_id', 'title', 'description', 'image', 'visible'];

    public function postImages()
    {
        return $this->hasMany('app\PostImage', 'post_id', 'id');
    }

    public function category()
    {
        return $this->belongsTo('App\Category', 'category_id', 'id');
    }

}
