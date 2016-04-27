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

// Public routes...
Route::resource('/', 'HomePageController');

// Event Registration
Route::get('event/registration/{id}', [
    'as'    =>  'event.registration',
    'uses'  =>  'EventRegistrationController@getRegistration'
]);

Route::post('event/register', [
    'as'    =>  'event.register',
    'uses'  =>  'EventRegistrationController@postRegistration'
]);


Route::get('event/show/{id}', [
    'as'    =>  'event.show',
    'uses'  =>  'EventRegistrationController@show'
]);

Route::get('event/payment/{event}/{attendee}', [
    'as' => 'event.payment',
    'uses' => 'RegistrationPaymentController@getPaymentOnline'
]);

Route::post('event/process_payment', [
    'as' => 'event.process_payment',
    'uses' => 'RegistrationPaymentController@postPaymentOnline'
]);

// Authentication routes...
Route::get('auth/login', [
    'as' => 'login',
    'uses' => 'Auth\AuthController@getLogin'
]);

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

Route::group(['middleware'=>['auth']], function() {

    Route::get('settings',[
        'as' => 'settings',
        'uses' => 'Auth\SettingsController@index'
    ]);

    Route::patch('password_change',[
        'as' => 'password_change',
        'uses' => 'Auth\SettingsController@password_change'
    ]);

});


//Admin Routes
Route::group(['as'=>'admin::', 'middleware'=>['auth', 'acl'], 'is'=>'owner|admin'], function() {

    //Dashboard routes
    Route::get('dashboard', [
        'as' => 'dashboard',
        'uses' => 'Admin\DashboardController@index',
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
        'can' => 'create.users',
    ]);

    Route::post('users/store', [
        'as' => 'users.store',
        'uses' => 'Admin\UserController@store',
        'can' => 'create.users',
    ]);

    Route::get('users/invite', [
        'as' => 'users.invite',
        'uses' => 'Admin\UserController@invite',
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

    //Events routes
    Route::get('events', [
        'as' => 'events',
        'uses' => 'Admin\ManageEventController@index',
    ]);

    Route::get('events/create', [
        'as' => 'events.create',
        'uses' => 'Admin\ManageEventController@create',
    ]);

    Route::get('events/{id}/', [
        'as' => 'events.show',
        'uses' => 'Admin\ManageEventController@show',
    ]);

    Route::get('events/{id}/manage', [
        'as' => 'events.manage',
        'uses' => 'Admin\ManageEventController@manage',
    ]);

    Route::patch('events/{id}', [
        'as'    =>  'events.unpublish',
        'uses'  =>  'Admin\ManageEventController@unpublish', 
    ]);

    Route::put('events/{id}', [
        'as' => 'events.update',
        'uses' => 'Admin\ManageEventController@update',
    ]);

    Route::delete('events/{id}', [
        'as'    =>  'events.destroy', 
        'uses' => 'Admin\ManageEventController@destroy',
    ]);

    Route::post('eventguests/add', [
        'as'    =>  'eventguests.add',
        'uses'  =>  'Admin\EventGuestsController@add',
    ]);

    Route::delete('eventguests/{id}', [
        'as'    =>  'eventguests.destroy', 
        'uses' => 'Admin\EventGuestsController@destroy',
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

});

// Access Denied
Route::get('accessdenied',['as' => 'accessdenied', function (){
    return \View::make('errors/accessdenied');
}]);

// Event Registration
//Route::resource('registration', 'RegistrationController');