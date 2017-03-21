<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserPrivilege extends Model
{
    protected $table = 'users_privileges';

    public function user()
    {
        return $this->belongsTo('App\User', 'uid', 'users_uid');
    }
}
