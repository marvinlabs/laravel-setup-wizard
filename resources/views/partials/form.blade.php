<div class="panel panel-default">
    <div class="panel-heading">
        <h2 class="panel-title">@yield('step.title', \SetupWizard::currentStep()->getTitle())</h2>
    </div>
    <div class="panel-body">
        @section('step.form')
            @include(\SetupWizard::currentStep()->getFormPartial(), \SetupWizard::currentStep()->getFormData())
        @show
    </div>
</div>