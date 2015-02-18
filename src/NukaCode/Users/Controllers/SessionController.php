<?php namespace NukaCode\Users\Controllers;

use Illuminate\Auth\AuthManager;
use NukaCode\Users\Http\Requests\User\Login;
use NukaCode\Users\Http\Requests\User\Registration;
use NukaCode\Users\Services\RegistrationService;

class SessionController extends \BaseController {

	/**
	 * Log the user in
	 *
	 * @param AuthManager $auth
	 * @param Login       $request
	 *
	 * @return mixed
	 */
	public function postLogin(AuthManager $auth, Login $request)
	{
		// Set the auth data
		$userData = [
			'username' => $request->get('username'),
			'password' => $request->get('password')
		];

		// Log in successful
		if ($auth->attempt($userData)) {
			return redirect()->intended();
		}

		// Login failed
		return redirect()->route('login')->with('errors', ['Your username or password was incorrect.']);
	}

	/**
	 * Register a user
	 *
	 * @param Registration $request
	 *
	 * @return mixed
	 */
	public function postRegister(Registration $request, RegistrationService $registrationService)
	{
		// Run the registration command
		$result = $registrationService->register($request->only('username', 'password', 'email'));

		// Redirect on failure
		if ($result !== true) {
			return redirect()->route('register', [], $result, 'errors');
		}

		return redirect()->route('home');
	}

	/**
	 * Collapse or expand a panel and persist the state
	 *
	 * @param string $target
	 */
	public function collapse($target)
	{
		// Define the session name
		$sessionName = 'COLLAPSE_' . $target;

		if ($this->session->get($sessionName)) {
			// If it is currently true, set it to false so it collapses
			$this->session->put($sessionName, false);

			// Update the user preference
			$preference = $this->activeUser->getPreferenceByKeyName($sessionName);
			$this->activeUser->setPreferenceValue($preference->id, false);
		} else {
			// If it is currently false, set it to true so it expands
			$this->session->put($sessionName, true);

			// Update the user preference
			$preference = $this->activeUser->getPreferenceByKeyName($sessionName);
			$this->activeUser->setPreferenceValue($preference->id, true);
		}
	}

} 