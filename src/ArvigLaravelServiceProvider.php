<?php

namespace Arvig\ArvigLaravel;

use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;

use Arvig\ArvigLaravel\Commands\InstallCommand;

class ArvigLaravelServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerCommands();
        $this->registerPublishing();
    }

    /**
     * Register the commands offered 
     *
     * @return void
     */
    protected function registerCommands()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                InstallCommand::class
            ]);
        }
    }

    /**
     * Register publishing.
     *
     * @return void
     */
    protected function registerPublishing()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../artifacts/arvig-laravel-config.php' => config_path('arvig-laravel.php'),
                __DIR__.'/../artifacts/ExampleIntegrationTest.php' => base_path('tests/Integration/ExampleTest.php'),
                __DIR__.'/../artifacts/phpunit.xml' => base_path('phpunit.xml'),
            ], 'arvig-laravel-publisher');
        }
    }
}