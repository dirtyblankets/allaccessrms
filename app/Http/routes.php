<?php
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function() {
    //return view('welcome');
});

// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', [
    'as' => 'logout',
    'uses' => 'Auth\AuthController@getLogout'
]);

Route::get('new_user_registration', [ 
    'as' => 'new_user_registration',
    'uses' => 'NewUserRegistrationController@create'
]);

Route::post('new_user_registration/store', [
        'as'    =>  'new_user_registration.store',
        'uses'  =>  'NewUserRegistrationController@store'
]);

//Admin Routes
Route::group(['as'=>'admin::', 'middleware'=>['auth', 'acl'], 'is'=>'owner'], function() {

    //Dashboard routes
    Route::get('dashboard', [
        'as'            =>  'dashboard',
        'uses'          =>  'Admin\DashboardController@index',
    ]);

    //System User routes
    Route::get('users', [
        'as' => 'users',
        'uses' => 'Admin\UserController@index',
    ]);

    Route::get('users/show/{id}', [
        'as' => 'users.show',
        'uses' => 'Admin\UserController@show',
    ]);

    Route::get('users/create', [
        'as' => 'users.create',
        'uses' => 'Admin\UserController@create',
    ]);

    Route::get('users/invite', [
        'as' => 'users.invite',
        'uses' => 'Admin\UserController@invite',
    ]);

    Route::post('users/store', [
        'as' => 'users.store',
        'uses' => 'Admin\UserController@store',
    ]);

    Route::get('users/{id}/edit', [
        'as' => 'users.edit',
        'uses' => 'Admin\UserController@edit',
    ]);

    Route::get('users/{id}', [
        'as' => 'users.update',
        'uses' => 'Admin\UserController@update',
    ]);

    Route::delete('users/{id}', [
        'as' => 'users.delete',
        'uses' => 'Admin\UserController@destroy',
    ]);

    //Organization routes
    Route::get('organizations', [
        'as' => 'organizations',
        'uses' => 'Admin\OrganizationController@index',
    ]);

    Route::get('organizations/create', [
        'as' => 'organizations.create',
        'uses' => 'Admin\OrganizationController@create',
    ]);

    Route::post('organizations/store', [
        'as' => 'organizations.store',
        'uses' => 'Admin\OrganizationController@store',
    ]);
    //Events routes
    Route::get('events', [
        'as' => 'events',
        'uses' => 'Admin\EventController@index',
    ]);

    Route::get('events/create', [
        'as' => 'events.create',
        'uses' => 'Admin\EventController@create',
    ]);
});




// Access Denied
Route::get('accessdenied',['as' => 'accessdenied', function (){
    return \View::make('errors/accessdenied');
}]);

// Event Registration
//Route::resource('registration', 'RegistrationController');