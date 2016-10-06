<?php

Route::group([
    'middleware' => ['web', 'admin.auth'],
    'prefix' => 'admin',
    'namespace' => 'Modules\Admin\Http\Controllers'
], function () {
    // Global Patterns
    Route::pattern('id', '[0-9]+');
    Route::pattern('_token', '[\w\d]+');


    Route::get('/', ['as' => 'admin', 'uses' => 'IndexController@index']);

    // Authentication routes...
    Route::get('login', ['as' => 'admin.login', 'uses' => 'Auth\AuthController@showLoginForm']);
    Route::post('login', ['as' => 'admin.login', 'uses' => 'Auth\AuthController@login']);
    Route::get('logout', ['as' => 'admin.logout', 'uses' => 'Auth\AuthController@logout']);


    // Tools
    Route::group(['prefix' => 'tools'], function () {

        // Settings
        Route::group(['prefix' => 'settings'], function () {
            Route::get('/', ['as' => 'admin.tools.settings', 'uses' => 'Tools\SettingsController@index']);

            Route::get('/category/create',
                ['as' => 'admin.tools.settings.category.create', 'uses' => 'Tools\SettingsController@createCategory']);
            Route::post('/category/create',
                ['as' => 'admin.tools.settings.category.create', 'uses' => 'Tools\SettingsController@createCategory']);
            Route::get('/category/update/{id}',
                ['as' => 'admin.tools.settings.category.update', 'uses' => 'Tools\SettingsController@updateCategory']);
            Route::post('/category/update/{id}',
                ['as' => 'admin.tools.settings.category.update', 'uses' => 'Tools\SettingsController@updateCategory']);

            Route::get('/category/{id}',
                ['as' => 'admin.tools.settings.category.view', 'uses' => 'Tools\SettingsController@viewCategory']);
            Route::post('/category/{id}',
                ['as' => 'admin.tools.settings.category.view', 'uses' => 'Tools\SettingsController@viewCategory']);

            Route::get('/category/data', [
                'as' => 'admin.tools.settings.category.data',
                'uses' => 'Tools\SettingsController@settingsCategoryData'
            ]);


        });
    });
    Route::group(['prefix' => 'valuation'], function () {
        Route::group(['prefix' => 'order'], function () {
            Route::group(['prefix' => 'status', 'namespace' => 'Valuation\Order'], function () {
                Route::get('/', ['as' => 'admin.valuation.orders.status', 'uses' => 'StatusController@index']);
                Route::get('data',
                    ['as' => 'admin.valuation.orders.status.data', 'uses' => 'StatusController@orderStatusData']);
                Route::any('create/{status?}',
                    ['as' => 'admin.valuation.orders.status.create', 'uses' => 'StatusController@createOrderStatus']);
                Route::put('update/{status}',
                    ['as' => 'admin.valuation.orders.status.update', 'uses' => 'StatusController@updateOrderStatus']);
                Route::get('delete/{status}',
                    ['as' => 'admin.valuation.orders.status.delete', 'uses' => 'StatusController@deleteOrderStatus']);
            });
        });

    });

    Route::group(['prefix' => 'appraisal'], function () {
        Route::group(['prefix' => 'addendas', 'namespace' => 'Appraisal'], function () {
            Route::get('/', ['as' => 'admin.appraisal.addendas', 'uses' => 'AddendaController@index']);
            Route::get('data', ['as' => 'admin.appraisal.addendas.data', 'uses' => 'AddendaController@addendasData']);
            Route::any('create/{addenda?}',
                ['as' => 'admin.appraisal.addendas.create', 'uses' => 'AddendaController@createAddenda']);
            Route::put('update/{addenda}',
                ['as' => 'admin.appraisal.addendas.update', 'uses' => 'AddendaController@updateAddenda']);
            Route::get('delete/{addenda}',
                ['as' => 'admin.appraisal.addendas.delete', 'uses' => 'AddendaController@deleteAddenda']);
        });
        Route::group(['prefix' => 'occupancy', 'namespace' => 'Appraisal'], function () {
            Route::get('/', ['as' => 'admin.appraisal.occupancy.status', 'uses' => 'OccupancyStatusController@index']);
            Route::get('data',
                ['as' => 'admin.appraisal.occupancy.data', 'uses' => 'OccupancyStatusController@occupancyData']);
            Route::any('create/{occupancy?}',
                ['as' => 'admin.appraisal.occupancy.create', 'uses' => 'OccupancyStatusController@createOccupancy']);
            Route::put('update/{occupancy}',
                ['as' => 'admin.appraisal.occupancy.update', 'uses' => 'OccupancyStatusController@updateOccupancy']);
            Route::get('delete/{occupancy}',
                ['as' => 'admin.appraisal.occupancy.delete', 'uses' => 'OccupancyStatusController@deleteOccupancy']);
        });
    });

    Route::group(['prefix' => 'document','namespace' => 'Documents'],function(){
        Route::group(['prefix' => 'types'],function(){
            Route::get('/',['as' => 'admin.document.types','uses' => 'DocumentTypesController@index']);
            Route::get('data',
                ['as' => 'admin.document.types.data', 'uses' => 'DocumentTypesController@documentTypesData']);
            Route::any('create/{documentType?}',
                ['as' => 'admin.document.types.create', 'uses' => 'DocumentTypesController@createDocumentType']);
            Route::put('update/{documentType}',
                ['as' => 'admin.document.types.update', 'uses' => 'DocumentTypesController@updateDocumentType']);
            Route::get('delete/{documentType}',
                ['as' => 'admin.document.types.delete', 'uses' => 'DocumentTypesController@deleteDocumentType']);
        });
        Route::group(['prefix' => 'user'],function(){
            Route::group(['prefix' => 'types'],function(){
                Route::get('/',['as' => 'admin.document.user.types','uses' => 'UserDocumentTypesController@index']);
                Route::get('data',
                    ['as' => 'admin.document.user.types.data', 'uses' => 'UserDocumentTypesController@documentUserTypesData']);
                Route::any('create/{userDocumentType?}',
                    ['as' => 'admin.document.user.types.create', 'uses' => 'UserDocumentTypesController@createUserDocumentType']);
                Route::put('update/{userDocumentType}',
                    ['as' => 'admin.document.user.types.update', 'uses' => 'UserDocumentTypesController@updateUserDocumentType']);
                Route::get('delete/{userDocumentType}',
                    ['as' => 'admin.document.user.types.delete', 'uses' => 'UserDocumentTypesController@deleteUserDocumentType']);
            });
        });
        Route::group(['prefix' => 'resource'],function(){
            Route::get('/',['as' => 'admin.document.resource','uses' => 'ResourceDocumentController@index']);
            Route::get('data',
                ['as' => 'admin.document.resource.data', 'uses' => 'ResourceDocumentController@resourceData']);
            Route::any('create/{resource?}',
                ['as' => 'admin.document.resource.create', 'uses' => 'ResourceDocumentController@createResource']);
            Route::put('update/{resource}',
                ['as' => 'admin.document.resource.update', 'uses' => 'ResourceDocumentController@updateResource']);
            Route::get('delete/{resource}',
                ['as' => 'admin.document.resource.delete', 'uses' => 'ResourceDocumentController@deleteResource']);
        });
    });
});