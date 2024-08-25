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
//home
Route::get('/', 'IndexController@index')->name('index.index');
Route::get('/filter', 'IndexController@filter')->name('index.filter');

//sewa
Route::get('/rent/{id}', 'RentController@index')->name('rent.index');
Route::post('/rent/{id}/store', 'RentController@store')->name('rent.store');

//contact
Route::get('/contact', 'IndexController@index')->name('index.contact');
Route::post('/contact/store', 'IndexController@store')->name('index.store');

//admin
Route::get('/admin', 'LoginController@showLoginForm')->name('login');

//login
Route::post('login', 'LoginController@login')->name('proceed-login');

//payment
Route::post('/payment', 'PaymentController@createPayment')->name('payment.create');
Route::get('/payment/callback', 'PaymentController@handleCallback')->name('payment.callback');
Route::post('/payment/store', 'PaymentController@store')->name('payment.store');

Route::middleware(['auth'])->group(function () {

    //dashboard
    Route::get('/dashboard', 'LoginController@dashboard')->name('dashboard');

    //logout
    Route::get('logout', 'LoginController@logout')->name('logout');


    //user
    Route::get('/admin/user','UserController@index')->name('user.index');
    Route::get('/admin/user/create','UserController@create')->name('user.create');
    Route::get('/admin/user/source','UserController@source')->name('user.source');
    Route::get('/admin/user/{id}/edit','UserController@edit')->name('user.edit');
    Route::get('/admin/user/{id}/show','UserController@show')->name('user.show');
    Route::get('/admin/user/{id}/destroy','UserController@destroy')->name('user.destroy');
    Route::post('/admin/user/store','UserController@store')->name('user.store');
    Route::post('/admin/user/{id}/update','UserController@update')->name('user.update');
    Route::get('/admin/user/change','UserController@change')->name('user.change');
    Route::post('/admin/user/updatePassword','UserController@updatePassword')->name('user.updatePassword');

    //role
    Route::get('/admin/role','RoleController@index')->name('role.index');
    Route::get('/admin/role/create','RoleController@create')->name('role.create');
    Route::get('/admin/role/source','RoleController@source')->name('role.source');
    Route::get('/admin/role/{id}/edit','RoleController@edit')->name('role.edit');
    Route::get('/admin/role/{id}/show','RoleController@show')->name('role.show');
    Route::get('/admin/role/{id}/destroy','RoleController@destroy')->name('role.destroy');
    Route::post('/admin/role/store','RoleController@store')->name('role.store');
    Route::post('/admin/role/{id}/update','RoleController@update')->name('role.update');



    //costume
    Route::get('/admin/costume','CostumeController@index')->name('costume.index');
    Route::get('/admin/costume/create','CostumeController@create')->name('costume.create');
    Route::get('/admin/costume/source','CostumeController@source')->name('costume.source');
    Route::get('/admin/costume/{id}/edit','CostumeController@edit')->name('costume.edit');
    Route::get('/admin/costume/{id}/show','CostumeController@show')->name('costume.show');
    Route::get('/admin/costume/{id}/destroy','CostumeController@destroy')->name('costume.destroy');
    Route::post('/admin/costume/store','CostumeController@store')->name('costume.store');
    Route::post('/admin/costume/{id}/update','CostumeController@update')->name('costume.update');
    Route::get('/admin/costume/{id}/getImage','CostumeController@getImage')->name('costume.getImage');
    Route::get('/admin/costume/{id}/destroyImage','CostumeController@destroyImage')->name('costume.destroyImage');

    //customer
    Route::get('/admin/customer','CustomerController@index')->name('customer.index');
    Route::get('/admin/customer/create','CustomerController@create')->name('customer.create');
    Route::get('/admin/customer/source','CustomerController@source')->name('customer.source');
    Route::get('/admin/customer/{id}/edit','CustomerController@edit')->name('customer.edit');
    Route::get('/admin/customer/{id}/show','CustomerController@show')->name('customer.show');
    Route::get('/admin/customer/{id}/destroy','CustomerController@destroy')->name('customer.destroy');
    Route::get('/admin/customer/getCustomer','CustomerController@getCustomer')->name('customer.getCustomer');
    Route::post('/admin/customer/store','CustomerController@store')->name('customer.store');
    Route::post('/admin/customer/{id}/update','CustomerController@update')->name('customer.update');
    Route::get('/admin/customer/{id}/getImage','CustomerController@getImage')->name('customer.getImage');
    Route::get('/admin/customer/{id}/destroyImage','CustomerController@destroyImage')->name('customer.destroyImage');

    //manufacture
    Route::get('/admin/manufacture','ManufactureController@index')->name('manufacture.index');
    Route::get('/admin/manufacture/create','ManufactureController@create')->name('manufacture.create');
    Route::get('/admin/manufacture/source','ManufactureController@source')->name('manufacture.source');
    Route::get('/admin/manufacture/{id}/edit','ManufactureController@edit')->name('manufacture.edit');
    Route::get('/admin/manufacture/{id}/show','ManufactureController@show')->name('manufacture.show');
    Route::get('/admin/manufacture/{id}/destroy','ManufactureController@destroy')->name('manufacture.destroy');
    Route::get('/admin/manufacture/getManufacture','ManufactureController@getManufacture')->name('manufacture.getManufacture');
    Route::post('/admin/manufacture/store','ManufactureController@store')->name('manufacture.store');
    Route::post('/admin/manufacture/{id}/update','ManufactureController@update')->name('manufacture.update');
    Route::get('/admin/manufacture/{id}/find','ManufactureController@find')->name('manufacture.find');

    //transaction
    Route::get('/admin/transaction','TransactionController@index')->name('transaction.index');
    Route::get('/admin/transaction/create','TransactionController@create')->name('transaction.create');
    Route::get('/admin/transaction/history','TransactionController@history')->name('transaction.history');
    Route::get('/admin/transaction/{status}/source','TransactionController@source')->name('transaction.source');
    Route::get('/admin/transaction/{id}/edit','TransactionController@edit')->name('transaction.edit');
    Route::get('/admin/transaction/{id}/print','TransactionController@print')->name('transaction.print');
    Route::get('/admin/transaction/{id}/show','TransactionController@show')->name('transaction.show');
    Route::get('/admin/transaction/{id}/destroy','TransactionController@destroy')->name('transaction.destroy');
    Route::post('/admin/transaction/store','TransactionController@store')->name('transaction.store');
    Route::post('/admin/transaction/{id}/update','TransactionController@update')->name('transaction.update');
    Route::post('/admin/transaction/export','TransactionController@export')->name('transaction.export');
    Route::post('/admin/transaction/{id}/complete','TransactionController@complete')->name('transaction.complete');

    //setting
    Route::get('/admin/setting','SettingController@index')->name('setting.index');
    Route::get('/admin/setting/create','SettingController@create')->name('setting.create');
    Route::get('/admin/setting/source','SettingController@source')->name('setting.source');
    Route::get('/admin/setting/{id}/edit','SettingController@edit')->name('setting.edit');
    Route::get('/admin/setting/{id}/show','SettingController@show')->name('setting.show');
    Route::get('/admin/setting/{id}/destroy','SettingController@destroy')->name('setting.destroy');
    Route::post('/admin/setting/store','SettingController@store')->name('setting.store');
    Route::post('/admin/setting/change','SettingController@change')->name('setting.change');
    Route::post('/admin/setting/{id}/update','SettingController@update')->name('setting.update');

});
