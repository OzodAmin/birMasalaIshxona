@section('css')
    <link rel="stylesheet" href="{{ asset('datePicker/css/bootstrap-datepicker3.css') }}">
@endsection
<div class="nav-tabs-custom col-sm-12">
    <div class="form-group col-sm-12">
        {!! Form::label('name', 'Ф.И.О:') !!}
        {{ Form::text('name', isset($user) ? $user->name : null, ['class' => 'form-control']) }}
    </div>

    <div class="clearfix"></div>

    <div class="form-group col-sm-12">
        {!! Form::label('company_legal_name', 'Наименование организации') !!}
        {{ Form::text('company_legal_name', isset($user) ? $user->company_legal_name : null, ['class' => 'form-control']) }}
    </div>
        
    <div class="clearfix"></div>

    <div class="form-group col-sm-12">
        {!! Form::label('address', 'Юридический адрес') !!}
        {{ Form::text('address', isset($user) ? $user->address : null, ['class' => 'form-control']) }}
    </div>

    <div class="clearfix"></div>

    <div class="form-group col-sm-4">
        {!! Form::label('email', 'Email') !!}
        {{ Form::text('email', isset($user) ? $user->email : null, ['class' => 'form-control']) }}
    </div>

    <div class="form-group col-sm-4">
        {!! Form::label('inn', 'ИНН') !!}
        {{ Form::text('inn', isset($user) ? $user->inn : null, ['class' => 'form-control']) }}
    </div>

    <div class="form-group col-sm-4">
        {!! Form::label('phone', 'Phone number (xx) xxx-xxxx') !!}
        {{ Form::text('phone', isset($user) ? $user->phone : null, ['class' => 'form-control']) }}
    </div>

    <div class="clearfix"></div>

    <div class="form-group col-sm-4">
        {!! Form::label('status', 'Статус') !!}
        {!! Form::select('status', $statusArray, null, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group col-sm-4">
        {!! Form::label('username', 'Логин для входа в систему') !!}
        {{ Form::text('username', isset($user) ? $user->username : null, ['class' => 'form-control']) }}
    </div>

    <div class="clearfix"></div>

    <div class="form-group col-sm-6">
        {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
        <a href="{!! route('users.index') !!}" class="btn btn-default">Cancel</a>
    </div>
    
</div>

@section('scripts')
    <script src="{{ asset('datePicker/js/bootstrap-datepicker.js') }}"></script>
    <script src="{{ asset('datePicker/locales/bootstrap-datepicker.ru.min.js') }}"></script>
    <script type="text/javascript">
        const isNumericInput = (event) => {
            const key = event.keyCode;
            return ((key >= 48 && key <= 57) || (key >= 96 && key <= 105));   
        };

        const isModifierKey = (event) => {
            const key = event.keyCode;
            return (event.shiftKey === true || key === 35 || key === 36) || // Allow Shift, Home, End
                (key === 8 || key === 9 || key === 13 || key === 46) || // Allow Backspace, Tab, Enter, Delete
                (key > 36 && key < 41) || // Allow left, up, right, down
                (
                    // Allow Ctrl/Command + A,C,V,X,Z
                    (event.ctrlKey === true || event.metaKey === true) &&
                    (key === 65 || key === 67 || key === 86 || key === 88 || key === 90)
                )
        };

        const enforceFormat = (event) => {
            if(!isNumericInput(event) && !isModifierKey(event)){
                event.preventDefault();
            }
        };

        const formatToPhone = (event) => {
            if(isModifierKey(event)) {return;}

            const target = event.target;
            const input = event.target.value.replace(/\D/g,'').substring(0,9);
            const zip = input.substring(0,2);
            const middle = input.substring(2,5);
            const last = input.substring(5,9);

            if(input.length > 5){target.value = `(${zip}) ${middle} - ${last}`;}
            else if(input.length > 2){target.value = `(${zip}) ${middle}`;}
            else if(input.length > 0){target.value = `(${zip}`;}
        };

        const phoneNumber = document.getElementById('phone');
        phoneNumber.addEventListener('keydown',enforceFormat);
        phoneNumber.addEventListener('keyup',formatToPhone);

        const mobilePhone = document.getElementById('mobile');
        mobilePhone.addEventListener('keydown',enforceFormat);
        mobilePhone.addEventListener('keyup',formatToPhone);

    </script>
@endsection