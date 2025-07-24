<?php

use Illuminate\Support\Facades\Route;

Route::group(
    [
        "prefix" => "admin",
        "as" => "admin.",
        // "middleware" => "auth"
    ],
    function () {
        // add Controller 
        // add roles manager route
        Route::group([
            'prefix' => 'users/manage',
            'as' => 'users.manage'
        ], function () {
            Route::get('/{id}', [\App\Http\Controllers\UserController::class, 'showManageForm']);
            Route::post('/{id}', [\App\Http\Controllers\UserController::class, 'manage'])->name('.update');
        });
        Route::get('users/data', [\App\Http\Controllers\UserController::class, 'dataTable']);
        Route::resource('users', \App\Http\Controllers\UserController::class, ['except' => 'show']);
    }
);