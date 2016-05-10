<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostImage extends Model
{
    protected $table = 'post_images';

    protected $fillable = ['post_id', 'name'];

    public function post()
    {
        return $this->belongsTo('app\Post', 'post_id', 'id');
    }
}
