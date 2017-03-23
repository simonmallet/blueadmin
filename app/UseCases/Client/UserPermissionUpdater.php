<?php

namespace App\UseCases\Client;

use App\Models\Client;

class UserPermissionUpdater
{
    /** @var Client */
    private $clientModel;

    /**
     * UserPermissionUpdater constructor.
     * @param Client $clientModel
     */
    public function __construct(Client $clientModel)
    {
        $this->clientModel = $clientModel;
    }

    /**
     * @param $clientUid
     * @param $parameters
     * @return void
     */
    public function updatePermissions($clientUid, $parameters)
    {
        $this->clientModel->deleteUserPermissions($clientUid);

        foreach ($parameters as $parameterKey => $parameterValue) {
            if (preg_match("/^canAccess\-/", $parameterKey)) {
                $userUid = substr($parameterKey, 10, 32);
                $this->clientModel->addUserPermission($clientUid, $userUid);
            }
        }
    }
}
