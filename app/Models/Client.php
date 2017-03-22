<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use \Illuminate\Support\Facades\DB;

class Client extends Model
{
    public $incrementing = false;

    protected $primaryKey = 'uid';

    /**
     * @var string The name of the table
     */
    protected $table = 'clients';

    /**
     * @param string $userUid
     * @return mixed
     */
    public function getClientsByUserId($userUid)
    {
        return DB::select('SELECT c.* FROM clients c INNER JOIN users_clients_privileges ucp ON c.`uid` = ucp.`clients_uid` WHERE ucp.`users_uid` = ?', [$userUid]);
    }

    /**
     * @return mixed
     */
    public function getAllActiveClients()
    {
        return self::where('deleted', 0)->get();
    }
}
