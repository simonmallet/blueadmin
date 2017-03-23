<?php

namespace App\UseCases;

use App\UseCases\Client\ProfileUpdater;
use App\UseCases\Client\UserPermissionUpdater as ClientUserPermissionUpdater;
use App\UseCases\UserManager;

class UseCaseFactory
{
    /** @var ProfileUpdater */
    private $profileUpdater;

    /** @var ClientUserPermissionUpdater */
    private $clientUserPermissionUpdater;

    /** @var UserManager */
    private $userManager;

    /**
     * @param ProfileUpdater $profileUpdater
     * @param ClientUserPermissionUpdater $clientUserPermissionUpdater
     * @param UserManager $userManager
     */
    public function __construct(
        ProfileUpdater $profileUpdater,
        ClientUserPermissionUpdater $clientUserPermissionUpdater,
        UserManager $userManager
    ) {
        $this->profileUpdater = $profileUpdater;
        $this->clientUserPermissionUpdater = $clientUserPermissionUpdater;
        $this->userManager = $userManager;
    }

    /**
     * @param string $name
     * @return ProfileUpdater|ClientUserPermissionUpdater|UserManager
     */
    public function get($name)
    {
        switch ($name) {
            case 'clientProfileUpdater':
                return $this->profileUpdater;
            case 'clientUserPermissionUpdater':
                return $this->clientUserPermissionUpdater;
            case 'userManager':
                return $this->userManager;
        }
        throw new \RuntimeException("'{$name}' factory could not be found.");
    }
}
