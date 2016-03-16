<?php

namespace MarvinLabs\SetupWizard\Steps;

class DatabaseStep extends BaseStep {

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

    function apply()
    {
    }

    function undo()
    {
    }
}