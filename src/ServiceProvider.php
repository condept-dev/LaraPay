<?php namespace LaraPay;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{

    protected $defer = false;

    /**
     * Bootstrap the application events.
     */
    public function boot()
    {
        /*
         * Publish configuration file
         */
        $this->publishes([
            __DIR__ . '/../config/larapay.php' => config_path('larapay.php'),
        ]);

        $loader = \Illuminate\Foundation\AliasLoader::getInstance();
        $loader->alias('LaraPay', 'LaraPay\Facade');
    }

    /**
     * Register the service provider.
     */
    public function register()
    {
        config([
            'config/larapay.php',
        ]);

        $this->app['larapay'] = $this->app->share(function ($app) {
            return new LaraPay();
        });
    }
}
