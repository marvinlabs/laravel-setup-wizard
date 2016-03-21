<div class="checkbox">
    <label>
        {!!   Form::checkbox('refresh_db', 1, true, [
        ]) !!}
        {!! trans('setup_wizard::steps.database.view.refresh_db') !!}
    </label>
</div>
<div class="checkbox">
    <label>
        {!!   Form::checkbox('enable_seeding', 1, false, [
        ]) !!}
        {!! trans('setup_wizard::steps.database.view.enable_seeding') !!}
    </label>
</div>