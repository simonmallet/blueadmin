<?php

namespace App\Listeners;

use App\UseCases\AuditLogger;
use Illuminate\Auth\Events\Login;

class LogSuccessfulLogin
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
     * @param  Login  $event
     * @return void
     */
    public function handle(Login $event)
    {
        $this->auditLogger->persist($event->user->username, 'LOGIN_SUCCESS');
    }
}
