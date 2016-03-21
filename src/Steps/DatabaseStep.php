<?php

namespace MarvinLabs\SetupWizard\Steps;

use Exception;

class DatabaseStep extends BaseStep
{
    public function __construct($id)
    {
        parent::__construct($id);
    }

    public function apply($formData)
    {
        try {
            if ($this->isChecked($formData, 'refresh_db')) {
                \Artisan::call('migrate:refresh');
            } else {
                \Artisan::call('migrate');
            }

            if ($this->isChecked($formData, 'enable_seeding')) {
                \Artisan::call('db:seed');
            }
        } catch (Exception $e) {
            $this->addError('exception', $e->getMessage());

            return false;
        }

        return true;
    }

    public function undo()
    {
        try {
            \Artisan::call('migrate:rollback');
        } catch (Exception $e) {
            $this->addError('exception', $e->getMessage());

            return false;
        }

        return true;
    }

    protected function isChecked($formData, $optionName) {
        return isset($formData[$optionName]) && $formData[$optionName] == 1;
    }
}