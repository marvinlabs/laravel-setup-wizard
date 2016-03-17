<?php

namespace MarvinLabs\SetupWizard\Steps;

use Exception;

class DatabaseStep extends BaseStep
{
    public function __construct($id)
    {
        parent::__construct($id);
    }

    function apply($formData)
    {
        try {
            \Artisan::call('migrate');

            if (isset($formData['enable_seeding']) && $formData['enable_seeding'] == 1) {
                \Artisan::call('db:seed');
            }
        } catch (Exception $e) {
            $this->addError('exception', $e->getMessage());

            return false;
        }

        return true;
    }

    function undo()
    {
        try {
            \Artisan::call('migrate:rollback');
        } catch (Exception $e) {
            $this->addError('exception', $e->getMessage());

            return false;
        }

        return true;
    }
}