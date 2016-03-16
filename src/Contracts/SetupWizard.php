<?php
/**
 * Created by PhpStorm.
 * User: Vincent
 * Date: 16/03/2016
 * Time: 10:13
 */
namespace MarvinLabs\SetupWizard\Contracts;
use MarvinLabs\SetupWizard\Exceptions\StepNotFoundException;


/**
 * All you ever needed to manage the wizard
 */
interface SetupWizard
{
    /**
     * Initialize the wizard for the current request. Sets the current step, etc.
     *
     * @param $currentStepSlug
     */
    public function initialize($currentStepSlug);

    /**
     * Get the steps which
     *
     * @return array The step objects
     */
    public function steps();

    /**
     * @return WizardStep The first step of the wizard
     */
    public function firstStep();

    /**
     *
     * @param string $stepId The ID of the step
     *
     * @return int The step order number (0 is the first step)
     * @throws StepNotFoundException If no step with that ID is found
     */
    public function stepIndex($stepId);

    /**
     * @return WizardStep The current step
     */
    public function currentStep();

    /**
     * @return WizardStep The previous step
     */
    public function previousStep();

    /**
     * @return WizardStep The next step
     */
    public function nextStep();

    /**
     * Check if the step ID corresponds to the current step
     *
     * @param string $stepId The ID of the step
     *
     * @return bool true if the step is the current one
     */
    public function isCurrent($stepId);

    /**
     * If the step the first one of the wizard
     *
     * @param string $stepId The ID of the step, or null to target the current step
     *
     * @return bool true if the step is the first
     * @throws StepNotFoundException If no step with that ID is found
     */
    public function isFirst($stepId = null);

    /**
     * If the step the first one of the wizard
     *
     * @param string $stepId The ID of the step, or null to target the current step
     *
     * @return bool true if the step is the last
     * @throws StepNotFoundException If no step with that ID is found
     */
    public function isLast($stepId = null);
}