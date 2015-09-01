<?php namespace Mikifus\Rally;

use Mikifus\Rally\Models\Follower;
use Illuminate\Support\ServiceProvider;

class RallyServiceProvider extends ServiceProvider {

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        // ### 4.2 ###
        // $this->package('mikifus/rally');

        // ### 5.1 ###
        $this->publishes([
            base_path('vendor/mikifus/rally/src/config/config.php') => config_path('messenger.php'),
            base_path('vendor/mikifus/rally/src/migrations') => base_path('database/migrations'),
        ]);
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->rally();
        $this->repositories();
    }

    public function rally()
    {
        $this->app['rally'] = $this->app->share(function($app){

           return new Rally(

               $app->make('rally.repository'),
               $app['config']
           );
        });
    }

    public function repositories()
    {
        $this->app->bind('rally.repository', function($app){

            if ($this->app['config']->get('rally::polymorphic') !== false)
            {
                if (($bindClass = $this->app['config']->get('rally::polymorphic.repository')) == null) {
                    $bindClass = "\Mikifus\Rally\Repositories\RallyPolymorphicRepository";
                }
            }
            else
            {
                if (($bindClass = $this->app['config']->get('rally::repository')) == null) {
                    $bindClass = "\Mikifus\Rally\Repositories\RallyRepository";
                }
            }

           return new $bindClass(
              new Follower(),
               $app['db']
           );
        });

        $this->app->bind('Mikifus\Rally\Repositories\RallyRepositoryInterface','rally.repository');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }

}
