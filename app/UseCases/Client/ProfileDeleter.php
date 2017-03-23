<?php

namespace App\UseCases\Client;

use App\Models\Client;

class ProfileDeleter
{
    /** @var Client */
    private $clientModel;

    /**
     * @param Client $clientModel
     */
    public function __construct(Client $clientModel)
    {
        $this->clientModel = $clientModel;
    }

    /**
     * @param $uid
     */
    public function delete($uid)
    {
        $this->clientModel->deleteUserPermissions($uid);
        $this->clientModel->deleteClient($uid);
    }
}
