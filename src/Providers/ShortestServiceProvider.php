<?php

namespace Appsketch\Shortest\Providers;

use Appsketch\Shortest\Shortest;
use GuzzleHttp\Client;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;

class ShortestServiceProvider extends ServiceProvider
{
    /**
     * Indicates of loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        // Publish config.
        $this->publishConfig();
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        // Merge config.
        $this->mergeConfig();

        // Register bindings.
        $this->registerBindings();

        // Register Shortest.
        $this->registerShortest();

        // Alias Shortest.
        $this->aliasShortest();
    }

    /**
     * Register bindings.
     */
    private function registerBindings()
    {
        $this->app->singleton('GuzzleHttp\Client', function()
        {
            return new Client;
        });
    }

    /**
     * Register Shortest.
     */
    private function registerShortest()
    {
        $this->app->bind('Appsketch\Shortest\Shortest', function($app)
        {
            return new Shortest($app['GuzzleHttp\Client'], $app['config']);
        });
    }

    /**
     * Alias Shortest.
     */
    private function aliasShortest()
    {
        if(!$this->aliasExists('Shortest'))
        {
            AliasLoader::getInstance()->alias(
                'Shortest',
                \Appsketch\Shortest\Facades\Shortest::class
            );
        }
    }

    /**
     * Publish config.
     */
    private function publishConfig()
    {
        $this->publishes([
            __DIR__ . '/../config/shortest.php' => config_path('shortest.php')
        ]);
    }

    /**
     * Merge config.
     */
    private function mergeConfig()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/shortest.php', 'shortest'
        );
    }

    /**
     * Check if an alias already exists in the IOC.
     *
     * @param $alias
     *
     * @return bool
     */
    private function aliasExists($alias)
    {
        return array_key_exists($alias, AliasLoader::getInstance()->getAliases());
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [
            'Appsketch\Shortest\Shortest',
            'GuzzleHttp\Client'
        ];
    }
}
