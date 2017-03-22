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

        return view('client', $viewsVars);
    }
}
