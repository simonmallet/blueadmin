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
     * @param $userUid
     * @param $clientUid
     * @return bool
     */
    public function canUserAccessClient($userUid, $clientUid)
    {
        return DB::select('SELECT count(*) as access FROM users_clients_privileges ucp WHERE ucp.clients_uid = ? AND ucp.users_uid = ?', [$clientUid, $userUid])[0]->access;
    }

    /**
     * @return mixed
     */
    public function getAllActiveClients()
    {
        return self::where('deleted', 0)->get();
    }

    public function getClientById($clientUid)
    {
        $client = self::where('deleted', 0)->where('uid', $clientUid)->get();
        if (count($client) > 0) {
            return $client[0];
        }
    }
}
