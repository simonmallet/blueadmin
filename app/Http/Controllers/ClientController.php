<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UseCases\UseCaseFactory;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    /** @var UseCaseFactory */
    private $useCaseFactory;

    /**
     * @param UseCaseFactory $useCaseFactory
     */
    public function __construct(UseCaseFactory $useCaseFactory)
    {
        $this->middleware('auth');
        $this->useCaseFactory = $useCaseFactory;
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function view($clientUid)
    {
        $viewsVars = [];
        $user = Auth::user();
        $viewsVars['client'] = $this->useCaseFactory->get('userManager')->getClientByUserAccessLevel($clientUid, $user->uid, $user->userPrivilege->level);

        if (count($viewsVars['client']) > 0) {
            if ($this->useCaseFactory->get('userManager')->isAdminUser($user->userPrivilege->level)) {
                $viewsVars['users'] = $this->useCaseFactory->get('userManager')->getUsersPrivilegesForClient($clientUid);
                return view('admin.client-update', $viewsVars);
            }
            return view('user.client-update', $viewsVars);
        }
        return view('client-unknown');
    }

    /**
     * Can only be accessed by Admin users for now! (business rule)
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function viewCreate()
    {
        $viewVars = [];
        $user = Auth::user();

        $viewVars['users'] = $this->useCaseFactory->get('userManager')->getActiveUsers();
        return view('admin.client-create', $viewVars);
    }

    /**
     * @param Request $request
     * @param $clientUid
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function updateClientInformation(Request $request, $clientUid)
    {
        $this->validate($request, [
            'clientName' => 'required|max:50',
        ]);

        $this->useCaseFactory->get('clientProfileUpdater')->update(
            $clientUid,
            $request->input('clientName'),
            $request->input('clientAddress')
        );

        return redirect('/dashboard')->with(self::SESSION_SAVE_SUCCESSFUL, 'The client information was updated successfully.');
    }

    /**
     * @param Request $request
     * @param string $clientUid
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function updateUserPermissions(Request $request, $clientUid)
    {
        $this->useCaseFactory->get('clientUserPermissionUpdater')->updatePermissions($clientUid, $request->all());

        return redirect('/dashboard')->with(self::SESSION_SAVE_SUCCESSFUL, 'The user permissions were updated successfully.');
    }
}
