<?php

/** @var \Config $config */

Route::group([
    'prefix' => $config->get('setup_wizard.routing.prefix')
], function() {

    // Show a step for a wizard
    Route::post('{slug?}', [
        'uses' => 'MarvinLabs\SetupWizard\Controllers\WizardController@showStep'
    ])->where('slug', '([a-zA-Z0-9\-])*');

    // Show a step for a wizard
    Route::get('{slug?}', [
        'uses' => 'MarvinLabs\SetupWizard\Controllers\WizardController@showStep'
    ])->where('slug', '([a-zA-Z0-9\-])*');
});