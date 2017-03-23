<?php

namespace App\Listeners;

use App\UseCases\AuditLogger;
use Illuminate\Auth\Events\Failed;

class LogFailedLogin
{
    /** @var AuditLogger */
    private $auditLogger;

    /**
     * Creates listener
     *
     * @param AuditLogger $auditLogger
     */
    public function __construct(AuditLogger $auditLogger)
    {
        $this->auditLogger = $auditLogger;
    }

    /**
     * Handle the event.
     *
     * @param  Failed  $event
     * @return void
     */
    public function handle(Failed $event)
    {
        $this->auditLogger->persist($event->credentials['username'], 'LOGIN_FAILED');
    }
}
