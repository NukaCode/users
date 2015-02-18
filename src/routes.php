<?php

Route::group(['namespace' => 'NukaCode\Users\Controllers'], function () {
    Route::get('/login', [
        'as'   => 'login',
        'uses' => 'SessionController@getLogin'
    ]);
    Route::post('/login', [
        'as'   => 'login',
        'uses' => 'SessionController@postLogin'
    ]);
    Route::any('logout', [
        'as'   => 'logout',
        'uses' => function () {
            Auth::logout();

            if (Session::has('activeUser')) {
                Session::forget('activeUser');
            }

            return redirect()->route('home')->with('message', 'You have successfully logged out.');
        }
    ]);
    Route::get('/register', [
        'as'   => 'register',
        'uses' => 'SessionController@getRegister'
    ]);
    Route::post('/register', [
        'as'   => 'register',
        'uses' => 'SessionController@postRegister'
    ]);
    Route::get('/memberlist', [
        'as'   => 'memberlist',
        'uses' => 'UserController@memberlist'
    ]);
    /*
    |--------------------------------------------------------------------------
    | User
    |--------------------------------------------------------------------------
    */
    Route::group(['prefix' => 'user'], function () {
        Route::get('view/{id?}', [
            'as'   => 'user.view',
            'uses' => 'UserController@view'
        ]);
        Route::get('profile', [
            'as'   => 'user.profile',
            'uses' => 'UserController@profile'
        ]);
        Route::get('personal-information', [
            'as'   => 'user.personal.information',
            'uses' => 'UserController@personalInformation'
        ]);
        Route::post('personal-information', [
            'as'   => 'user.personal.information',
            'uses' => 'UserController@postPersonalInformation'
        ]);
        Route::get('change-password', [
            'as'   => 'user.password.change',
            'uses' => 'UserController@changePassword'
        ]);
        Route::post('change-password', [
            'as'   => 'user.password.change',
            'uses' => 'UserController@postChangePassword'
        ]);
        Route::get('preferences', [
            'as'   => 'user.preferences',
            'uses' => 'UserController@preferences'
        ]);
        Route::post('preferences', [
            'as'   => 'user.preferences',
            'uses' => 'UserController@postPreferences'
        ]);
    });
    /*
    |--------------------------------------------------------------------------
    | Admin
    |--------------------------------------------------------------------------
    */
    Route::group(['namespace' => 'Admin', 'prefix' => 'admin'], function () {
        /*
        |--------------------------------------------------------------------------
        | User Admin
        |--------------------------------------------------------------------------
        */
        Route::group(['prefix' => 'users'], function () {
            /*
            |--------------------------------------------------------------------------
            | Roles
            |--------------------------------------------------------------------------
            */
            Route::group(['prefix' => 'role'], function () {
                Route::get('/edit/{id}', [
                    'as'   => 'admin.user.role.edit',
                    'uses' => 'RoleController@getEdit'
                ]);
                Route::post('/edit/{id}', [
                    'as'   => 'admin.user.role.edit',
                    'uses' => 'RoleController@postEdit'
                ]);
                Route::get('/create', [
                    'as'   => 'admin.user.role.create',
                    'uses' => 'RoleController@getCreate'
                ]);
                Route::post('/create', [
                    'as'   => 'admin.user.role.create',
                    'uses' => 'RoleController@postCreate'
                ]);
                Route::get('/delete/{id}', [
                    'as'   => 'admin.user.role.delete',
                    'uses' => 'RoleController@getDelete'
                ]);
                Route::get('/', [
                    'as'   => 'admin.user.role.index',
                    'uses' => 'RoleController@index'
                ]);
            });
            /*
            |--------------------------------------------------------------------------
            | Actions
            |--------------------------------------------------------------------------
            */
            Route::group(['prefix' => 'action'], function () {
                Route::get('/edit/{id}', [
                    'as'   => 'admin.user.action.edit',
                    'uses' => 'ActionController@getEdit'
                ]);
                Route::post('/edit/{id}', [
                    'as'   => 'admin.user.action.edit',
                    'uses' => 'ActionController@postEdit'
                ]);
                Route::get('/create', [
                    'as'   => 'admin.user.action.create',
                    'uses' => 'ActionController@getCreate'
                ]);
                Route::post('/create', [
                    'as'   => 'admin.user.action.create',
                    'uses' => 'ActionController@postCreate'
                ]);
                Route::get('/delete/{id}', [
                    'as'   => 'admin.user.action.delete',
                    'uses' => 'ActionController@getDelete'
                ]);
                Route::get('/', [
                    'as'   => 'admin.user.action.index',
                    'uses' => 'ActionController@index'
                ]);
            });
            /*
            |--------------------------------------------------------------------------
            | Preferences
            |--------------------------------------------------------------------------
            */
            Route::group(['prefix' => 'preference'], function () {
                Route::get('/edit/{id}', [
                    'as'   => 'admin.user.preference.edit',
                    'uses' => 'PreferenceController@getEdit'
                ]);
                Route::post('/edit/{id}', [
                    'as'   => 'admin.user.preference.edit',
                    'uses' => 'PreferenceController@postEdit'
                ]);
                Route::get('/create', [
                    'as'   => 'admin.user.preference.create',
                    'uses' => 'PreferenceController@getCreate'
                ]);
                Route::post('/create', [
                    'as'   => 'admin.user.preference.create',
                    'uses' => 'PreferenceController@postCreate'
                ]);
                Route::get('/delete/{id}', [
                    'as'   => 'admin.user.preference.delete',
                    'uses' => 'PreferenceController@getDelete'
                ]);
                Route::get('/', [
                    'as'   => 'admin.user.preference.index',
                    'uses' => 'PreferenceController@index'
                ]);
            });
            /*
            |--------------------------------------------------------------------------
            | Users
            |--------------------------------------------------------------------------
            */
            Route::group(['prefix' => 'user'], function () {
                Route::get('/edit/{id}', [
                    'as'   => 'admin.user.user.edit',
                    'uses' => 'UserController@getEdit'
                ]);
                Route::post('/edit/{id}', [
                    'as'   => 'admin.user.user.edit',
                    'uses' => 'UserController@postEdit'
                ]);
                Route::get('/create', [
                    'as'   => 'admin.user.user.create',
                    'uses' => 'UserController@getCreate'
                ]);
                Route::post('/create', [
                    'as'   => 'admin.user.user.create',
                    'uses' => 'UserController@postCreate'
                ]);
                Route::get('/delete/{id}', [
                    'as'   => 'admin.user.user.delete',
                    'uses' => 'UserController@getDelete'
                ]);
                Route::get('/', [
                    'as'   => 'admin.user.user.index',
                    'uses' => 'UserController@index'
                ]);
            });
        });
    });
});