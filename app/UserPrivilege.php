<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserPrivilege extends Model
{
    const USER_PRIVILEGE_USER = 'USER';
    const USER_PRIVILEGE_ADMIN = 'ADMIN';

    protected $table = 'users_privileges';

    public function user()
    {
        return $this->belongsTo('App\User', 'uid', 'users_uid');
    }
}
