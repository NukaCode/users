<?php

Route::group(['middleware' => 'web', 'namespace' => 'NukaCode\Users\Http\Controllers'], function () {
    require('auth.php');
});
