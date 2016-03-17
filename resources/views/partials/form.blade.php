<div class="panel panel-default">
    <div class="panel-body">
        @section('step.form')
            @include($currentStep->getFormPartial(), $currentStep->getFormData())
        @show
    </div>
</div>