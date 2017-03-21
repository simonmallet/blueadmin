<?php

namespace App\Listeners;

use App\Models\Audit;
use Illuminate\Auth\Events\Login;
use \Illuminate\Http\Request;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class LogSuccessfulLogin
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
     * Handle the event.
     *
     * @param  Login  $event
     * @return void
     */
    public function handle(Login $event)
    {
        $this->auditModel->username = $event->user->username;
        $this->auditModel->created_at = date("Y-m-d H:i:s");
        $this->auditModel->state = 'LOGIN_SUCCESS';
        $this->auditModel->ip_address = \Request::ip();
        $this->auditModel->save();
    }
}
