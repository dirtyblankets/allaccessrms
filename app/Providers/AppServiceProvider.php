<?php namespace AllAccessRMS\Providers;

use DB;
use Illuminate\Support\ServiceProvider;
use AllAccessRMS\DocumentDefinitions\AttendeeDocument;
use AllAccessRMS\AttendeeDocuments\AttendeeApplication;
use AllAccessRMS\AttendeeDocuments\AttendeeHealthReleaseForm;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        require_once app_path() . '/validators.php';
        //
        if (DB::connection() instanceof \Illuminate\Database\SQLiteConnection) {
            DB::statement(DB::raw('PRAGMA foreign_keys=1'));
        }

        if ($this->app->environment() == 'local') {
            $this->app->register('Laracasts\Generators\GeneratorsServiceProvider');
        }


    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
