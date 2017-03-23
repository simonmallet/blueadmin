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
    const CLIENT_UID = 'adsad';
    const USER_UID = 'aaaaaaa';

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

    /**
     *
     */
    public function testGivenLevelAdminWhenIsAdminUserThenReturnTrue()
    {
        $this->assertTrue($this->userManager->isAdminUser(UserPrivilege::USER_PRIVILEGE_ADMIN));
    }

    /**
     *
     */
    public function testWhenGetUsersPrivilegesForClientThenModelDataIsReturned()
    {
        $data = ['abc'];

        Phake::when($this->clientModel)->getUsersPrivilegesForClient(self::CLIENT_UID)->thenReturn($data);

        $result = $this->userManager->getUsersPrivilegesForClient(self::CLIENT_UID);

        $this->assertSame($data, $result);
    }

    /**
     *
     */
    public function testGivenAnAdminUserWhenGetClientByUserAccessLevelThenReturnContent()
    {
        $data = ['abc'];

        Phake::when($this->clientModel)->getClientById(self::CLIENT_UID)->thenReturn($data);

        $result = $this->userManager->getClientByUserAccessLevel(self::CLIENT_UID, self::USER_UID, UserPrivilege::USER_PRIVILEGE_ADMIN);

        $this->assertSame($data, $result);
    }

    /**
     *
     */
    public function testGivenUserAndAccessWhenGetClientByUserAccessLevelThenReturnContent()
    {
        $data = ['abc'];

        Phake::when($this->clientModel)->canUserAccessClient(self::USER_UID, self::CLIENT_UID)->thenReturn(true);
        Phake::when($this->clientModel)->getClientById(self::CLIENT_UID)->thenReturn($data);

        $result = $this->userManager->getClientByUserAccessLevel(self::CLIENT_UID, self::USER_UID, UserPrivilege::USER_PRIVILEGE_USER);

        $this->assertSame($data, $result);
    }

    /**
     *
     */
    public function testGivenUserAndNoAccessWhenGetClientByUserAccessLevelThenReturnNull()
    {
        Phake::when($this->clientModel)->canUserAccessClient(self::USER_UID, self::CLIENT_UID)->thenReturn(false);

        $result = $this->userManager->getClientByUserAccessLevel(self::CLIENT_UID, self::USER_UID, UserPrivilege::USER_PRIVILEGE_USER);

        $this->assertNull($result);
    }

    /**
     *
     */
    public function testGetActiveUsersCallsTheProperModel()
    {
        $data = ['sadas'];

        Phake::when($this->userModel)->getActiveUsers()->thenReturn($data);

        $result = $this->userManager->getActiveUsers();

        $this->assertSame($data, $result);
        Phake::verify($this->userModel)->getActiveUsers();
    }

    /**
     *
     */
    public function testGivenAdminUserWhenGetClientsByUserAccessLevelThenReturnAllActiveClients()
    {
        $data = ['asdsadsa'];

        Phake::when($this->clientModel)->getAllActiveClients()->thenReturn($data);
        $result = $this->userManager->getClientsByUserAccessLevel(self::USER_UID, UserPrivilege::USER_PRIVILEGE_ADMIN);

        $this->assertSame($data, $result);
        Phake::verify($this->clientModel)->getAllActiveClients();
        Phake::verify($this->clientModel, Phake::never())->getClientsByUserId(self::USER_UID);
    }

    /**
     *
     */
    public function testGivenUserWhenGetClientsByUserAccessLevelThenReturnClientsForUser()
    {
        $data = ['asdsadsa'];

        Phake::when($this->clientModel)->getClientsByUserId(self::USER_UID)->thenReturn($data);
        $result = $this->userManager->getClientsByUserAccessLevel(self::USER_UID, UserPrivilege::USER_PRIVILEGE_USER);

        $this->assertSame($data, $result);
        Phake::verify($this->clientModel)->getClientsByUserId(self::USER_UID);
        Phake::verify($this->clientModel, Phake::never())->getAllActiveClients();
    }
}
