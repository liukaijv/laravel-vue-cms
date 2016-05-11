<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    /**
     * @var string
     */
    protected $table = 'comments';

    /**
     * @var array
     */
    protected $fillable = ['content'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function post()
    {
        return $this->belongsTo('App\Post', 'post_id', 'id');
    }
}
