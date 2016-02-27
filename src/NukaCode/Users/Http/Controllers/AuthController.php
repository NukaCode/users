<?php

namespace NukaCode\Users\Http\Controllers;

use App\Http\Controllers\BaseController;
use App\Models\User;
use NukaCode\Users\Events\UserLoggedIn;
use NukaCode\Users\Events\UserRegistered;
use NukaCode\Users\Http\Requests\Login;
use NukaCode\Users\Http\Requests\Registration;

class AuthController extends BaseController
{
    /**
     * Display the login form.
     */
    public function login()
    {
        //
    }

    /**
     * Log the user in
     *
     * @param Login $request
     *
     * @return mixed
     */
    public function handleLogin(Login $request)
    {
        // Set the auth data
        $userData = [
            'username' => $request->get('username'),
            'password' => $request->get('password'),
        ];

        // Log in successful
        if (auth()->attempt($userData, $request->get('remember', false))) {
            event(new UserLoggedIn(auth()->user()));

            return redirect()
                ->intended(route('home'))
                ->with('message', 'You have been logged in.');
        }

        // Login failed
        return redirect(route('auth.login'))
            ->with('errors', ['Your username or password was incorrect.']);
    }

    /**
     * Display the registration form.
     */
    public function register()
    {
        //
    }

    /**
     * Register a user
     *
     * @param Registration $request
     *
     * @return mixed
     */
    public function handleRegister(Registration $request)
    {
        try {
            $user = User::create($request->all());
            $user->assignRole(config('nukacode-user.default'));

            auth()->login($user);

            event(new UserRegistered(auth()->user()));
        } catch (\Exception $exception) {
            return redirect('auth.register')
                ->with('errors', $exception->getMessage());
        }

        return redirect(route('home'))
            ->with('message', 'Your account has been created.');
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
