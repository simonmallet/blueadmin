<?php

namespace Tests\Unit\App\UseCases;

use \Phake;
use Tests\TestCase;
use App\Models\Audit as AuditModel;
use App\UseCases\AuditLogger;
use Illuminate\Http\Request;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AuditLoggerTest extends TestCase
{
    use DatabaseMigrations;

    const IP_ADDRESS = '1.1.1.1';

    /** @var AuditLogger */
    private $auditLogger;

    /** @var AuditModel */
    private $auditModel;

    /**
     *
     */
    public function setUp()
    {
        $request = Phake::mock(Request::class);
        $this->auditModel = Phake::mock(AuditModel::class);

        $this->auditLogger = new AuditLogger($this->auditModel, $request);

        Phake::when($request)->ip()->thenReturn(self::IP_ADDRESS);
    }

    /**
     *
     */
    public function testWhenPersistIsCalledThenSaveMethodIsCalled()
    {
        $username = 'aaa';
        $state = 'OK';
        $return = $this->auditLogger->persist($username, $state);

        Phake::verify($this->auditModel)->save();

        $this->assertNull($return);
    }
}
