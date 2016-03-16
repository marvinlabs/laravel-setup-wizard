<?php

namespace MarvinLabs\SetupWizard\Contracts;
use Illuminate\Contracts\Support\MessageProvider;
use Illuminate\Http\Request;

/**
 * Interface WizardStep
 *
 * Implement that interface to describe your wizard steps
 *
 * @package MarvinLabs\SetupWizard\Contracts
 */
interface WizardStep extends MessageProvider {

    function __construct($id);

    function getId();

    function getSlug();

    function getTitle();

    function getShortTitle();

    function getFormPartial();

    function getFormData();

    /**
     * @param array $formData An array containing all the form data for that step
     *
     * @return boolean true if the step has been applied successfully
     */
    function apply($formData);

    /**
     * @param array $formData An array containing all the form data for that step
     *
     * @return boolean true if the step has been undone successfully
     */
    function undo($formData);
}