<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UseCases\UserManager;
use App\UseCases\Client\UserPermissionUpdater as ClientUserPermissionUpdater;
use App\UseCases\UseCaseFactory;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    /** @var UserManager */
    private $userManager;

    /** @var ClientUserPermissionUpdater */
    private $clientUserPermissionUpdater;

    /** @var UseCaseFactory */
    private $useCaseFactory;
    /**
     * ClientController constructor.
     * @param UserManager $userManager
     * @param ClientUserPermissionUpdater $clientUserPermissionUpdater
     */
    public function __construct(
        UserManager $userManager,
        ClientUserPermissionUpdater $clientUserPermissionUpdater,
        UseCaseFactory $useCaseFactory
    ) {
        $this->middleware('auth');
        $this->userManager = $userManager;
        $this->clientUserPermissionUpdater = $clientUserPermissionUpdater;
        $this->useCaseFactory = $useCaseFactory;
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
        $this->clientUserPermissionUpdater->updatePermissions($clientUid, $request->all());

        return redirect('/dashboard')->with(self::SESSION_SAVE_SUCCESSFUL, 'The user permissions were updated successfully.');
    }
}
