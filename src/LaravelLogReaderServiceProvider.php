<?php namespace crocodicstudio\crudbooster;

use Illuminate\Support\ServiceProvider;
use App;

class LaravelLogReaderServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */

    public function boot()
    {

    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        // Register additional library
        $this->app->register('Jackiedo\LogReader\LogReaderServiceProvider');
    }
}
