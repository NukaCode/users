<?php namespace NukaCode\Users\Controllers;

use NukaCode\Users\Http\Requests\User\Avatar;
use NukaCode\Users\Http\Requests\User\Password;
use NukaCode\Users\Http\Requests\User\Preference;
use NukaCode\Users\Http\Requests\User\Profile;
use NukaCode\Users\Http\Requests\User\UploadAvatar;
use NukaCode\Core\Ajax\Ajax;
use NukaCode\Core\View\Helpers\LeftTab;
use NukaCode\Core\View\ViewBuilder;

class UserController extends \BaseController {

    private $user;

    /**
     * @var \NukaCode\Core\View\Helpers\LeftTab
     */
    private $leftTab;

    /**
     * @var \NukaCode\Core\Ajax\Ajax
     */
    private $ajax;

    /**
     * @var \NukaCode\Core\View\ViewBuilder
     */
    private $coreView;

    /**
     * @param \User       $user
     * @param LeftTab     $leftTab
     * @param Ajax        $ajax
     * @param ViewBuilder $coreView
     */
    public function __construct(\User $user, LeftTab $leftTab, Ajax $ajax, ViewBuilder $coreView)
    {
        parent::__construct();

        $this->user     = $user;
        $this->leftTab  = $leftTab;
        $this->ajax     = $ajax;
        $this->coreView = $coreView;
    }

    /**
     * Get a list of all members on the site
     */
    public function memberlist()
    {
        // Get all users
        $users = $this->user->orderByNameAsc()->get();

        $this->setViewData(compact('users'));
    }

    /**
     * View the active user's account details
     */
    public function account()
    {
        // Use left tab service to display navigation options
        $this->leftTab
            ->addPanel()
            ->setTitle($this->activeUser->username)
            ->setBasePath('user')
            ->addTab('Profile', 'profile')
            ->addTab('Preferences', 'preferences')
            ->addTab('Change Password', 'change-password')
            ->addTab('Upload Avatar', 'upload-avatar')
            ->buildPanel()
            ->make();
    }

    /**
     * View details on a specific user
     *
     * @param null $userId
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function view($userId = null)
    {
        // A user id is required to view
        if ($userId == null) {
            return redirect()->home();
        }

        // Get the requested user
        $user = $this->user->find($userId);

        $this->setViewData(compact('user'));
    }

    /**
     * Update a user's profile details
     *
     * @param Profile $request
     *
     * @return \Response
     */
    public function postPersonalInformation(Profile $request)
    {
        // Update the user
        \Auth::user()->update($request->except('_token'));

        return redirect()->to(route('user.profile'))->with('message', 'Your information has been updated.');
    }

    /**
     * Update a user's password
     *
     * @param Password $request
     *
     * @return \Response
     */
    public function postChangePassword(Password $request)
    {
        // Update the user
        $this->user->updatePassword($request->only('password', 'new_password', 'new_password_confirmation'));

        return redirect()->to(route('user.profile') . '#change-password')->with('message', 'Your password has been updated.');
    }

    /**
     * Get all visible preferences
     */
    public function preferences()
    {
        // Get all preferences
        $preferences = $this->user->getVisiblePreferences();

        $this->setViewData(compact('preferences'));
    }

    /**
     * Update a user's preferences
     *
     * @param Preference $request
     *
     * @return mixed
     */
    public function postPreferences(Preference $request)
    {
        // Loop through the provided preferences and update them
        foreach ($request->get('preference') as $keyName => $value) {
            \Auth::user()->updatePreferenceByKeyName($keyName, $value);
        }

        return redirect()->to(route('user.profile') . '#preferences')->with('message', 'Your preferences has been updated.');
    }
}