<?php namespace crocodicstudio\LaravelLogReader;

use Illuminate\Support\ServiceProvider;
use App;

class LaravelLogReaderServiceProvider extends ServiceProvider
{

    protected $plugin_name = "LaravelLogReader";

    /**
     * Bootstrap the application services.
     *
     * @return void
     */

    public function boot()
    {
        $this->publishes([__DIR__."/Controllers"=>app_path("CBPlugins/".$this->plugin_name."/Controllers")]);
        $this->publishes([__DIR__."/Routes"=>app_path("CBPlugins/".$this->plugin_name."/Routes")]);
        $this->publishes([__DIR__."/Views"=>app_path("CBPlugins/".$this->plugin_name."/Views")]);
        $this->publishes([__DIR__."/../plugin.json"=>app_path("CBPlugins/".$this->plugin_name."/plugin.json")]);
        $this->publishes([__DIR__."/Asset"=>public_path("cb_asset/".$this->plugin_name)]);
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
