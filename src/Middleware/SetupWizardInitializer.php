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
        $currentStepSlug = $request->route()->getParameter('slug', '');

        \SetupWizard::initialize($currentStepSlug);

        return $next($request);
    }
}