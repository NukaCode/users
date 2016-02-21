<?php namespace NukaCode\Users;

use Config;
use Illuminate\Foundation\AliasLoader;
use NukaCode\Core\BaseServiceProvider;

class UsersServiceProvider extends BaseServiceProvider {

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    const NAME = 'users';

    const VERSION = '1.0.3';

    const DOCS = 'front-end-bootstrap';

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->shareWithApp();
        $this->setPublishGroups();
        $this->registerViews();
    }

    /**
     * Share the package with application
     *
     * @return void
     */
    protected function shareWithApp()
    {
        $this->app['users'] = $this->app->share(function () {
            return true;
        });
    }

    /**
     * Set up the config values
     *
     * @return void
     */
    protected function setPublishGroups()
    {
        $this->publishes(
            [
                __DIR__ . '/../../config/config.php' => config_path('nukacode-user.php')
            ], 'config'
        );
        //@todo - Add config in nukacode/configs to handle setting this in the RouteProvider
        $this->publishes(
            [
                __DIR__ . '/../auth.php' => app_path('Http/Routes/Users/auth.php')
            ], 'routes'
        );

        $databaseFiles = $this->getDatabaseFiles('vendor/nukacode/users/src/database');

        $this->publishes($databaseFiles, 'database');
    }

    /**
     * Register views
     *
     * @return void
     */
    protected function registerViews()
    {
        if ($this->app['config']->has('nukacode-frontend.type')) {
            $this->app['view']->addLocation(__DIR__ . '/../../views/' . $this->app['config']->get('nukacode-frontend.type'));
        }
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['users'];
    }
}
