<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UseCases\UserManager;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    /** @var UserManager */
    private $userManager;

    /**
     * HomeController constructor.
     * @param UserManager $userManager
     * @return void
     */
    public function __construct(UserManager $userManager)
    {
        $this->middleware('auth');
        $this->userManager = $userManager;
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function view($clientUid)
    {
        $viewsVars = [];
        $user = Auth::user();
        $viewsVars['client'] = $this->userManager->getClientByUserAccessLevel($clientUid, $user->uid, $user->userPrivilege->level);

        if (count($viewsVars['client']) > 0) {
            if ($this->userManager->isAdminUser($user->userPrivilege->level)) {
                $viewsVars['users'] = $this->userManager->getUsersPrivilegesForClient($clientUid);
                return view('admin.client-update', $viewsVars);
            }
            return view('user.client-update', $viewsVars);
        }
        return view('client-unknown');
    }
}
