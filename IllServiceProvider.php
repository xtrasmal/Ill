<?php namespace Ill;

use Ill\Core\Events\Dispatcher,
    Illuminate\Container\Container,
    Illuminate\Support\ServiceProvider,
    Ill\System\Modules\Finder,
    Ill\System\Modules\Commands\ModulesCommand,
    Ill\System\Modules\Commands\ModulesCreateCommand,
    Ill\System\Modules\Commands\ModulesGenerateCommand,
    Ill\System\Modules\Commands\ModulesMigrateCommand,
    Ill\System\Modules\Commands\ModulesPublishCommand,
    Ill\System\Modules\Commands\ModulesScanCommand,
    Ill\System\Modules\Commands\ModulesSeedCommand,
    Ill\System\Cli\ListSystemBehaviour;

class IllServiceProvider extends ServiceProvider {

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
        // Register commands
        $this->bootCommands();
        try
        {
            // Auto scan if specified
            $this->app['modules']->start();

            // And finally register all modules
            $this->app['modules']->register();
        }
        catch (\Exception $e)
        {
            $this->app['modules']->logError("There was an error when starting modules: [".$e->getMessage()."]");
        }
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
        $this->app->singleton('Ill\Core\Events\Dispatcher', function($app) {
            return new Dispatcher(new Container($app));
        });

        $this->app['modules'] = $this->app->share(function($app)
        {
            return new Finder($app, $app['files'], $app['config']);
        });


        $this->registerEvents();
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array('modules');
	}

    /**
     * Register global event listeners
     *
     */

    public function registerEvents()
    {

        $this->app['router']->matched(function($route, $request) {
            //echo 'hello';
        });
    }

    /**
     * Register all available commands
     * @return void
     */
    public function bootCommands()
    {
        $this->app['system.behaviour'] = $this->app->share(function($app)
        {
            return new ListSystemBehaviour($app);
        });
        // Add modules command
        $this->app['modules.list'] = $this->app->share(function($app)
        {
            return new ModulesCommand($app);
        });

        // Add scan command
        $this->app['modules.scan'] = $this->app->share(function($app)
        {
            return new ModulesScanCommand($app);
        });

        // Add publish command
        $this->app['modules.publish'] = $this->app->share(function($app)
        {
            return new ModulesPublishCommand($app);
        });

        // Add migrate command
        $this->app['modules.migrate'] = $this->app->share(function($app)
        {
            return new ModulesMigrateCommand($app);
        });

        // Add seed command
        $this->app['modules.seed'] = $this->app->share(function($app)
        {
            return new ModulesSeedCommand($app);
        });

        // Add create command
        $this->app['modules.create'] = $this->app->share(function($app)
        {
            return new ModulesCreateCommand($app);
        });

        // Add generate command
        $this->app['modules.generate'] = $this->app->share(function($app)
        {
            return new ModulesGenerateCommand($app);
        });

        // Now register all the commands
        $this->commands(array(
            'system.behaviour',
            'modules.list',
            'modules.scan',
            'modules.publish',
            'modules.migrate',
            'modules.seed',
            'modules.create',
            'modules.generate'
        ));
    }

}
