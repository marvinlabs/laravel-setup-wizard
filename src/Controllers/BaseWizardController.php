<?php

namespace MarvinLabs\SetupWizard\Controllers;

use Illuminate\Routing\Controller;
use MarvinLabs\SetupWizard\Facades\SetupWizard;

class BaseWizardController extends Controller
{

    /** @var SetupWizard */
    protected $wizard;

    public function __construct(SetupWizard $wizard)
    {
        $this->wizard = $wizard;
    }
}