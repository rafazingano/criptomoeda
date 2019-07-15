<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])
    ->namespace('Admin')
    ->prefix('admin')
    ->group(function () {

        Route::any('historic-search', 'BalanceController@searchHistoric')->name('historic.search');
        Route::get('historic', 'BalanceController@historic')->name('admin.historic');

        Route::post('transfer', 'BalanceController@transferStore')->name('transfer.store');
        Route::post('confirm-transfer', 'BalanceController@confirmTransfer')->name('confirm.transfer');
        Route::get('transfer', 'BalanceController@transfer')->name('balance.transfer');

        Route::post('withdraw', 'BalanceController@withdrawStore')->name('withdraw.store');
        Route::get('withdraw', 'BalanceController@withdraw')->name('balance.withdraw');

        Route::post('deposit', 'BalanceController@depositStore')->name('deposit.store');
        Route::get('deposit', 'BalanceController@deposit')->name('balance.deposit');
        Route::get('balance', 'BalanceController@index')->name('admin.balance');

        Route::get('/', 'AdminController@index')->name('admin.home'); # ADMIN

});

Route::middleware(['auth'])
    ->prefix('admin')
    ->group(function () {

        Route::resource('users','UserController');
        Route::get('roles',['as'=>'roles.index','uses'=>'RoleController@index','middleware' => ['permission:role-list|role-create|role-edit|role-delete']]);
        Route::get('roles/create',['as'=>'roles.create','uses'=>'RoleController@create','middleware' => ['permission:role-create']]);
        Route::post('roles/create',['as'=>'roles.store','uses'=>'RoleController@store','middleware' => ['permission:role-create']]);
        Route::get('roles/{id}',['as'=>'roles.show','uses'=>'RoleController@show']);
        Route::get('roles/{id}/edit',['as'=>'roles.edit','uses'=>'RoleController@edit','middleware' => ['permission:role-edit']]);
        Route::patch('roles/{id}',['as'=>'roles.update','uses'=>'RoleController@update','middleware' => ['permission:role-edit']]);
        Route::delete('roles/{id}',['as'=>'roles.destroy','uses'=>'RoleController@destroy','middleware' => ['permission:role-delete']]);


        Route::get('itemCRUD2',['as'=>'itemCRUD2.index','uses'=>'ItemCRUD2Controller@index','middleware' => ['permission:item-list|item-create|item-edit|item-delete']]);
        Route::get('itemCRUD2/create',['as'=>'itemCRUD2.create','uses'=>'ItemCRUD2Controller@create','middleware' => ['permission:item-create']]);
        Route::post('itemCRUD2/create',['as'=>'itemCRUD2.store','uses'=>'ItemCRUD2Controller@store','middleware' => ['permission:item-create']]);
        Route::get('itemCRUD2/{id}',['as'=>'itemCRUD2.show','uses'=>'ItemCRUD2Controller@show']);
        Route::get('itemCRUD2/{id}/edit',['as'=>'itemCRUD2.edit','uses'=>'ItemCRUD2Controller@edit','middleware' => ['permission:item-edit']]);
        Route::patch('itemCRUD2/{id}',['as'=>'itemCRUD2.update','uses'=>'ItemCRUD2Controller@update','middleware' => ['permission:item-edit']]);
        Route::delete('itemCRUD2/{id}',['as'=>'itemCRUD2.destroy','uses'=>'ItemCRUD2Controller@destroy','middleware' => ['permission:item-delete']]);

});

Route::post('atualizar-perfil', 'Admin\UserController@profileUpdate')
    ->name('profile.update')
    ->middleware('auth');
Route::get('meu-perfil', 'Admin\UserController@profile')
    ->name('profile')
    ->middleware('auth');

//$this->get('/', 'Site\SiteController@index')->name('home'); # HOME

Route::get('/', 'Auth\LoginController@showLoginForm')->name('home');

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
