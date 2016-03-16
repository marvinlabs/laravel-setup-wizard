<div class="navigation">
    @unless (SetupWizard::isFirst())
        <a href="" class="btn btn-default">{{ trans('setup_wizard::views.nav.back') }}</a>
    @endunless

    @if (SetupWizard::isLast())
        <a href="" class="btn btn-primary">{{ trans('setup_wizard::views.nav.done') }}</a>
    @else
        <a href="" class="btn btn-primary">{{ trans('setup_wizard::views.nav.next') }}</a>
    @endif
</div>