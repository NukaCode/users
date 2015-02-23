Installation
====================================

Composer
--------
``composer require nukacode/users:~1.0``

Service Providers
-----------------
Add the following service providers to ``configs/app.php``.
::

     'NukaCode\Users\UsersServiceProvider',
Configs/Migrations/Seeds
------------------------
Once that is done, you can publish the configs and migrations.

``php artisan vendor:publish``

This will create a nukacode-user.php in your config folder and add all the migrations and seeds inside your database/
 folders.

.. warning:: Make sure to make any changes you need to the config before continuing.  It will determine what roles are
generated.

.. code::

    composer dump-autoload -o
    php artisan optimize
    php artisan migrate --seed

Routes
-------
If you would like to use the included routes, add the following to your ``app/Http/routes.php`` file.

``include_once(base_path() .'/vendor/nukacode/users/src/routes.php');``

Middleware
----------
Included are two middlewares for helping with route protection.  You will need to add them to your ``app/Http/Kernel.php``
file.

.. code::

    protected $routeMiddleware = [
        // Existing middlewares
        'can'        => 'NukaCode\Users\Http\Middleware\Permission',
        'is'         => 'NukaCode\Users\Http\Middleware\Role',
    ];

Menu
-------
This step is completely optional.  But here are some common additions to the menu located in ``app/Http/Controllers/BaseController``

.. code::

    \Menu::add('leftMenu')
         ->quickLink('Home', 'home')
         ->quickLink('Memberlist', 'memberlist')
         ->end();

    if (\Auth::guest()) {
        \Menu::add('rightMenu')
             ->quickLink('Login', 'login')
             ->quickLink('Register', 'register')
             ->end();
    } else {
        \Auth::user()->updateLastActive();
        \Menu::add('rightMenu')
             ->addDropDown(\Auth::user()->username)
                ->addLink('Edit your profile')
                    ->setUrl('user/profile/')
                    ->end()
                ->addLink('Public Profile')
                    ->setUrl('user/view/'. \Auth::user()->id)
                    ->end()
                ->quickLink('Logout', 'logout')
                ->end()
             ->end();
    }