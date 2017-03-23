<?php

namespace App\UseCases\Client;

use App\Models\Client;
use App\UseCases\UseCaseFactory;
use App\Utils\UuidGenerator;

class ProfileCreator
{
    /** @var Client */
    private $clientModel;

    /** @var UseCaseFactory */
    private $useCaseFactory;

    /**
     * @param Client $clientModel
     */
    public function __construct(Client $clientModel, UseCaseFactory $useCaseFactory)
    {
        $this->clientModel = $clientModel;
        $this->useCaseFactory = $useCaseFactory;
    }

    /**
     * @param $parameters
     */
    public function create($parameters)
    {
        $uid = UuidGenerator::generate();

        $this->persistClient($uid, $parameters['clientName'], $parameters['clientAddress']);
        $this->useCaseFactory->get('clientUserPermissionUpdater')->updatePermissions($uid, $parameters);
    }

    /**
     * @param $uid
     * @param $name
     * @param $address
     */
    private function persistClient($uid, $name, $address)
    {
        $this->clientModel->uid = $uid;
        $this->clientModel->name = $name;
        $this->clientModel->address = $address;
        $this->clientModel->save();
    }
}
