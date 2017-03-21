<?php

namespace App\UseCases;

use App\Models\Audit;

/**
 * Persists audit data
 */
class AuditLogger
{
    /** @var Audit */
    private $auditModel;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        $this->auditModel = new Audit;
    }

    /**
     * @param string $username
     * @param string $state
     */
    public function persist($username, $state)
    {
        $this->auditModel->username = $username;
        $this->auditModel->created_at = date("Y-m-d H:i:s");
        $this->auditModel->state = $state;
        $this->auditModel->ip_address = \Request::ip();
        $this->auditModel->save();
    }
}