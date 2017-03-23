<?php

namespace App\UseCases;

use App\UseCases\Client\ProfileUpdater;

class UseCaseFactory
{
    private $profileUpdater;

    public function __construct(ProfileUpdater $profileUpdater)
    {
        $this->profileUpdater = $profileUpdater;
    }

    public function get($name)
    {
        switch ($name) {
            case 'clientProfileUpdater':
                return $this->profileUpdater;
        }
    }
}