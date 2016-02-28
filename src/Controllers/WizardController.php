<?php

namespace MarvinLabs\SetupWizard\Controllers;

class WizardController extends BaseController
{

    /**
     * @param string $slug
     *
     * @return string
     */
    public function showStep($slug = '')
    {
        return 'SLUG: ' . $slug;
    }

}
