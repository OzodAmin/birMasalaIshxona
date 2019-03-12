@section('css')
<link rel="stylesheet" href="{{ asset('datePicker/css/bootstrap-datepicker3.css') }}">
@endsection

<div class="nav-tabs-custom col-xs-12">

    <div class="form-group col-sm-6">
        {!! Form::label('holiday', 'Дата:') !!}
        {{ Form::text(
            'holiday',
            isset($basis) ? $holiday->holiday : null,
            [
                'class' => 'form-control',
                'id' => 'datePicker'
            ])
        }}
    </div>

    <!-- Submit Field -->
    <div class="form-group col-sm-12">
        {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
        <a href="{!! route('holidays.index') !!}" class="btn btn-default">Cancel</a>
    </div>
</div>

@section('scripts')
<script src="{{ asset('datePicker/js/bootstrap-datepicker.js') }}"></script>
<script src="{{ asset('datePicker/locales/bootstrap-datepicker.ru.min.js') }}"></script>
<script type="text/javascript">
    $('#datePicker').datepicker({
        format: "yyyy-mm-dd",
        weekStart: 1,
        clearBtn: true,
        autoclose: true,
        language: "ru"
    });
</script>
@endsection