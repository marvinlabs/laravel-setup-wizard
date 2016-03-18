<?php

namespace MarvinLabs\SetupWizard\Steps;

class RequirementsStep extends BaseStep
{
    public function __construct($id)
    {
        parent::__construct($id);
    }

    public function getFormData()
    {
        $formData = ['requirements' => []];

        // PHP version
        $requiredPhpVersion = $this->getRequiredPhpVersion();
        $formData['requirements'][] = [
            'label' => trans('setup_wizard::steps.requirements.view.php_version', ['ver' => $requiredPhpVersion]),
            'check' => $this->checkPhpVersion($requiredPhpVersion),
        ];

        // PHP extensions
        $requiredPhpExtensions = $this->getRequiredPhpExtensions();
        foreach ($requiredPhpExtensions as $ext) {
            $formData['requirements'][] = [
                'label' => trans('setup_wizard::steps.requirements.view.php_extension', ['name' => $ext]),
                'check' => $this->checkPhpExtensionEnabled($ext),
            ];
        }

        return $formData;
    }

    public function apply($formData)
    {
        // PHP version
        $requiredPhpVersion = $this->getRequiredPhpVersion();
        if (!$this->checkPhpVersion($requiredPhpVersion)) return false;

        // PHP extensions
        $requiredPhpExtensions = $this->getRequiredPhpExtensions();
        foreach ($requiredPhpExtensions as $ext) {
            if (!$this->checkPhpExtensionEnabled($ext)) return false;
        }

        return true;
    }

    public function undo()
    {
        return true;
    }

    protected function getRequiredPhpVersion()
    {
        return config('setup_wizard.requirements.php_version');
    }

    protected function checkPhpVersion($requiredPhpVersion)
    {
        $currentPhpVersion = phpversion();

        return version_compare($requiredPhpVersion, $currentPhpVersion, '<=');
    }

    protected function getRequiredPhpExtensions()
    {
        return config('setup_wizard.requirements.php_extensions');
    }

    protected function checkPhpExtensionEnabled($ext)
    {
        return extension_loaded($ext);
    }

}