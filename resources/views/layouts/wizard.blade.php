<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ trans('setup_wizard::views.default_title') }} &raquo; @yield('step.title', SetupWizard::currentStep()->getTitle())</title>

    <!-- Styles (using Bootstrap as default) -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
</head>
<body>
<div class="sw-wizard container">
    <div class="row">
        <div class="col-sm-12">
            {!! Form::open([
                'route' => ['setup_wizard.submit', \SetupWizard::currentStep()->getSlug()]  ,
                'files' => true,
            ]) !!}

            @section('wizard.breadcrumb')
                @include('setup_wizard::partials.breadcrumb')
            @show

            @section('wizard.form')
                @include('setup_wizard::partials.form')
            @show

            @section('wizard.navigation')
                @include('setup_wizard::partials.navigation')
            @show

            {!! Form::close() !!}
        </div>
    </div>
</div>
</body>
</html>