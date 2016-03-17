<ol class="sw-breadcrumb">
    @foreach($allSteps as $id => $step)
        @php($isCurrent = \SetupWizard::isCurrent($id))
        @php($cssClass = 'sw-step' . ($isCurrent ? ' sw-current' : ''))
        <li class="{{ $cssClass }}">
            {!! trans('setup_wizard::steps.' . $id . '.breadcrumb') !!}
        </li>
    @endforeach
</ol>