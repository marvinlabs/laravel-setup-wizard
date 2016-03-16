<?php

namespace MarvinLabs\SetupWizard;

use MarvinLabs\SetupWizard\Wizard\DefaultSetupWizard;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{

    public static $RES_NAMESPACE = 'setup_wizard';
    public static $CONFIG_FILE = 'setup_wizard.php';

    /** @var string Base directory for the package */
    private $packageDir;

    /**
     * Create a new service provider instance.
     *
     * @param  \Illuminate\Contracts\Foundation\Application $app
     */
    public function __construct($app)
    {
        parent::__construct($app);
        $this->packageDir = dirname(__DIR__);
    }

    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {
        // Merge configuration
        $this->mergeConfigFrom(
            $this->packageDir . '/config/' . self::$CONFIG_FILE, self::$RES_NAMESPACE
        );
    }

    /**
     * Register any other events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        $config = $this->app['config'];

        // Add the setup wizard routes if asked to
        $loadDefaultRoutes = $config->get('setup_wizard.routing.load_default');
        if ($loadDefaultRoutes && !$this->app->routesAreCached()) {
            require($this->packageDir . '/src/routes.php');
        }

        // Facade
        $this->app->singleton('SetupWizard', function ($app) {
            $wizard = new DefaultSetupWizard($app);

            return $wizard;
        }
        );

        $this->app->alias('SetupWizard', DefaultSetupWizard::class);

        // We have some views and translations for the wizard
        $this->loadViewsFrom($this->packageDir . '/resources/views', self::$RES_NAMESPACE);
        $this->loadTranslationsFrom($this->packageDir . '/resources/lang', self::$RES_NAMESPACE);

        // We publish some files to override if required
        $this->publishes([
            $this->packageDir . '/config/' . self::$CONFIG_FILE => config_path(self::$CONFIG_FILE),
        ], 'config');

        $this->publishes([
            $this->packageDir . '/resources/views' => resource_path('views/vendor/' . self::$RES_NAMESPACE),
        ], 'views');

        $this->publishes([
            $this->packageDir . '/resources/lang' => resource_path('lang/vendor/' . self::$RES_NAMESPACE),
        ], 'translations');

        $this->publishes([
            $this->packageDir . '/resources/assets' => public_path('vendor/' . self::$RES_NAMESPACE),
        ], 'assets');
    }

}