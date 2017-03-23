<?php

namespace App\UseCases;

use App\Models\Audit;
use Illuminate\Http\Request;

/**
 * Persists audit data
 */
class AuditLogger
{
    /** @var Audit */
    private $auditModel;

    private $request;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(Audit $audit, Request $request)
    {
        $this->auditModel = $audit;
        $this->request = $request;
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
        $this->auditModel->ip_address = $this->request->ip();
        $this->auditModel->save();
    }
}
