<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    protected $primaryKey = 'role_index';
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $fillable = ['name'];

    public function users() {
        return $this->hasMany('App\User', 'role_id', 'role_index');
      }
}
