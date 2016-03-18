<?php

namespace MarvinLabs\SetupWizard\Triggers;

use MarvinLabs\SetupWizard\Contracts\WizardTrigger;

/**
 * Class EnvFileTrigger
 *
 * @package MarvinLabs\SetupWizard\Triggers
 *
 * Start the wizard if the application does not have yet an env file
 */
class EnvFileTrigger implements WizardTrigger
{

    /**
     * Indicates if the wizard should be launched or not
     *
     * @return boolean
     */
    function shouldLaunchWizard()
    {
        $envFilePath = base_path('.env');

        return !file_exists($envFilePath);
    }
}