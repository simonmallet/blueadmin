<?php

namespace App\Listeners;

use App\UseCases\AuditLogger;
use Illuminate\Auth\Events\Logout;

class LogSuccessfulLogout
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
     * @param  Logout  $event
     * @return void
     */
    public function handle(Logout $event)
    {
        $this->auditLogger->persist($event->user->username, 'LOGOUT');
    }
}
