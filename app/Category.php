<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';

    protected $fillable = ['name', 'parent_id'];

    public function posts()
    {
        return $this->hasMany('$faker\Post', 'post_id', 'id');
    }

    public function category()
    {
        return $this->belongsTo('App\Category', 'parent_id', 'id');
    }

}
