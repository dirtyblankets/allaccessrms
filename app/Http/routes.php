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




// Event Payment
Route::get('event/payment/{event}/{attendee}', [
    'as' => 'event.payment',
    'uses' => 'RegistrationPaymentController@getPaymentOnline'
]);

Route::post('event/process_payment', [
    'as' => 'event.process_payment',
    'uses' => 'RegistrationPaymentController@postPaymentOnline'
]);




// User Login
Route::get('auth/login', [
    'as' => 'login',
    'uses' => 'Auth\AuthController@getLogin'
]);

Route::post('auth/login', 'Auth\AuthController@postLogin');

Route::get('auth/logout', [
    'as' => 'logout',
    'uses' => 'Auth\AuthController@getLogout'
]);



// New User Authentication Routes
Route::get('new_user/{user_id}', [
    'as'    =>  'new_user.login',
    'uses'  =>  'Auth\NewUserLoginController@getLogin'
]);

Route::put('new_user/{user_id}', [
    'as'    =>  'new_user.login',
    'uses'  =>  'Auth\NewUserLoginController@postLogin'
]);



Route::group(['middleware'=>['auth']], function() {

    Route::get('profile', [
        'as'    =>  'profile',
        'uses'  =>  'Auth\ProfileController@index'
    ]);

    Route::get('profile/{id}/edit',[
        'as' => 'profile.edit',
        'uses' => 'Auth\ProfileController@edit'
    ]);

    Route::patch('password/{id}',[
        'as' => 'password.update',
        'uses' => 'Auth\PasswordController@update'
    ]);

    Route::patch('organization_info/{id}',[
        'as' => 'organization_info.update',
        'uses' => 'Dashboard\OrganizationController@update'
    ]);

});


//Dashboard Routes
Route::group(['middleware'=>['auth', 'acl'], 'is'=>'owner|admin|moderator'], function() {

    //Dashboard routes
    Route::get('dashboard', [
        'as' => 'dashboard',
        'uses' => 'Dashboard\HomeController@index',
    ]);

    //System User routes
    Route::get('users', [
        'as' => 'users',
        'uses' => 'Dashboard\UserController@index',
    ]);

    Route::get('users/show/{id}', [
        'as' => 'users.show',
        'uses' => 'Dashboard\UserController@show',
    ]);

    Route::get('users/create', [
        'as' => 'users.create',
        'uses' => 'Dashboard\UserController@create',
        'can' => 'create.users',
    ]);

    Route::post('users/store', [
        'as' => 'users.store',
        'uses' => 'Dashboard\UserController@store',
        'can' => 'create.users',
    ]);

    Route::get('users/invite', [
        'as' => 'users.invite',
        'uses' => 'Dashboard\UserController@invite',
    ]);

    Route::get('users/{id}/edit', [
        'as' => 'users.edit',
        'uses' => 'Dashboard\UserController@edit',
        'can'   =>  'update.users',
    ]);

    Route::put('users/{id}', [
        'as' => 'users.update',
        'uses' => 'Dashboard\UserController@update',
        'can'   =>  'update.users',
    ]);

    Route::delete('users/{id}', [
        'as' => 'users.destroy',
        'uses' => 'Dashboard\UserController@destroy',
        'can'   =>  'delete.users'
    ]);

    //Events routes
    Route::get('events', [
        'as' => 'events',
        'uses' => 'Dashboard\ManageEventController@index',
    ]);

    Route::get('events/create', [
        'as' => 'events.create',
        'uses' => 'Dashboard\ManageEventController@create',
    ]);

    Route::get('events/{id}/', [
        'as' => 'events.show',
        'uses' => 'Dashboard\ManageEventController@show',
    ]);

    Route::get('events/{id}/manage', [
        'as' => 'events.manage',
        'uses' => 'Dashboard\ManageEventController@manage',
    ]);

    Route::patch('events/{id}', [
        'as'    =>  'events.unpublish',
        'uses'  =>  'Dashboard\ManageEventController@unpublish', 
    ]);

    Route::put('events/{id}', [
        'as' => 'events.update',
        'uses' => 'Dashboard\ManageEventController@update',
    ]);

    Route::delete('events/{id}', [
        'as'    =>  'events.destroy', 
        'uses' => 'Dashboard\ManageEventController@destroy',
    ]);

    Route::post('eventguests/add', [
        'as'    =>  'eventguests.add',
        'uses'  =>  'Dashboard\EventGuestsController@add',
    ]);

    Route::delete('eventguests/{id}', [
        'as'    =>  'eventguests.destroy', 
        'uses' => 'Dashboard\EventGuestsController@destroy',
    ]);

    //Organization routes
    Route::get('organizations', [
        'as' => 'organizations',
        'uses' => 'Dashboard\OrganizationController@index',
    ]);

    Route::get('organizations/create', [
        'as' => 'organizations.create',
        'uses' => 'Dashboard\OrganizationController@create',
    ]);

    Route::post('organizations/store', [
        'as' => 'organizations.store',
        'uses' => 'Dashboard\OrganizationController@store',
    ]);

});


// Access Denied
Route::get('accessdenied',['as' => 'accessdenied', function (){
    return \View::make('errors/accessdenied');
}]);

// Event Registration
//Route::resource('registration', 'RegistrationController');