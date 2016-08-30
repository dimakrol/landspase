<?php

Route::group(['middleware' => ['web', 'admin.auth'], 'prefix' => 'admin', 'namespace' => 'Modules\Admin\Http\Controllers'], function()
{
  // Global Patterns
  Route::pattern('id', '[0-9]+'); 
  Route::pattern('_token', '[\w\d]+'); 


	Route::get('/', ['as' => 'admin', 'uses' => 'IndexController@index']);

  // Authentication routes...
  Route::get('login', ['as' => 'admin.login', 'uses' => 'Auth\AuthController@showLoginForm']);
  Route::post('login', ['as' => 'admin.login', 'uses' => 'Auth\AuthController@login']);
  Route::get('logout', ['as' => 'admin.logout', 'uses' => 'Auth\AuthController@logout']);


  // Tools
  Route::group(['prefix' => 'tools'], function()
  {

    // Settings
    Route::group(['prefix' => 'settings'], function()
    {
      Route::get('/', ['as' => 'admin.tools.settings', 'uses' => 'Tools\SettingsController@index']);

      Route::get('/category/create', ['as' => 'admin.tools.settings.category.create', 'uses' => 'Tools\SettingsController@createCategory']);
      Route::post('/category/create', ['as' => 'admin.tools.settings.category.create', 'uses' => 'Tools\SettingsController@createCategory']);
      Route::get('/category/update/{id}', ['as' => 'admin.tools.settings.category.update', 'uses' => 'Tools\SettingsController@updateCategory']);
      Route::post('/category/update/{id}', ['as' => 'admin.tools.settings.category.update', 'uses' => 'Tools\SettingsController@updateCategory']);

      Route::get('/category/{id}', ['as' => 'admin.tools.settings.category.view', 'uses' => 'Tools\SettingsController@viewCategory']);
      Route::post('/category/{id}', ['as' => 'admin.tools.settings.category.view', 'uses' => 'Tools\SettingsController@viewCategory']);
      
      Route::get('/category/data', ['as' => 'admin.tools.settings.category.data', 'uses' => 'Tools\SettingsController@settingsCategoryData']);

      
    });
  });

});