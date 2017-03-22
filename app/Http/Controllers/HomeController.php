<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UseCases\UserManager;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $viewsVars = [];
        $user = Auth::user();
        $viewsVars['clients'] = $this->userManager->getClientsByUserAccessLevel($user->uid, $user->userPrivilege->level);

        return view('home', $viewsVars);
    }
}
