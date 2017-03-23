<?php

namespace App\UseCases;

use App\Models\Client;
use App\User;
use App\UserPrivilege;

/**
 * Persists audit data
 */
class UserManager
{
    /** @var Client */
    private $clientModel;

    /** @var User */
    private $userModel;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(Client $clientModel, User $userModel)
    {
        $this->clientModel = $clientModel;
        $this->userModel = $userModel;
    }

    /**
     * @param string $userUid
     * @param string $level
     * @return mixed
     */
    public function getClientsByUserAccessLevel($userUid, $level)
    {
        if ($this->isAdminUser($level)) {
            return $this->clientModel->getAllActiveClients();
        }

        return $this->clientModel->getClientsByUserId($userUid);
    }

    /**
     * @return array
     */
    public function getActiveUsers()
    {
        return $this->userModel->getActiveUsers();
    }

    /**
     * @param string $clientUid
     * @param string $userUid
     * @param string $level
     * @return mixed
     */
    public function getClientByUserAccessLevel($clientUid, $userUid, $level)
    {
        if ($this->isAdminUser($level) || $this->clientModel->canUserAccessClient($userUid, $clientUid)) {
            return $this->clientModel->getClientById($clientUid);
        }
    }

    /**
     * @param string $clientUid
     * @return mixed
     */
    public function getUsersPrivilegesForClient($clientUid)
    {
        return $this->clientModel->getUsersPrivilegesForClient($clientUid);
    }

    /**
     * @param string $username
     * @param string $state
     */
    public function persist($username, $state)
    {
        // @todo
        $this->clientModel->username = $username;
        $this->clientModel->created_at = date("Y-m-d H:i:s");
        $this->clientModel->state = $state;
        $this->clientModel->ip_address = \Request::ip();
        $this->clientModel->save();
    }

    /**
     * @param string $level
     * @return bool
     */
    public function isAdminUser($level)
    {
        return ($level == UserPrivilege::USER_PRIVILEGE_ADMIN);
    }
}