<?php

namespace App\UseCases\Client;

use App\Models\Client;

class ProfileUpdater
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
     * @param $clientUid
     * @param $clientName
     * @param $clientAddress
     */
    public function update($clientUid, $clientName, $clientAddress)
    {
        $this->clientModel->updateInformation($clientUid, $clientName, $clientAddress);
    }
}
