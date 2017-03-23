<?php

namespace App\Models;

use App\UserPrivilege;
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

    /**
     * @param $clientUid
     * @return mixed
     */
    public function getClientById($clientUid)
    {
        $client = self::where('deleted', 0)->where('uid', $clientUid)->get();
        if (count($client) > 0) {
            return $client[0];
        }
    }

    /**
     * Note: Always exclude admin user for this query
     *
     * @param $clientUid
     * @return array
     */
    public function getUsersPrivilegesForClient($clientUid)
    {
        return DB::select('select u.uid, u.first_name, u.last_name, (SELECT count(*) FROM users_clients_privileges ucp WHERE ucp.`users_uid` = u.uid AND ucp.`clients_uid` = ?) as canAccess from users u INNER JOIN users_privileges up ON u.uid = up.`users_uid` where active=1 and deleted=0 AND up.level = ?', [$clientUid, UserPrivilege::USER_PRIVILEGE_USER]);
    }

    /**
     * @param string $clientUid
     * @return void
     */
    public function deleteUserPermissions($clientUid)
    {
        DB::delete('delete from users_clients_privileges WHERE clients_uid = ?', [$clientUid]);
    }

    /**
     * @param string $clientUid
     * @param string $userUid
     * @return void
     */
    public function addUserPermission($clientUid, $userUid)
    {
        DB::insert('insert into users_clients_privileges (users_uid, clients_uid) values (?, ?)', [$userUid, $clientUid]);
    }

    /**
     * @param string $clientUid
     * @param string $clientName
     * @param string $clientAddress
     * @return void
     */
    public function updateInformation($clientUid, $clientName, $clientAddress)
    {
        DB::update('UPDATE clients SET name=?, address=? WHERE uid=?', [$clientName, $clientAddress, $clientUid]);
    }

    public function deleteClient($uid)
    {
        self::where('uid', $uid)->delete();
    }
}
