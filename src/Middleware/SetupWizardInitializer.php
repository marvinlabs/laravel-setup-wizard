<?php

namespace MarvinLabs\SetupWizard\Middleware;

use Closure;

/**
 * Class SetupWizardInitializer
 *
 * @package MarvinLabs\SetupWizard\Middleware
 */
class SetupWizardInitializer
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure                 $next
     * @param  string|null              $guard
     *
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        // Get the current step from the route slug
        $currentStepSlug = $request->route()->getParameter('slug', '');
        \SetupWizard::initialize($currentStepSlug);

        // Share common data with our views
        view()->share('currentStep', \SetupWizard::currentStep());
        view()->share('allSteps', \SetupWizard::steps());

        // Proceed as usual
        return $next($request);
    }
}