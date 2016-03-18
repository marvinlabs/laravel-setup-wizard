<?php

namespace MarvinLabs\SetupWizard\Steps;

class FoldersStep extends BaseStep
{
    public function __construct($id)
    {
        parent::__construct($id);
    }

    public function getFormData()
    {
        $formData = ['folders' => []];

        // App folders
        $folders = $this->getFolders();
        foreach ($folders as $path => $perm) {
            if ($this->checkFolderPermission($path, $perm)) {
                $formData['folders'][] = [
                    'label' => trans('setup_wizard::steps.folders.view.granted', ['path' => $path, 'perm' => $perm]),
                    'check' => true,
                ];
            } else {
                $formData['folders'][] = [
                    'label' => trans('setup_wizard::steps.folders.view.missing', [
                        'path' => $path,
                        'perm' => $perm,
                        'perm_actual' => $this->getPermission($path)
                    ]),
                    'check' => false,
                ];
            }
        }

        return $formData;
    }

    public function apply($formData)
    {
        // App folders
        $folders = $this->getFolders();
        foreach ($folders as $path => $perm) {
            if (!$this->checkFolderPermission($path, $perm)) return false;
        }

        return true;
    }

    public function undo()
    {
        return true;
    }

    protected function getFolders()
    {
        return config('setup_wizard.folder_permissions');
    }

    protected function checkFolderPermission($path, $perm)
    {
        return $this->getPermission($path) >= $perm;
    }

    /**
     * Get a folder permission.
     *
     * @param $folder
     *
     * @return string
     */
    private function getPermission($folder)
    {
        return substr(sprintf('%o', fileperms(base_path($folder))), -3);
    }

}