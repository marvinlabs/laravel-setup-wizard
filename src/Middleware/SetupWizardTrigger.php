<?php

namespace MarvinLabs\SetupWizard\Middleware;

use Closure;
use MarvinLabs\SetupWizard\Contracts\WizardTrigger;

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
        // Get triggers from configuration and redirect to wizard if any of them fires
        $triggerClasses = \Config::get('setup_wizard.triggers');
        foreach ($triggerClasses as $tc) {
            /** @var WizardTrigger $trigger */
            $trigger = new $tc();
            if ($trigger->shouldLaunchWizard()) return $this->redirectToWizard();
        }

        return $next($request);
    }

    /**
     * Redirects to the wizard's first step
     */
    protected function redirectToWizard() {
        return redirect()->route('setup_wizard.start');
    }
}