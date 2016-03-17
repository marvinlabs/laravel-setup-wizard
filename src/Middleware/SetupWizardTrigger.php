<?php

namespace MarvinLabs\SetupWizard\Middleware;

use Closure;
use MarvinLabs\SetupWizard\Triggers\TriggerHelper;

/**
 * Class SetupWizardTrigger
 *
 * @package MarvinLabs\SetupWizard\Middleware
 *
 *
 */
class SetupWizardTrigger
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
        if (TriggerHelper::shouldWizardBeTriggered()) return $this->redirectToWizard();

        return $next($request);
    }

    /**
     * Redirects to the wizard's first step
     */
    protected function redirectToWizard()
    {
        return redirect()->route('setup_wizard.start');
    }
}