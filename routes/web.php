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

Route::get('/test/edit', function (){

   return view('admin.employees.edit');


});

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');



Route::group(['prefix'=>'admin', 'middleware'=>'auth'], function (){
    Route::get('/dashboard', 'HomeController@dashboard')->name('dashboard');

    Route::get('/users', ['uses'=>'UsersController@index', 'as'=>'users']);

    Route::get('/user/create', ['uses'=>'UsersController@create', 'as'=>'user.create']);

    Route::post('/user/store', ['uses'=>'UsersController@store', 'as'=>'user.store']);

    Route::get('/user/edit/{id}', ['uses'=>'UsersController@edit', 'as'=>'user.edit']);

    Route::post('/user/update/{id}', ['uses'=>'UsersController@update', 'as'=>'user.update']);

    Route::get('/user/delete/{id}', ['uses'=>'UsersController@delete', 'as'=>'user.delete']);

    Route::get('/user/deactivate/{id}', ['uses'=>'UsersController@destroy', 'as'=>'user.deactivated']);

    Route::get('/trashed', ['uses'=>'UsersController@trashes', 'as'=>'users.trashed']);

    Route::get('/user/restore/{id}', ['uses'=>'UsersController@restore', 'as'=>'user.restore']);

    Route::get('/is_admin/{id}', ['uses'=>'UsersController@is_admin', 'as'=>'is_admin']);

    Route::get('/not_admin/{id}', ['uses'=>'UsersController@not_admin', 'as'=>'not_admin']);

    Route::get('/categories', ['uses'=>'CategoriesController@index', 'as'=>'categories']);

    Route::get('/category/create', ['uses'=>'CategoriesController@create', 'as'=>'category.create']);

    Route::post('/category/store', ['uses'=>'CategoriesController@store', 'as'=>'category.store']);

    Route::get('/category/edit/{id}', ['uses'=>'CategoriesController@edit', 'as'=>'category.edit']);

    Route::post('/category/update/{id}', ['uses'=>'CategoriesController@update', 'as'=>'category.update']);

    Route::get('/category/delete/{id}', ['uses'=>'CategoriesController@destroy', 'as'=>'category.delete']);


    Route::get('/employees', ['uses'=>'EmployeesController@index', 'as'=>'employees']);

    Route::get('/employee/create', ['uses'=>'EmployeesController@create', 'as'=>'employee.create']);

    Route::post('/employee/store', ['uses'=>'EmployeesController@store', 'as'=>'employee.store']);

    Route::get('/employee/edit/{id}', ['uses'=>'EmployeesController@edit', 'as'=>'employee.edit']);

    Route::post('/employee/update/{id}', ['uses'=>'EmployeesController@update', 'as'=>'employee.update']);

    Route::get('/employee/delete/{id}', ['uses'=>'EmployeesController@delete', 'as'=>'employee.delete']);

    Route::get('/employees/deactivated', ['uses'=>'EmployeesController@trashes', 'as'=>'trashes']);

    Route::get('/employee/deactivate/{id}', ['uses'=>'EmployeesController@destroy', 'as'=>'employee.deactivated']);

    Route::get('/employee/restore/{id}', ['uses'=>'EmployeesController@restore', 'as'=>'employee.restore']);

    Route::post('/employee/profile/update/{id}',['uses'=>'EmployeesController@update', 'as'=>'employee.profile.update']);


    Route::get('/records', ['uses'=>'RecordsController@index', 'as'=>'records']);
    Route::post('/record/store', ['uses'=>'RecordsController@store', 'as'=>'record.store']);
    Route::post('/commission', ['uses'=>'RecordsController@commission', 'as'=>'commission']);

    Route::get('/settings', ['uses'=>'SettingsController@index', 'as'=>'settings']);
    Route::post('/settings/update', ['uses'=>'SettingsController@update_info', 'as'=>'settings.info.update']);
    Route::post('/settings/update/price', ['uses'=>'SettingsController@update_price', 'as'=>'settings.price.update']);

});

Route::get('/user/profile',['uses'=>'ProfilesController@index', 'as'=>'user.profile']);
Route::post('/user/profile/update',['uses'=>'ProfilesController@update', 'as'=>'user.profile.update']);

Route::get('/customers', ['uses'=>'CustomersController@index', 'as'=>'customers']);

Route::get('/customer/create', ['uses'=>'CustomersController@create', 'as'=>'customer.create']);

Route::post('/customer/store', ['uses'=>'CustomersController@store', 'as'=>'customer.store']);

Route::get('/customer/edit/{id}', ['uses'=>'CustomersController@edit', 'as'=>'customer.edit']);

Route::post('/customer/update/{id}', ['uses'=>'CustomersController@update', 'as'=>'customer.update']);

Route::get('/customer/delete/{id}', ['uses'=>'CustomersController@delete', 'as'=>'customer.delete']);

Route::get('/customers/deactivated', ['uses'=>'CustomersController@trashes', 'as'=>'customers.trashes']);

Route::get('/customer/deactivate/{id}', ['uses'=>'CustomersController@destroy', 'as'=>'customer.deactivate']);

Route::get('/customer/restore/{id}', ['uses'=>'CustomersController@restore', 'as'=>'customer.restore']);

Route::post('/customer/profile/update/{id}',['uses'=>'CustomersController@update', 'as'=>'customer.profile.update']);

Route::get('/customers/locations', ['uses'=>'CustomersController@locations', 'as'=>'customers.locations']);

Route::resource('customer/area', 'CustomerAreasController');




