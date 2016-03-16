<?php

namespace MarvinLabs\SetupWizard\Steps;

class DatabaseStep extends BaseStep
{

    /**
     * BaseStep constructor.
     *
     * @param string $id The unique identifier for the step
     */
    public function __construct($id)
    {
        parent::__construct($id);
    }

    function apply($formData)
    {
    }

    function undo()
    {
    }
}