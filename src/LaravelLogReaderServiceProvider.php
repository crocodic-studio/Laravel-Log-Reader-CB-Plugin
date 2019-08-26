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
        $this->publishes([__DIR__."/Controllers"=>app_path("CBPlugins/LaravelLogReader/Controllers")]);
        $this->publishes([__DIR__."/Routes"=>app_path("CBPlugins/LaravelLogReader/Routes")]);
        $this->publishes([__DIR__."/Views"=>app_path("CBPlugins/LaravelLogReader/Views")]);
        $this->publishes([__DIR__."/plugin.json"=>app_path("CBPlugins/LaravelLogReader/plugin.json")]);
        $this->publishes([__DIR__."/Asset"=>public_path("cb_asset/LaravelLogReader")]);
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
