<?php

namespace MarvinLabs\SetupWizard\Steps;

class EnvFileStep extends BaseStep
{
    public function __construct($id)
    {
        parent::__construct($id);
    }

    public function getFormData()
    {
        $sampleContent = $this->readSampleEnvFile();

        // By default we set debug to false and we generate an application key
        \Artisan::call('key:generate', ['--show' => true]);
        $key = str_replace('"', '', \Artisan::output());
        $key = str_replace("\n", '', $key);

        $sampleContent = str_replace('APP_KEY=SomeRandomString', 'APP_KEY=' . $key, $sampleContent);
        $sampleContent = str_replace('APP_DEBUG=true', 'APP_DEBUG=false', $sampleContent);

        return [
            'sampleContent' => $sampleContent,
        ];
    }

    public function apply($formData)
    {
        // Validate form data
        $v = $this->getValidator($formData);
        if ($v->fails()) {
            $this->mergeErrors($v->errors());

            return false;
        }

        // Proceed with file creation
        $envFilePath = base_path('.env');
        if (false === file_put_contents($envFilePath, $formData['file_content'])) {
            $this->addError('env.errors.cannot_write_file', trans('setup_wizard::steps.env.errors.cannot_write_file'));

            return false;
        }

        // Delete any old backup if any
        $backupFile = base_path('.env.backup');
        if (file_exists($backupFile)) {
            unlink($backupFile);
        }

        return true;
    }

    public function undo()
    {
        $envFile = base_path('.env');
        if (file_exists($envFile)) {
            $backupFile = base_path('.env.backup');
            if (false === rename($envFile, $backupFile)) {
                $this->errors->add('env.errors.cannot_backup_file', trans('setup_wizard::steps.env.errors.cannot_backup_file'));

                return true;
            }
        }

        return true;
    }

    /**
     * @return string
     */
    protected function readSampleEnvFile()
    {
        $files = ['.env', '.env.backup', '.env.example'];
        foreach ($files as $f) {
            $f = base_path($f);
            if (file_exists($f)) {
                $sampleContent = file_get_contents($f);

                return $sampleContent;
            }
        }

        return '';
    }

    /**
     * @param $formData
     *
     * @return \Illuminate\Validation\Validator
     */
    protected function getValidator($formData)
    {
        return \Validator::make($formData, [
            'file_content' => 'required',
        ]);
    }
}