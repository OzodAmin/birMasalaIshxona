<div class="row">
    <div class="col-xl-12">
        <div class="dashboard-box margin-top-0">
            <div class="content with-padding">
                <div class="row">

                    <div class="col-xl-12">
                        <div class="submit-field{{ $errors->has('bank_name') ? ' has-error' : '' }}">
                            <h5 class="control-label">Наименование банка</h5>
                            {{ Form::text('bank_name',
                                isset($rkp) ? $rkp->bank_name : null,
                                ['class' => 'with-border'])
                            }}
                            <span class="control-label">
                                <?php echo $errors->first('bank_name'); ?>
                            </span> 
                        </div>
                    </div>

                    <div class="clearfix"></div>

                    <div class="col-xl-4">
                        <div class="submit-field{{ $errors->has('currency_id') ? ' has-error' : '' }}">
                            <h5 class="control-label">Денежная единица</h5>
                            {!! Form::select('currency_id',
                                $currencyArray, 
                                null, 
                                [
                                    'class' => 'selectpicker with-border',
                                    'data-live-search' => 'true',
                                    'data-size' => '7',
                                    'title' => '-- SELECT --',
                                ]) !!}
                        </div>
                    </div>

                    <div class="col-xl-2">
                        <div class="submit-field{{ $errors->has('bank_code') ? ' has-error' : '' }}">
                            <h5 class="control-label">Код банка</h5>
                            {{ Form::text('bank_code',
                                isset($product) ? $product->bank_code : null,
                                [
                                    'class' => 'with-border',
                                    'onkeypress' => 'javascript:return isNumber(event)',
                                    'placeholder' => 'Код банка'
                                ])
                            }}
                        </div>
                    </div>

                    <div class="col-xl-6">
                        <div class="submit-field{{ $errors->has('bank_code') ? ' has-error' : '' }}">
                            <h5 class="control-label">Расчетный счет</h5>
                            {{ Form::text('bank_account',
                                isset($product) ? $product->bank_account : null,
                                [
                                    'class' => 'with-border',
                                    'onkeypress' => 'javascript:return isNumber(event)',
                                    'placeholder' => 'Расчетный счет'
                                ])
                            }}
                        </div>
                    </div>                            

                    <div class="clearfix"></div>

                    <div class="col-xl-12">
                        <div class="submit-field{{ $errors->has('conditions') ? ' has-error' : '' }}">
                            <div class="uploadButton margin-top-30">

                                <?php if( isset($product) && $product->featured_image ): ?>
                                    {{ Html::image('uploads/product/admin_'.$product->featured_image, false) }}
                                <?php endif; ?>

                                {!! Form::file('featured_image', 
                                    [
                                        'class' => 'uploadButton-input',
                                        'accept' => 'image/*',
                                        'id' => 'featured_image'
                                    ]) 
                                !!}
                                <label class="uploadButton-button ripple-effect" for="featured_image">Документ</label>
                                <span class="uploadButton-file-name">Image that might be helpful in describing your product</span><br>
                                <p class="error-text">
                                    <?php echo $errors->first('featured_image'); ?>
                                </p> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-12">
        {!! Form::submit('Добавить',['class' => 'button ripple-effect big margin-top-30', 'onClick' => 'checkform();'])!!}
    </div>
</div>

@section('scripts')

<script>
function isNumber(evt) {
    var iKeyCode = (evt.which) ? evt.which : evt.keyCode
    if (iKeyCode != 46 && iKeyCode > 31 && (iKeyCode < 48 || iKeyCode > 57))
        return false;

    return true;
}
</script>
@endsection