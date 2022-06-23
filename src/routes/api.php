<?php

Route::group(['prefix' => 'api'], function ($router) {
    /**
     * CMS Web Content and BLog Route
     */
    Route::group(['prefix' => 'web'], function () {

        Route::group(['prefix' => 'pages'], function () {

            Route::group(['prefix' => 'images'], function () {
                Route::get('/list', 'Cms\App\Controllers\Pages\ImagesController@all');
            });

            Route::post('/create/{target}', 'Cms\App\Controllers\Pages\TemplateController@create');
            Route::post('/update/{target}', 'Cms\App\Controllers\Pages\TemplateController@update');
            Route::get('/fetch/{target}', 'Cms\App\Controllers\Pages\TemplateController@fetch');
            Route::post('/search/{target}', 'Cms\App\Controllers\Pages\TemplateController@find');
            Route::get('/delete/{target}/{identifier}', 'Cms\App\Controllers\Pages\TemplateController@delete');
        });

        Route::group(['prefix' => 'blogs'], function () {

            Route::post('/create', 'Cms\App\Controllers\Pages\BlogsController@store');
            Route::post('/update', 'Cms\App\Controllers\Pages\BlogsController@update');
            Route::get('/fetch', 'Cms\App\Controllers\Pages\BlogsController@all');
            Route::get('/get/{identifier}', 'Cms\App\Controllers\Pages\BlogsController@get');
            Route::get('/delete/{identifier}', 'Cms\App\Controllers\Pages\BlogsController@delete');
        });
    });
});
