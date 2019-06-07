<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $fillable = ['body', 'post_id'];

    /**
     * ここからリレーション
     * - Comment belongsTo Post
     */
    public function post() {
        return $this->belongsTo('App\Post');
    }
}
