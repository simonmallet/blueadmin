<?php

namespace App\UseCases\Client;

class UserPermissionUpdater
{
    /**
     * @param $clientUid
     * @param $parameters
     * @return void
     */
    public function updatePermissions($clientUid, $parameters)
    {
        $users = [];
        foreach ($parameters as $parameterKey => $parameterValue) {
            if (preg_match("/^canAccess\-/", $parameterKey)) {
                $users[] = substr($parameterKey, 10);
            }
        }

        error_log(print_r($users, true));
    }
}
