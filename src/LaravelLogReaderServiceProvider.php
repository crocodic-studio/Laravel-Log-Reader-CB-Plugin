<?php namespace crocodicstudio\LaravelLogReader;

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
        $this->publishes([__DIR__."/Publish"=>app_path("CBPlugins/LaravelLogReader")]);
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
