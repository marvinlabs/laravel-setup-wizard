<?php

namespace MarvinLabs\SetupWizard\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use MarvinLabs\SetupWizard\Exceptions\StepNotFoundException;
use MarvinLabs\SetupWizard\Facades\SetupWizard;

class WizardController extends BaseWizardController
{

    /**
     * WizardController constructor.
     *
     * @param SetupWizard $wizard
     */
    public function __construct(SetupWizard $wizard)
    {
        parent::__construct($wizard);

        // Our methods all use the middleware to setup the wizard (find current step, etc.)
        $this->middleware('setup_wizard.initializer');
    }

    /**
     * Show the form to setup the current step
     *
     * @return Response
     */
    public function showStep()
    {
        return view()->make('setup_wizard::steps.default');
    }

    /**
     * Apply current step and move on to next step
     *
     * @param Request $request
     *
     * @return Response
     */
    public function nextStep(Request $request)
    {
        // Apply the current step. If success, we can redirect to next one
        $currentStep = \SetupWizard::currentStep();
        if (!$currentStep->apply($request->all())) {
            return redirect()->back()->withErrors($currentStep);
        }

        // If we have a next step, go for it. Else we redirect to somewhere else
        try {
            $nextStep = \SetupWizard::nextStep();

            return redirect()->route('setup_wizard.showStep', ['slug' => $nextStep->getSlug()]);
        } catch (StepNotFoundException $e) {
            $finalRouteName = config('setup_wizard.routing.success_route', '');
            if (!empty($finalRouteName)) return redirect()->route($finalRouteName);

            $finalRouteUrl = config('setup_wizard.routing.success_url', '');
            if (!empty($finalRouteUrl)) return redirect()->to($finalRouteUrl);

            return redirect('/');
        }
    }

    public function previousStep(Request $request)
    {
        $currentStep = \SetupWizard::currentStep();

        // Undo the previous step. If success, we can redirect to its form

    }
}
