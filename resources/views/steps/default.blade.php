@extends('setup_wizard::layouts.wizard')

@section('page.title')
    {{ trans('setup_wizard::steps.' . $currentStep->getId() . '.title') }}
@endsection

@section('wizard.title')
    {!! trans('setup_wizard::steps.' . $currentStep->getId() . '.title') !!}
@endsection

@section('wizard.breadcrumb')
    @include('setup_wizard::partials.breadcrumb')
@endsection

@section('wizard.form')
    @include('setup_wizard::partials.steps.' . $currentStep->getId(), $currentStep->getFormData())
@endsection

@section('wizard.navigation')
    @include('setup_wizard::partials.navigation')
@endsection
