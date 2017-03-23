<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use \Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
       'first_name', 'last_name', 'username', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function userPrivilege()
    {
        return $this->hasOne('App\UserPrivilege', 'users_uid', 'uid');
    }

    /**
     * @return array
     */
    public function getActiveUsers()
    {
        return DB::select('SELECT uid, first_name, last_name, username FROM users WHERE active=1 and deleted=0');
    }
}
