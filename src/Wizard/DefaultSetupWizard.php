<?php

namespace MarvinLabs\SetupWizard\Wizard;

use Illuminate\Contracts\Foundation\Application;
use MarvinLabs\SetupWizard\Contracts\SetupWizard;
use MarvinLabs\SetupWizard\Contracts\WizardStep;
use MarvinLabs\SetupWizard\Exceptions\StepNotFoundException;

class DefaultSetupWizard implements SetupWizard
{
    /** @var Application The Laravel application instance. */
    protected $app;

    /** @var array The steps of the wizard */
    protected $steps = null;

    /** @var WizardStep The step currently displayed to the user */
    protected $currentStep = null;

    /** @var int The index of the current step */
    protected $currentStepIndex = -1;

    /**
     * @param Application $app
     */
    public function __construct($app = null)
    {
        if (!$app) {
            $app = app();   //Fallback when $app is not given
        }
        $this->app = $app;
    }

    public function initialize($currentStepSlug)
    {
        try {
            $this->currentStep = $this->findStepBySlug($currentStepSlug);
            $this->currentStepIndex = $this->stepIndex($this->currentStep->getId());
        } catch (StepNotFoundException $e) {
            $this->currentStep = $this->firstStep();
            $this->currentStepIndex = 0;
        }
    }

    public function steps()
    {
        if ($this->steps == null) {
            $this->steps = $this->createStepsFromConfig();
        }

        return $this->steps;
    }

    public function firstStep()
    {
        $steps = $this->steps();

        return reset($steps);
    }

    public function stepIndex($stepId)
    {
        $steps = $this->steps();
        $i = 0;
        foreach ($steps as $id => $step) {
            if ($id == $stepId) return $i;
            ++$i;
        }
        throw new StepNotFoundException();
    }

    public function progress()
    {
        return 100 * $this->currentStepIndex / count($this->steps());
    }

    public function currentStep()
    {
        return $this->currentStep;
    }

    public function nextStep()
    {
        return $this->findStepByIndex($this->currentStepIndex + 1);
    }

    public function previousStep()
    {
        return $this->findStepByIndex($this->currentStepIndex - 1);
    }

    public function isCurrent($stepId)
    {
        return $this->currentStep->getId() == $stepId;
    }

    public function isFirst($stepId = null)
    {
        $i = $this->stepIndex($stepId == null ? $this->currentStep->getId() : $stepId);

        return $i == 0;
    }

    public function isLast($stepId = null)
    {
        $i = $this->stepIndex($stepId == null ? $this->currentStep->getId() : $stepId);

        return $i == count($this->steps()) - 1;
    }

    /**
     * Get configuration and create the step objects
     *
     * @return array The step objects, indexed by ID
     */
    protected function createStepsFromConfig()
    {
        $config = $this->app['config'];
        $stepClasses = $config->get('setup_wizard.steps');

        if (empty($stepClasses)) throw new \RuntimeException('The setup wizard requires at least 1 step in configuration');

        $steps = [];
        $i = 0;
        foreach ($stepClasses as $id => $stepClass) {
            $s = new $stepClass($id);
            $steps[$id] = $s;
            ++$i;
        }

        return $steps;
    }

    protected function findStepByIndex($index)
    {
        /** @var array $steps */
        $steps = $this->steps();

        if ($index < 0 || $index >= count($steps)) throw new StepNotFoundException();

        /** @var WizardStep $step */
        $i = 0;
        foreach ($steps as $id => $step) {
            if ($i == $index) return $step;
            ++$i;
        }

        throw new StepNotFoundException();
    }

    protected function findStepBySlug($slug = '')
    {
        /** @var array $steps */
        $steps = $this->steps();

        /** @var WizardStep $step */
        foreach ($steps as $id => $step) {
            if ($step->getSlug() == $slug) return $step;
        }

        throw new StepNotFoundException();
    }
}
