@extends('dashboard.layouts.app')

@section('title')
    Редактировать профиль
@endsection

@section('content')
<div class="dashboard-headline">
    <h2>{{ $user->name }}</h2>
    <span>
        @foreach($user->roles as $role)
            {{ $role->display_name }}
        @endforeach
    </span>

    <nav id="breadcrumbs" class="dark">
        <ul>
            <li>
                <a href="{{ url('dashboard') }}">
                    Профиль
                </a>
            </li>
            <li>
                <a href="{{ url('profile') }}">
                    Мой профиль
                </a>
            </li>
            <li>Редактировать профиль</li>
        </ul>
    </nav>
</div>

<form method="post">
    <div class="row">
{{ csrf_field() }}
        <div class="col-xl-12">
            <div class="submit-field{{ $errors->has('company_legal_name') ? ' has-error' : '' }}">
                <h5 class="control-label">Наименование организации</h5>

                <input type="text" class="input-text with-border" name="company_legal_name" value="{{ $user->company_legal_name }}" required/>

                <span class="control-label">
                    <?php echo $errors->first('company_legal_name'); ?>
                </span> 
            </div>
        </div>

        <div class="col-xl-12" title="Фамилия Имя Отчество" data-tippy-placement="bottom">
            <div class="submit-field{{ $errors->has('name') ? ' has-error' : '' }}">
                <h5 class="control-label">Ф.И.О уполномоченного лица</h5>

                <input type="text" class="input-text with-border" name="name" value="{{ $user->name }}" required/>

                <span class="control-label">
                    <?php echo $errors->first('name'); ?>
                </span> 
            </div>
        </div>

        <div class="col-xl-12" title="Юридический адрес" data-tippy-placement="bottom">
            <div class="submit-field{{ $errors->has('address') ? ' has-error' : '' }}">
                <h5 class="control-label">Почтовый адрес</h5>

                <input type="text" class="input-text with-border" name="address" value="{{ $user->address }}" required/>

                <span class="control-label">
                    <?php echo $errors->first('address'); ?>
                </span> 
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="col-xl-4"  title="ИНН должно быт шестизначное число" data-tippy-placement="bottom">
            <div class="submit-field{{ $errors->has('inn') ? ' has-error' : '' }}">
                <h5 class="control-label">ИНН</h5>

                <input type="text" class="input-text with-border" name="inn" value="{{ $user->inn }}" onkeypress="javascript:return isNumber(event)" required/>

                <span class="control-label">
                    <?php echo $errors->first('inn'); ?>
                </span> 
            </div>
        </div>

        <div class="col-xl-4" title="Aдрес электронной почты" data-tippy-placement="bottom">
            <div class="submit-field{{ $errors->has('email') ? ' has-error' : '' }}">
                <h5 class="control-label">E-mail</h5>

                <input type="text" class="input-text with-border" name="email" value="{{ $user->email }}" required/>

                <span class="control-label">
                    <?php echo $errors->first('email'); ?>
                </span> 
            </div>
        </div>

        <div class="col-xl-4"  title="Контактный номер (xx) xxx-xxxx" data-tippy-placement="bottom">
            <div class="submit-field{{ $errors->has('phone') ? ' has-error' : '' }}">
                <h5 class="control-label">Контактный номер</h5>

                <input type="tel" class="input-text with-border" id="phone" name="phone" placeholder="Телефон" value="{{ $user->phone }}" required/>

                <span class="control-label">
                    <?php echo $errors->first('phone'); ?>
                </span> 
            </div>
        </div>

        <div class="clearfix"></div>

        <!-- <div class="col-xl-4"  title="Общегосударственный Классификатор видов экономической деятельности Республики Узбекистан" data-tippy-placement="bottom">
            <div class="submit-field{{ $errors->has('inn') ? ' has-error' : '' }}">
                <h5 class="control-label">ОКЭД</h5>

                <input type="text" class="input-text with-border" name="inn" value="{{ $user->inn }}" onkeypress="javascript:return isNumber(event)" required/>

                <span class="control-label">
                    <?php echo $errors->first('inn'); ?>
                </span> 
            </div>
        </div>

        <div class="col-xl-4" title="Aдрес электронной почты" data-tippy-placement="bottom">
            <div class="submit-field{{ $errors->has('email') ? ' has-error' : '' }}">
                <h5 class="control-label">E-mail</h5>

                <input type="text" class="input-text with-border" name="email" value="{{ $user->email }}" required/>

                <span class="control-label">
                    <?php echo $errors->first('email'); ?>
                </span> 
            </div>
        </div>

        <div class="col-xl-4"  title="Контактный номер (xx) xxx-xxxx" data-tippy-placement="bottom">
            <div class="submit-field{{ $errors->has('phone') ? ' has-error' : '' }}">
                <h5 class="control-label">Контактный номер</h5>

                <input type="tel" class="input-text with-border" id="phone" name="phone" placeholder="Телефон" value="{{ $user->phone }}" required/>

                <span class="control-label">
                    <?php echo $errors->first('phone'); ?>
                </span> 
            </div>
        </div>

        <div class="clearfix"></div> -->

        <!-- Button -->
        <button class="button full-width button-sliding-icon ripple-effect margin-top-10" type="submit">Изменить персональные данные <i class="icon-material-outline-arrow-right-alt"></i></button>
    </div>
</form>

<div class="margin-top-70"></div>
@endsection
@section('scripts')
<script type="text/javascript">
    function isNumber(evt) {
        var iKeyCode = (evt.which) ? evt.which : evt.keyCode
        if (iKeyCode != 46 && iKeyCode > 31 && (iKeyCode < 48 || iKeyCode > 57))
            return false;

        return true;
    }

    const isNumericInput = (event) => {
    const key = event.keyCode;
        return ((key >= 48 && key <= 57) || // Allow number line
            (key >= 96 && key <= 105) // Allow number pad
        );
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
        // Input must be of a valid number format or a modifier key, and not longer than ten digits
        if(!isNumericInput(event) && !isModifierKey(event)){
            event.preventDefault();
        }
    };

    const formatToPhone = (event) => {
        if(isModifierKey(event)) {return;}
        const target = event.target;
        const input = event.target.value.replace(/\D/g,'').substring(0,9); // First ten digits of input only
        const zip = input.substring(0,2);
        const middle = input.substring(2,5);
        const last = input.substring(5,9);

        if(input.length > 5){target.value = `(${zip}) ${middle} - ${last}`;}
        else if(input.length > 2){target.value = `(${zip}) ${middle}`;}
        else if(input.length > 0){target.value = `(${zip}`;}
    };

    const inputElement = document.getElementById('phone');
    inputElement.addEventListener('keydown',enforceFormat);
    inputElement.addEventListener('keyup',formatToPhone);
</script>
@endsection