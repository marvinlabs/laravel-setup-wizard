<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Routing
    |--------------------------------------------------------------------------
    |
    | You can configure the routing for the wizard here
    */

    'routing' => [
        // Load the routes specified by the package, if not, you have to create the routes by yourself in your
        // project's route file
        'load_default' => true,

        // When using default routes, here are some ways to customize them
        'prefix'       => 'install',
    ],

    /*
    |--------------------------------------------------------------------------
    | Steps
    |--------------------------------------------------------------------------
    |
    | Each step will be ran in order. Each of the step is a class which
    | implements the MarvinLabs\SetupWizard\Contracts\StepContract interface
    */

    'steps' => [
        // MarvinLabs\SetupWizard\Steps\EnvFile::class,
        // MarvinLabs\SetupWizard\Steps\Database::class,
    ],

];