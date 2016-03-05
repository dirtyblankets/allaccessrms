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

Route::get('event/show/{id}', [
    'as'    =>  'event.show',
    'uses'  =>  'EventRegistrationController@show'
]);

// Event Registration
Route::post('event/registration', [
    'as'    =>  'event.registration',
    'uses'  =>  'EventRegistrationController@register'
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

    ]);

});


//Owner Routes
Route::group(['as'=>'owner::', 'middleware'=>['auth', 'acl'], 'is'=>'owner'], function() {

    //Dashboard routes
    Route::get('dashboard', [
        'as'            =>  'dashboard',
        'uses'          =>  'Owner\DashboardController@index',
    ]);

    //System User routes
    Route::get('users', [
        'as' => 'users',
        'uses' => 'Owner\UserController@index',
    ]);

    Route::get('users/show/{id}', [
        'as' => 'users.show',
        'uses' => 'Owner\UserController@show',
    ]);

    Route::get('users/create', [
        'as' => 'users.create',
        'uses' => 'Owner\UserController@create',
    ]);

    Route::get('users/invite', [
        'as' => 'users.invite',
        'uses' => 'Owner\UserController@invite',
    ]);

    Route::post('users/store', [
        'as' => 'users.store',
        'uses' => 'Owner\UserController@store',
    ]);

    Route::get('users/{id}/edit', [
        'as' => 'users.edit',
        'uses' => 'Owner\UserController@edit',
    ]);

    Route::get('users/{id}', [
        'as' => 'users.update',
        'uses' => 'Owner\UserController@update',
    ]);

    Route::delete('users/{id}', [
        'as' => 'users.delete',
        'uses' => 'Owner\UserController@destroy',
    ]);

    //Organization routes
    Route::get('organizations', [
        'as' => 'organizations',
        'uses' => 'Owner\OrganizationController@index',
    ]);

    Route::get('organizations/create', [
        'as' => 'organizations.create',
        'uses' => 'Owner\OrganizationController@create',
    ]);

    Route::post('organizations/store', [
        'as' => 'organizations.store',
        'uses' => 'Owner\OrganizationController@store',
    ]);
    
    //Events routes
    Route::get('events', [
        'as' => 'events',
        'uses' => 'Owner\AllAccessEventsController@index',
    ]);

    Route::get('events/create', [
        'as' => 'events.create',
        'uses' => 'Owner\AllAccessEventsController@create',
    ]);

    Route::get('events/{id}/', [
        'as' => 'events.show',
        'uses' => 'Owner\AllAccessEventsController@show',
    ]);

    Route::get('events/{id}/edit', [
        'as' => 'events.edit',
        'uses' => 'Owner\AllAccessEventsController@edit',
    ]);

    Route::patch('events/{id}', [
        'as'    =>  'events.unpublish',
        'uses'   =>  'Owner\AllAccessEventsController@unpublish',
    ]);

    Route::put('events/{id}', [
        'as' => 'events.update',
        'uses' => 'Owner\AllAccessEventsController@update',
    ]);

    Route::post('events/store', [
        'as' => 'events.store',
        'uses' => 'Owner\AllAccessEventsController@store',
    ]);

    Route::delete('events/{id}', [
        'as'    =>  'events.destroy', 
        'uses' => 'Owner\AllAccessEventsController@destroy',
    ]);

    Route::post('events/addgueststoview', [
        'as'    =>  'events.addgueststoview',
        'uses'  =>  'Owner\AllAccessEventsController@addgueststoview',
    ]);
});



// Access Denied
Route::get('accessdenied',['as' => 'accessdenied', function (){
    return \View::make('errors/accessdenied');
}]);

// Event Registration
//Route::resource('registration', 'RegistrationController');