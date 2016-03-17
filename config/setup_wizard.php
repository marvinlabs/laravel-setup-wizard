<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Routing
    |--------------------------------------------------------------------------
    |
    | You can configure the routing for the wizard here (or even turn it off
    | altogether)
    */

    'routing' => [
        // Load the routes specified by the package, if not, you have to create
        // the routes by yourself in your project's route file
        'load_default'  => true,

        // When using default routes, here are some ways to customize them
        'prefix'        => 'install',

        // Once the wizard completes, you can redirect to a specific route name
        'success_route' => '',

        // Once the wizard completes, you can redirect to a specific route url
        // (if not using the success route name)
        'success_url'   => '',
    ],

    /*
    |--------------------------------------------------------------------------
    | Steps
    |--------------------------------------------------------------------------
    |
    | Each step will be ran in order. Each of the step is a class which
    | implements the MarvinLabs\SetupWizard\Contracts\WizardStep interface
    */

    'steps' => [
        'env'      => \MarvinLabs\SetupWizard\Steps\EnvFileStep::class,
        'database' => \MarvinLabs\SetupWizard\Steps\DatabaseStep::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Triggers
    |--------------------------------------------------------------------------
    |
    | Triggers are used to determine if the wizard has to be ran. Each of the
    | triggers is a class which implements the
    | MarvinLabs\SetupWizard\Contracts\WizardTrigger interface
    */

    'triggers' => [
        \MarvinLabs\SetupWizard\Triggers\EnvFileTrigger::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Theming
    |--------------------------------------------------------------------------
    |
    | You can indicate the name of the CSS file to use to customize the wizard
    | appearance
    */

    'theme' => 'material',
];