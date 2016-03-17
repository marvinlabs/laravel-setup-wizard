<?php

namespace MarvinLabs\SetupWizard\Steps;

class FinalStep extends BaseStep
{
    public function __construct($id)
    {
        parent::__construct($id);
    }

    function apply($formData)
    {
        // Create a file which means the wizard is completed
        $filePath = storage_path('.setup_wizard');
        $setupData = json_encode([
            'completed' => true,
            'version'   => '0.0.0',
        ], JSON_PRETTY_PRINT);

        if (false === file_put_contents($filePath, $setupData)) {
            $this->addError('cannot_write_file', trans('setup_wizard::steps.final.errors.cannot_write_file'));

            return false;
        }

        return true;
    }

    function undo()
    {
        return true;
    }
}