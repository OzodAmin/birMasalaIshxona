@section('css')
    <link rel="stylesheet" href="{{ asset('datePicker/css/bootstrap-datepicker3.css') }}">
@endsection

<div class="nav-tabs-custom col-sm-12">
    <div class="form-group col-sm-4">
        {!! Form::label('docNomer', 'Документ') !!}
        {{ Form::text('docNomer', isset($payment) ? $payment->docNomer : null, ['class' => 'form-control', 'required' => 'required']) }}
    </div>
    <div class="form-group col-sm-4">
        {!! Form::label('date', 'От даты') !!}
        {{ Form::text('date', isset($payment) ? $payment->date : null, ['class' => 'form-control', 'id' => 'datePicker', 'required' => 'required']) }}
    </div>
    <div class="form-group col-sm-4">
        {!! Form::label('rkpPayType', 'Вид платежа') !!}
        {!! Form::select('rkpPayType', $payTypeArray, null, ['class' => 'form-control']) !!}
    </div>

    <div class="clearfix"></div>

    <div class="form-group col-sm-4">
        {!! Form::label('summa', 'Сумма платежа') !!}
        {{ Form::text('summa', isset($payment) ? $payment->summa : null, ['class' => 'form-control', 'onkeypress' => 'return validateFloatKeyPress(this,event);', 'required' => 'required']) }}
    </div>
    <div class="form-group col-sm-4">
        {!! Form::label('currency_id', 'Валюта') !!}
        {!! Form::select('currency_id', $currencyArray, null, ['class' => 'form-control']) !!}
    </div>

    <div class="clearfix"></div>

    <div class="form-group col-sm-12">
        {!! Form::label('reason', 'Детали платежа') !!}
        {{ Form::textArea('reason', isset($payment) ? $payment->reason : null, ['class' => 'form-control', 'rows' => 2, 'required' => 'required']) }}
    </div>

    <div class="clearfix"></div>

    <?php if (isset($rkp)) {
    	$sendClientName = $rkp->user->company_legal_name;
    	$sendRkpAccountID = $rkp->id;
    	$sendClientBank = $rkp->bank_name;
    	$sendClientBankAccount = $rkp->bank_account;
    	$sendClientInp = $rkp->inp;
    	$sendClientBankCode = $rkp->bank_code;
    	$sendClientId = $rkp->user->id;
    }else if (isset($payment)){
    	$sendClientName = $payment->userSend->company_legal_name;
    	$sendRkpAccountID = $payment->sendRkpAccount_ID;
    	$sendClientBank = $payment->userSendAccount->bank_name;
    	$sendClientBankAccount = $payment->userSendAccount->bank_account;
    	$sendClientInp = $payment->userSendAccount->inp;
    	$sendClientBankCode = $payment->userSendAccount->bank_code;
    	$sendClientId = $payment->sendClient_ID;
    } ?>

	<div class="form-group col-sm-12">
        {!! Form::label('sendClientName', 'Отправитель') !!}
        {{ Form::text('sendClientName', isset($sendClientName) ? $sendClientName : null, ['class' => 'form-control']) }}
        {{ Form::hidden('sendClient_ID', isset($sendClientId) ? $sendClientId : null) }}
        {{ Form::hidden('sendRkpAccount_ID', isset($sendRkpAccountID) ? $sendRkpAccountID : null) }}
    </div>
    <div class="form-group col-sm-12">
        {!! Form::label('sendClientBank', 'Банк') !!}
        {{ Form::text('sendClientBank', isset($sendClientBank) ? $sendClientBank : null, ['class' => 'form-control']) }}
    </div>
    <div class="form-group col-sm-8">
        {!! Form::label('sendClientBankAccount', 'Счет') !!}
        {{ Form::text('sendClientBankAccount', isset($sendClientBankAccount) ? $sendClientBankAccount : null, ['class' => 'form-control']) }}
    </div>
    <div class="form-group col-sm-4">
        {!! Form::label('sendClientBankCode', 'Код банка') !!}
        {{ Form::text('sendClientBankCode', isset($sendClientBankCode) ? $sendClientBankCode : null, ['class' => 'form-control']) }}
    </div>

    <div class="clearfix"></div>

    <div class="form-group col-sm-8">
        {!! Form::label('rkp_accounts_id', 'Получатель') !!}
        {!! Form::select('rkp_accounts_id', $rkpAccountsArray, null, ['class' => 'form-control']) !!}
    </div>
    <div class="form-group col-sm-4">
        {!! Form::label('sendClientInp', 'ИНП') !!}
        {{ Form::text('sendClientInp', isset($sendClientInp) ? $sendClientInp : null, ['class' => 'form-control']) }}
    </div>

    <div class="form-group col-sm-12">
        {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
        <a href="{!! route('payments.index') !!}" class="btn btn-default">Cancel</a>
    </div>
</div>

@section('scripts')
	<script src="{{ asset('datePicker/js/bootstrap-datepicker.js') }}"></script>
	<script src="{{ asset('datePicker/locales/bootstrap-datepicker.ru.min.js') }}"></script>
	<script type="text/javascript">
		function validateFloatKeyPress(el, evt) {

		    var charCode = (evt.which) ? evt.which : event.keyCode;
		    var number = el.value.split('.');
		    console.log(number);
		    if (charCode != 46 && charCode > 31 && (charCode < 48 || charCode > 57)) {
		        return false;
		    }
		    //just one dot
		    if(number.length>1 && charCode == 46){
		         return false;
		    }
		    //get the carat position
		    var caratPos = getSelectionStart(el);
		    var dotPos = el.value.indexOf(".");
		    if( caratPos > dotPos && dotPos>-1 && (number[1].length > 1)){
		        return false;
		    }
		    return true;
		}

		function getSelectionStart(o) {
			if (o.createTextRange) {
				var r = document.selection.createRange().duplicate()
				r.moveEnd('character', o.value.length)
				if (r.text == '') return o.value.length
				return o.value.lastIndexOf(r.text)
			} else return o.selectionStart
		}

		$('#datePicker').datepicker({
		    format: "yyyy-mm-dd",
		    weekStart: 1,
		    todayHighlight: true,
		    clearBtn: true,
		    autoclose: true,
		    language: "ru"
		});
		@empty($payment)
			$("#datePicker").datepicker('setDate', new Date());
		@endempty
	</script>
@endsection