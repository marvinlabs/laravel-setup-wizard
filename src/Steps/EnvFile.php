<?php

Route::group('setup', function() {
    Route::get('', [
        'uses' => 'MarvinLabs\SetupWizard\Controllers\WizardController@showStep'
    ]);
});