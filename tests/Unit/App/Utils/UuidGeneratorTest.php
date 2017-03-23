<?php

namespace Tests\Unit\App\Utils;

use Tests\TestCase;
use App\Utils\UuidGenerator;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UuidGeneratorTest extends TestCase
{
    /** @var UuidGenerator */
    private $generator;

    /**
     *
     */
    public function setUp()
    {
        $this->generator = new UuidGenerator();
    }

    /**
     *
     */
    public function testGenerateWillReturnAUuidV4()
    {
        $uuid = $this->generator->generate();

        $this->assertSame(32, strlen($uuid));
    }
}
