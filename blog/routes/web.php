<?php

Route::get('/admin', 'AdminController@loginAdmin');
Route::post('/admin', 'AdminController@postLoginAdmin');


Route::get('/home', function () {
    return view('home');
});
Route::get('/', function () {
    return view('welcome');
});

Route::prefix('admin')->group(function () {
    Route::prefix('categories')->group(function () {
        Route::get('export', 'ExportController@export')->name('export');
        Route::get('/export', [
            'as' => 'categories.export',
            'uses' => 'ExportController@export',
        ]);
        Route::get('/', [
            'as' => 'categories.index',
            'uses' => 'CategoryController@index',
//            'middleware' => 'can:category-list'
        ]);
        Route::get('/create', [
            'as' => 'categories.create',
            'uses' => 'CategoryController@create',
            'middleware' => 'can:category-add'
        ]);
        Route::post('/store', [
            'as' => 'categories.store',
            'uses' => 'CategoryController@store'
        ]);
        Route::get('/edit/{id}', [
            'as' => 'categories.edit',
            'uses' => 'CategoryController@edit',
            'middleware' => 'can:category-edit'
        ]);
        Route::post('/update/{id}', [
            'as' => 'categories.update',
            'uses' => 'CategoryController@update'
        ]);
        Route::get('/delete/{id}', [
            'as' => 'categories.delete',
            'uses' => 'CategoryController@delete',
            'middleware' => 'can:category-delete'
        ]);

    });
    Route::prefix('menus')->group(function () {

        Route::get('/', [
            'as' => 'menus.index',
            'uses' => 'MenuController@index',
//            'middleware' => 'can:menu-list'
        ]);
        Route::get('/create', [
            'as' => 'menus.create',
            'uses' => 'MenuController@create',
            'middleware' => 'can:menu-add'
        ]);
        Route::post('/store', [
            'as' => 'menus.store',
            'uses' => 'MenuController@store'
        ]);
        Route::get('/edit/{id}', [
            'as' => 'menus.edit',
            'uses' => 'MenuController@edit',
            'middleware' => 'can:menu-edit'
        ]);
        Route::post('/update/{id}', [
            'as' => 'menus.update',
            'uses' => 'MenuController@update'
        ]);
        Route::get('/delete/{id}', [
            'as' => 'menus.delete',
            'uses' => 'MenuController@delete',
            'middleware' => 'can:menu-delete'
        ]);

    });
    Route::prefix('product')->group(function () {

        Route::get('/', [
            'as' => 'product.index',
            'uses' => 'AdminProductController@index',
//            'middleware' => 'can:product-list'
        ]);

        Route::get('/create', [
            'as' => 'product.create',
            'uses' => 'AdminProductController@create',
//            'middleware' => 'can:product-add'
        ]);
        Route::post('/store', [
            'as' => 'product.store',
            'uses' => 'AdminProductController@store'
        ]);
        Route::get('/edit/{id}', [
            'as' => 'product.edit',
            'uses' => 'AdminProductController@edit',
//            'middleware' => 'can:product-edit'
        ]);
        Route::post('/product/{id}', [
            'as' => 'product.update',
            'uses' => 'AdminProductController@update'
        ]);
        Route::get('/delete/{id}', [
            'as' => 'product.delete',
            'uses' => 'AdminProductController@delete',
//            'middleware' => 'can:product-delete'
        ]);

    });
    Route::prefix('slider')->group(function () {

        Route::get('/', [
            'as' => 'slider.index',
            'uses' => 'SliderAdminController@index',
            'middleware' => 'can:slider-list'
        ]);

        Route::get('/create', [
            'as' => 'slider.create',
            'uses' => 'SliderAdminController@create',
            'middleware' => 'can:slider-add'
        ]);

        Route::post('/store', [
            'as' => 'slider.store',
            'uses' => 'SliderAdminController@store'
        ]);

        Route::get('/edit/{id}', [
            'as' => 'slider.edit',
            'uses' => 'SliderAdminController@edit',
            'middleware' => 'can:slider-edit'
        ]);

        Route::post('/update/{id}', [
            'as' => 'slider.update',
            'uses' => 'SliderAdminController@update'
        ]);

        Route::get('/delete/{id}', [
            'as' => 'slider.delete',
            'uses' => 'SliderAdminController@delete',
            'middleware' => 'can:slider-delete'
        ]);
    });
    Route::prefix('users')->group(function () {

        Route::get('/', [
            'as' => 'users.index',
            'uses' => 'AdminUserController@index',
            'middleware' => 'can:user-list'
        ]);

        Route::get('/create', [
            'as' => 'users.create',
            'uses' => 'AdminUserController@create',
            'middleware' => 'can:user-add'
        ]);

        Route::post('/store', [
            'as' => 'users.store',
            'uses' => 'AdminUserController@store'
        ]);

        Route::get('/edit/{id}', [
            'as' => 'users.edit',
            'uses' => 'AdminUserController@edit',
            'middleware' => 'can:user-edit'
        ]);

        Route::post('/update/{id}', [
            'as' => 'users.update',
            'uses' => 'AdminUserController@update'
        ]);

        Route::get('/delete/{id}', [
            'as' => 'users.delete',
            'uses' => 'AdminUserController@delete',
            'middleware' => 'can:user-delete'
        ]);
    });
    Route::prefix('roles')->group(function () {

        Route::get('/', [
            'as' => 'roles.index',
            'uses' => 'AdminRoleController@index',
//            'middleware' => 'can:role-list'
        ]);

        Route::get('/create', [
            'as' => 'roles.create',
            'uses' => 'AdminRoleController@create',
//            'middleware' => 'can:role-add'
        ]);

        Route::post('/store', [
            'as' => 'roles.store',
            'uses' => 'AdminRoleController@store'
        ]);

        Route::get('/edit/{id}', [
            'as' => 'roles.edit',
            'uses' => 'AdminRoleController@edit',
//            'middleware' => 'can:role-edit'
        ]);

        Route::post('/update/{id}', [
            'as' => 'roles.update',
            'uses' => 'AdminRoleController@update'
        ]);

        Route::get('/delete/{id}', [
            'as' => 'roles.delete',
            'uses' => 'AdminRoleController@delete',
//            'middleware' => 'can:role-delete'
        ]);
    });
    Route::prefix('permissions')->group(function () {

        Route::get('/create', [
            'as' => 'permissions.create',
            'uses' => 'AdminPermissionController@createPermission',
//            'middleware' => 'can:permission-add'
        ]);

        Route::post('/store', [
            'as' => 'permissions.store',
            'uses' => 'AdminPermissionController@store'
        ]);

    });
    Route::prefix('role_admin')->group(function () {

        Route::get('/', [
            'as' => 'roleAdmin.index',
            'uses' => 'RoleAdminController@index',
//            'middleware' => 'can:permission-add'
        ]);

        Route::post('/store', [
            'as' => 'roleAdmin.store',
            'uses' => 'RoleAdminController@store'
        ]);

    });

});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/forgot_password', 'ForgotPassword@forgot');
Route::post('/forgot_password', 'ForgotPassword@password');

Route::get('/search', 'PostController@search');
Route::get('/searchProduct', 'PostProductController@search');
Route::get('/searchSlider', 'PostController@searchSlider');
Route::get('/searchUser', 'PostController@searchUser');
Route::get('/searchCategoryProduct', 'PostProductController@searchCategoryProduct');

//Route::get('testEmail', 'mycontroller@testEmail');



