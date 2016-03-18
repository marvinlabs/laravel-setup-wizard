<?php

namespace MarvinLabs\SetupWizard\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use MarvinLabs\SetupWizard\Exceptions\StepNotFoundException;
use MarvinLabs\SetupWizard\Facades\SetupWizard;

class WizardController extends Controller
{
    /** @var SetupWizard */
    protected $wizard;

    /**
     * WizardController constructor.
     *
     * @param SetupWizard $wizard
     */
    public function __construct(SetupWizard $wizard)
    {
        $this->wizard = $wizard;

        // Our methods all use the middleware to setup the wizard (find current step, etc.)
        $this->middleware(['setup_wizard']);
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
     * Submit the wizard step currently shown with the specified action (next/back)
     *
     * @param Request $request
     *
     * @return Response
     */
    public function submitStep(Request $request)
    {
        if ($request->has('wizard-action-next')) {
            return $this->nextStep($request);
        }

        if ($request->has('wizard-action-back')) {
            return $this->previousStep($request);
        }

        throw new \RuntimeException('Unknown wizard action');
    }

    /**
     * Apply current step and move on to next step
     *
     * @param Request $request
     *
     * @return Response
     */
    protected function nextStep(Request $request)
    {
        // Apply the current step. If success, we can redirect to next one
        $currentStep = \SetupWizard::currentStep();
        if (!$currentStep->apply($request->all())) {
            return view()->make('setup_wizard::steps.default', ['errors' => $currentStep->getMessageBag()]);
        }

        // If we have a next step, go for it. Else we redirect to somewhere else
        try {
            $nextStep = \SetupWizard::nextStep();

            return redirect()->route('setup_wizard.show', ['slug' => $nextStep->getSlug()]);
        } catch (StepNotFoundException $e) {
            $finalRouteName = config('setup_wizard.routing.success_route', '');
            if (!empty($finalRouteName)) return redirect()->route($finalRouteName);

            $finalRouteUrl = config('setup_wizard.routing.success_url', '');
            if (!empty($finalRouteUrl)) return redirect()->to($finalRouteUrl);

            return redirect('/');
        }
    }

    protected function previousStep(Request $request)
    {
        try {
            // Undo the previous step. If success, we can redirect to its form
            $previousStep = \SetupWizard::previousStep();
            if (!$previousStep->undo()) {
                return view()->make('setup_wizard::steps.default', ['errors' => $previousStep->getMessageBag()]);
            }

            return redirect()->route('setup_wizard.show', ['slug' => $previousStep->getSlug()]);
        } catch (StepNotFoundException $e) {
            return redirect()->route('setup_wizard.show');
        }
    }
}
