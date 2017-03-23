<?php

namespace Tests\Unit\App\UseCases;

use App\UserPrivilege;
use \Phake;
use Tests\TestCase;
use App\UseCases\UserManager;
use App\Models\Client as ClientModel;
use App\User as UserModel;
use Illuminate\Http\Request;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserManagerTest extends TestCase
{
    /** @var UserManager */
    private $userManager;

    /** @var ClientModel */
    private $clientModel;

    /** @var UserModel */
    private $userModel;

    /**
     *
     */
    public function setUp()
    {
        $this->clientModel = Phake::mock(ClientModel::class);
        $this->userModel = Phake::mock(UserModel::class);

        $this->userManager = new UserManager($this->clientModel, $this->userModel);
    }

    /**
     *
     */
    public function testGivenLevelUserWhenIsAdminUserThenReturnFalse()
    {
        $this->assertFalse($this->userManager->isAdminUser(UserPrivilege::USER_PRIVILEGE_USER));
    }
}
