<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    /**
     * @var string
     */
    protected $table = 'tags';

    /**
     * @var array
     */
    protected $fillable = ['name'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function posts()
    {
        return $this->belongsToMany('App\Post');
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
