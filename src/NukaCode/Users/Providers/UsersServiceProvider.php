<?php namespace NukaCode\Users\Providers;

use Config;
use Illuminate\Support\ServiceProvider;

class UsersServiceProvider extends ServiceProvider
{

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../../../config/config.php', 'nukacode-user');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadConfigs();
        $this->loadMigrations();
        $this->loadViews();
    }

    /**
     * Load the configs.
     *
     * @return void
     */
    protected function loadConfigs()
    {
        $this->publishes([
            __DIR__ . '/../../../config/config.php' => config_path('nukacode-user.php'),
        ]);
    }

    /**
     * Load the migrations.
     *
     * @return void
     */
    protected function loadMigrations()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../../../database/migrations');

        if ($this->app['config']->get('nukacode-user.enable_social')) {
            $this->loadMigrationsFrom(__DIR__ . '/../../../database/social_migrations');
        }
    }

    /**
     * Register views
     *
     * @return void
     */
    protected function loadViews()
    {
        if ($this->app['config']->get('nukacode-user.load_views')) {
            $this->app['view']->addLocation(__DIR__ . '/../../../views');
        }
    }
}
