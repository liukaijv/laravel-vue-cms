<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

    /**
     * @var string
     */
    protected $table = 'posts';

    /**
     * @var array
     */
    protected $fillable = ['category_id', 'title', 'content', 'description', 'image', 'visible'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function postImages()
    {
        return $this->hasMany('App\PostImage', 'post_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo('App\Category', 'category_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tags()
    {
        return $this->belongsToMany('App\Tag');
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeLatest($query)
    {
        return $query->orderBy('updated_at', 'desc');
    }

}
