<?php

namespace MarvinLabs\SetupWizard\Steps;

class FinalStep extends BaseStep
{
    public function __construct($id)
    {
        parent::__construct($id);
    }

    function apply($formData)
    {
        return true;
    }

    function undo()
    {
        return true;
    }
}