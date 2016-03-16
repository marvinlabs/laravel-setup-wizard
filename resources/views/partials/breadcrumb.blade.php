<ul class="nav nav-pills nav-justified sw-breadcrumb">
@foreach(\SetupWizard::steps() as $id => $step)
    <li class="sw-step @if (\SetupWizard::isCurrent($id)) active sw-current @endif">
        <a href="#">{{ $step->getTitle() }}</a>
    </li>
@endforeach
</ul>

@php($progress = \SetupWizard::progress())

<div class="progress">
    <div class="progress-bar" role="progressbar" aria-valuenow="{{ $progress }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $progress }}%;">
        <span class="sr-only">{{ $progress }}%</span>
    </div>
</div>
