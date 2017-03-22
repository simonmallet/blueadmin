<?php

namespace App\UseCases;

use App\Models\Client;
use App\UserPrivilege;

/**
 * Persists audit data
 */
class UserManager
{
    /** @var Client */
    private $clientModel;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        $this->clientModel = new Client;
    }

    /**
     * @param string $userUid
     * @param string $level
     * @return mixed
     */
    public function getClientsByUserAccessLevel($userUid, $level)
    {
        if ($level == UserPrivilege::USER_PRIVILEGE_ADMIN) {
            return $this->clientModel->getAllActiveClients();
        }

        return $this->clientModel->getClientsByUserId($userUid);
    }

    /**
     * @param string $username
     * @param string $state
     */
    public function persist($username, $state)
    {
        $this->clientModel->username = $username;
        $this->clientModel->created_at = date("Y-m-d H:i:s");
        $this->clientModel->state = $state;
        $this->clientModel->ip_address = \Request::ip();
        $this->clientModel->save();
    }
}