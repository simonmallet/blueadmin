<?php

namespace App\UseCases;

use \Illuminate\Http\Request;

class LoginValidator
{
    /**
     * @param Request $request
     * @param string $usernameField
     * @return array
     */
    public function buildActiveUserQuery(Request $request, $usernameField)
    {
        return $request->only($usernameField, 'password') + ['active' => 1, 'deleted' => 0];
    }
}