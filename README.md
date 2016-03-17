# Laravel Setup Wizard

A Laravel package to help you build a web setup wizard for your application

## Setup

### Declare the service provider and the alias

Add the following line to your `config/app.php` file:

```php
'providers' => [
    // ...
    // Other Service Providers
    // ...
    MarvinLabs\SetupWizard\ServiceProvider::class,
],

'aliases' => [
    // ...
    // Other aliases
    // ...
    'SetupWizard' => MarvinLabs\SetupWizard\Facades\SetupWizard::class,
],
```

### Declare the required middleware

Add the following line to your `app/Http/Kernel.php` file:

```php
protected $middlewareGroups = [
    // ...
    // Other Middleware
    // ...

    'setup_wizard' => [
        \Illuminate\Session\Middleware\StartSession::class,
        \Illuminate\View\Middleware\ShareErrorsFromSession::class,
        'setup_wizard.initializer',
    ]
];

protected $routeMiddleware = [
    // ...
    // Other Middleware
    // ...

    'setup_wizard.initializer' => \MarvinLabs\SetupWizard\Middleware\SetupWizardInitializer::class,
    'setup_wizard.trigger'     => \MarvinLabs\SetupWizard\Middleware\SetupWizardTrigger::class,
];
```

### Enable the middleware to launch the wizard if necessary

If you want to launch the setup wizard automatically when required, you need to add the `SetupWizardTrigger` middleware
to the routes you wish to protect. For instance, if you have a route group to show an administration panel, you could 
do it there:

```php
Route::group([
    'prefix'     => 'admin', 
    'middleware' => 'setup_wizard.trigger'
], function () {
        // ...
});
```

This way, the setup wizard will only be triggered when trying to access the administration panel.

*The middleware to trigger the setup wizard should be put as the first one of the middleware list*

### Publish assets 

To get the CSS right, you need to at least publish the package assets to your public directory:

```
php artisan vendor:publish --provider="MarvinLabs\SetupWizard\ServiceProvider" --tag="assets"
```

Optionally, you can publish more files from the package in order to be able to override them. Use the artisan 
command like you would for any other package (will publish files from all vendor packages):

```
php artisan vendor:publish
```

Or you can publish only some of the package files to override just what you need. The library has tagged them into 4 
different categories (assets category has been published before):

```
php artisan vendor:publish --provider="MarvinLabs\SetupWizard\ServiceProvider" --tag="config"
php artisan vendor:publish --provider="MarvinLabs\SetupWizard\ServiceProvider" --tag="views"
php artisan vendor:publish --provider="MarvinLabs\SetupWizard\ServiceProvider" --tag="translations"
```

If you had published some files before and want to overwrite them, use the `--force` flag with the artisan commands 
above.

## Configuration

## Credits

- Background image used in default CSS: <a href="http://www.flickr.com/photos/57527070@N06/25322975232">Heavenly Light Ray Silhouette</a>