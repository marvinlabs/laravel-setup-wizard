<?php

namespace MarvinLabs\SetupWizard\Contracts;

use Illuminate\Contracts\Support\MessageProvider;

/**
 * Interface WizardStep
 *
 * Implement that interface to describe your wizard steps
 *
 * @package MarvinLabs\SetupWizard\Contracts
 */
interface WizardStep extends MessageProvider
{

    function __construct($id);

    /**
     * @return string The unique identifier for the step
     */
    function getId();

    /**
     * @return string The slug shown in the URL when viewing that wizard step
     */
    function getSlug();

    /**
     * @return array The initial form data to be used to populate the step fields
     */
    function getFormData();

    /**
     * @param array $formData An array containing all the form data for that step
     *
     * @return boolean true if the step has been applied successfully
     */
    function apply($formData);

    /**
     * @return boolean true if the step has been undone successfully
     */
    function undo();
}