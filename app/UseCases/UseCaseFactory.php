<?php

namespace App\UseCases;

use App\UseCases\Client\ProfileUpdater;
//use App\UseCases\Client\ProfileCreator;
use App\UseCases\Client\UserPermissionUpdater as ClientUserPermissionUpdater;
use App\UseCases\UserManager;

class UseCaseFactory
{
    /** @var ProfileUpdater */
    private $profileUpdater;

    /** @var ProfileCreator */
    private $profileCreator;

    /** @var ClientUserPermissionUpdater */
    private $clientUserPermissionUpdater;

    /** @var UserManager */
    private $userManager;

    /**
     * @param ProfileUpdater $profileUpdater
     * @param ProfileCreator $profileCreator
     * @param ClientUserPermissionUpdater $clientUserPermissionUpdater
     * @param \App\UseCases\UserManager $userManager
     */
    public function __construct(
        ProfileUpdater $profileUpdater,
        //ProfileCreator $profileCreator, OUT OF MEMORY ON 4TH PARAM??
        ClientUserPermissionUpdater $clientUserPermissionUpdater,
        UserManager $userManager
    ) {
        $this->profileUpdater = $profileUpdater;
        //$this->profileCreator = $profileCreator;
        $this->clientUserPermissionUpdater = $clientUserPermissionUpdater;
        $this->userManager = $userManager;
    }

    /**
     * @param string $name
     * @return ProfileUpdater|ClientUserPermissionUpdater|UserManager|ProfileCreator
     */
    public function get($name)
    {
        switch ($name) {
            case 'clientProfileUpdater':
                return $this->profileUpdater;
            //case 'clientProfileCreator':
            //    return $this->profileCreator;
            case 'clientUserPermissionUpdater':
                return $this->clientUserPermissionUpdater;
            case 'userManager':
                return $this->userManager;
        }
        throw new \RuntimeException("'{$name}' factory could not be found.");
    }
}
