<?php

namespace MarvinLabs\SetupWizard\Steps;

class EnvFileStep extends BaseStep {

    /**
     * BaseStep constructor.
     *
     * @param string $id The unique identifier for the step
     * @param int    $stepIndex The index of this step in the wizard
     * @param int    $wizardStepCount The number of steps in the wizard
     */
    public function __construct($id, $stepIndex, $wizardStepCount)
    {
        parent::__construct($id, $stepIndex, $wizardStepCount);
    }

    public function getFormData()
    {
        $sampleContent = $this->readSampleEnvFile();

        return [
            'sampleContent' => $sampleContent
        ];
    }

    public function apply($request)
    {
        $envFilePath = dirname(app_path()) . '/.env';
        $fileContent  = $request->input('file_content');
        file_put_contents($envFilePath, $fileContent);
    }

    public function undo($request)
    {
    }

    /**
     * @return string
     */
    protected function readSampleEnvFile()
    {
        $sampleContent = '';
        $sampleFile = dirname(app_path()) . '/.env.example';
        if (file_exists($sampleFile)) {
            $sampleContent = file_get_contents($sampleFile);

            return $sampleContent;
        }

        return $sampleContent;
    }
}