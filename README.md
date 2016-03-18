# Laravel Setup Wizard

A Laravel package to help you build a web setup wizard for your application

## Setup

### Add the package to your project

```
composer require marvinlabs/laravel-setup-wizard
```

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

The configuration of the package is done via the `config/setup_wizard.php` file. Each configuration option is documented
within that file and hence we will not repeat this information here.

## Adding your own wizard steps

You can easily add or remove steps to the wizard.

### Create a step class

The easiest would be to start from one of our bundled steps. A step usually will inherit from 
`\MarvinLabs\SetupWizard\Steps\BaseStep` and must implement a few more methods.
 
#### getFormData()

This is the data which will be passed to your view. If you do not specify that method, it will return an empty array.
The data you pass in this array will be available in the step view directly as a variable. For example, if you return 
`[ 'myVar' => 23 ]`, you will be able to access `$myVar` in your step view.
 
#### apply($formData)

The method which is called before moving on to the next step. The `$formData` parameter contains the data that has been 
submitted with the step form (if any).

That method should return `true` if the wizard can proceed to the next step. If not, it should return `false` and can 
provide user feedback by using the method `$this->addError('my_key', 'My error message')`. 

#### undo()

The method is called when coming back to this step from the next one. This basically undoes everything that has been 
done by the `apply` method.

That method should return `true` if the wizard can come back to our step. If not, it should return `false` and can 
provide user feedback by using the method `$this->addError('my_key', 'My error message')`. 

### Create the step view

If you have registered your step class with the id `my_step`, you need to create a view which will be found in the 
file `resources/views/vendor/setup_wizard/partials/steps/my_step.blade.php`.

### Create the strings

Some strings are required for the step to be properly displayed: icon, title, description, etc. These can be found in 
the file `resources/lang/en/steps.php`. You will notice that each step ID contains a few strings which provide this
information.

### Add your step to configuration

Open `config/setup_wizard.php` and add your step class to the list of steps for the wizard:

```
    'steps' => [
        'requirements' => \MarvinLabs\SetupWizard\Steps\RequirementsStep::class,
        'folders'      => \MarvinLabs\SetupWizard\Steps\FoldersStep::class,
        'env'          => \MarvinLabs\SetupWizard\Steps\EnvFileStep::class,
        'database'     => \MarvinLabs\SetupWizard\Steps\DatabaseStep::class,
        
        'my-step-id'   => \App\Setup\MyStep::class',
        
        'final'        => \MarvinLabs\SetupWizard\Steps\FinalStep::class,
    ],
```

The steps are declared in the order in which they will be run. You can of course remove some of the default steps. 
However, you should always finish the wizard with the FinalStep. That step will write a file which will prevent the 
setup wizard to be executed again once done. This provides security as nobody will be able to run the setup again if
the `storage/.setup_wizard` file is there.

## Credits

- Some code is taken from another similar project: [RachidLaasri/LaravelInstaller](https://github.com/RachidLaasri/LaravelInstaller)