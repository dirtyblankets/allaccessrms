<?php namespace AllAccessRMS\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('AllAccessRMS\Accounts\Users\UserRepositoryInterface',
            'AllAccessRMS\Accounts\Users\UserRepository');

        $this->app->bind('AllAccessRMS\Accounts\Organizations\OrganizationRepositoryInterface',
            'AllAccessRMS\Accounts\Organizations\OrganizationRepository');

        $this->app->bind('AllAccessRMS\AllAccessEvents\EventRepositoryInterface',
            'AllAccessRMS\AllAccessEvents\EventRepository');

        $this->app->bind('AllAccessRMS\AllAccessEvents\EventSiteRepositoryInterface',
            'AllAccessRMS\AllAccessEvents\EventSiteRepository');

        $this->app->bind('AllAccessRMS\AllAccessEvents\AttendeeInvitationRepositoryInterface',
            'AllAccessRMS\AllAccessEvents\AttendeeInvitationRepository');
    }
}