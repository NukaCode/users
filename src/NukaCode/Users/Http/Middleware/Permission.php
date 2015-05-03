<?php namespace NukaCode\Users\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\RedirectResponse;

class Permission {

    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $auth;

    /**
     * Create a new filter instance.
     *
     * @param  Guard $auth
     *
     * @return void
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user  = $this->auth->user();
        $route = $request->route();

        if ($user && $route) {
            $actions = $route->getAction();

            if (array_key_exists('permissions', $actions)) {
                $permission = $actions['permissions'];

                if (! $user->checkPermission($permission)) {
                    return new RedirectResponse(url('/'));
                }
            }
        }

        return $next($request);
    }
}
