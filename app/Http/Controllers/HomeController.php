<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $viewsVars = [];
        //error_log(print_r(Client::where('deleted', 0)->get(), true));
        if (Auth::check()) {
            $viewsVars['clients'] = Client::where('deleted', 0)->get();
        }
        error_log(print_r($viewsVars, true));
        return view('home', $viewsVars);
    }
}
