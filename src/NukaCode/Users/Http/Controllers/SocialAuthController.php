<?php

namespace NukaCode\Users\Http\Controllers;

use App\Http\Controllers\BaseController;
use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class SocialAuthController extends BaseController
{
    protected $driver;

    protected $scopes;

    protected $extras;

    public function __construct()
    {
        parent::__construct();

        extract(config('nukacode-user.social'));

        $this->driver = $driver;
        $this->scopes = $scopes;
        $this->extras = $extras;
    }

    /**
     * Redirect the user to the social providers auth page.
     *
     * @return mixed
     */
    public function login()
    {
        if (is_null($this->driver)) {
            throw new \InvalidArgumentException('You must set a social driver to use the social authenticating features.');
        }

        return Socialite::driver($this->driver)
                        ->scopes($this->scopes)
                        ->with($this->extras)
                        ->redirect();
    }

    /**
     * Use the returned user to register (if needed) and login.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return mixed
     */
    public function callback(Request $request)
    {
        $socialUser = Socialite::driver($this->driver)->user();
        $user       = User::where('email', $socialUser->getEmail())->first();

        if (is_null($user)) {
            $user = $this->register($socialUser);
        }

        auth()->login($user, $request->get('remember', false));

        return redirect()
            ->intended('home')
            ->with('message', 'You have been logged in.');
    }

    /**
     * Create a new user from a social user.
     *
     * @param $socialUser
     *
     * @return mixed
     */
    private function register($socialUser)
    {
        $names = explode(' ', $socialUser->getName());

        $userDetails = [
            'username'      => $socialUser->getNickname(),
            'email'         => $socialUser->getEmail(),
            'first_name'    => $names[0],
            'last_name'     => $names[1],
            'display_name'  => $socialUser->getNickname(),
            'social_id'     => $socialUser->getId(),
            'social_avatar' => $socialUser->getAvatar(),
        ];

        $user = User::create($userDetails);
        $user->assignRole(config('nukacode-user.default'));

        return $user;
    }

    /**
     * Log the user out.
     *
     * @return mixed
     */
    public function logout()
    {
        auth()->logout();

        return redirect(route('home'))
            ->with('message', 'You have been logged out.');
    }
}