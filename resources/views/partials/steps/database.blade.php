<div class="checkbox">
    <label>
        {!!   Form::checkbox('enable_seeding', 1, false, [
        ]) !!}
        {!! trans('setup_wizard::steps.database.view.enable_seeding') !!}
    </label>
</div>