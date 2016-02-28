# Laravel Setup Wizard

A Laravel package to help you build a web setup wizard for your application

## Setup

### Declare the service provider 

Add the following line to your `config/app.php` file:

```php
'providers' => [
    // ...
    // Other Service Providers
    // ...

    MarvinLabs\SetupWizard\Providers\SetupWizardServiceProvider::class,
],
```

### Declare routes to the controller for the setup wizard

**<TODO>**

### Publish assets 

This step is optional. You can publish files from the package in order to be able to override them. Use the artisan 
command like you would for any other package:

```
php artisan vendor:publish
```

You can also publish only some of the files to override just what you need. The library has tagged them into 4 different
categories.

```
php artisan vendor:publish --provider="MarvinLabs\SetupWizard\Providers\SetupWizardServiceProvider" --tag="config"
php artisan vendor:publish --provider="MarvinLabs\SetupWizard\Providers\SetupWizardServiceProvider" --tag="assets"
php artisan vendor:publish --provider="MarvinLabs\SetupWizard\Providers\SetupWizardServiceProvider" --tag="views"
php artisan vendor:publish --provider="MarvinLabs\SetupWizard\Providers\SetupWizardServiceProvider" --tag="translations"
```

If you had published some files before and want to overwrite them, use the `--force` flag with the artisan commands 
above.