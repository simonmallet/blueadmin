<?php

namespace Tests\Unit\App\UseCases;

use \Phake;
use Tests\TestCase;
use App\UseCases\LoginValidator;
use Illuminate\Http\Request;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class LoginValidatorTest extends TestCase
{
    /** @var LoginValidator */
    private $loginValidator;

    /**
     *
     */
    public function setUp()
    {
        $this->loginValidator = new LoginValidator();
    }

    /**
     *
     */
    public function testWhenBuildQueryIsCalledThenActiveIsOnAndDeletedIsOffForAllRequests()
    {
        $usernameField = 'username';
        $usernameValue = 'smith';
        $pwdField = 'password';
        $pwdValue = 'sdasd';
        $request = Phake::mock(Request::class);

        $requestKeys = [$usernameField => $usernameValue, $pwdField => $pwdValue];
        $expectedReturn = $requestKeys + ['active' => 1, 'deleted' => 0];

        Phake::when($request)->only($usernameField, 'password')->thenReturn($requestKeys);

        $finalQuery = $this->loginValidator->buildActiveUserQuery($request, $usernameField);

        $this->assertSame($expectedReturn, $finalQuery);
    }
}
