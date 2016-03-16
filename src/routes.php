<?php

/** @var \Config $config */

Route::group([
    'prefix' => $config->get('setup_wizard.routing.prefix')
], function() {

    // Show the first step of the wizard
    Route::get('/', [
        'as' => 'setup_wizard.start',
        'uses' => 'MarvinLabs\SetupWizard\Controllers\WizardController@showStep'
    ]);

    // Show a step for a wizard
    Route::get('{slug?}', [
        'as' => 'setup_wizard.show',
        'uses' => 'MarvinLabs\SetupWizard\Controllers\WizardController@showStep'
    ])->where('slug', '([a-zA-Z0-9\-])*');

    // Show a step for a wizard
    Route::post('{slug?}', [
        'as' => 'setup_wizard.next',
        'uses' => 'MarvinLabs\SetupWizard\Controllers\WizardController@nextStep'
    ])->where('slug', '([a-zA-Z0-9\-])*');

    // Show a step for a wizard
    Route::post('{slug?}', [
        'as' => 'setup_wizard.previous',
        'uses' => 'MarvinLabs\SetupWizard\Controllers\WizardController@previousStep'
    ])->where('slug', '([a-zA-Z0-9\-])*');
});