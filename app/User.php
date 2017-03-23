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
     * @param bool $includeAdmin
     * @return array
     */
    public function getActiveUsers($includeAdmin = false)
    {
        if ($includeAdmin) {
            return DB::select('SELECT uid, first_name, last_name, username FROM users WHERE active=1 and deleted=0');
        }
        return DB::select('SELECT uid, first_name, last_name, username FROM users u INNER JOIN users_privileges up ON u.uid = up.users_uid WHERE active=1 AND deleted=0 AND up.level != ?', [UserPrivilege::USER_PRIVILEGE_ADMIN]);
    }
}
