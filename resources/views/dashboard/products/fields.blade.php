@section('css')
<link rel="stylesheet" href="{{ asset('datePicker/css/bootstrap-datepicker3.css') }}">
@endsection

<div class="row">
    <div class="col-xl-12">
        <div class="dashboard-box margin-top-0">
            <div class="content with-padding">
                <div class="row">

                    <div class="col-xl-12">
                        <div class="submit-field{{ $errors->has('name') ? ' has-error' : '' }}">
                            <h5 class="control-label">Наименование товара</h5>
                            {{ Form::text('name',
                                isset($product) ? $product->title : null,
                                ['class' => 'with-border'])
                            }}
                            <span class="control-label">
                                <?php echo $errors->first('name'); ?>
                            </span> 
                        </div>
                    </div>

                    <div class="clearfix"></div>

                    <div class="col-xl-3">
                        <div class="submit-field{{ $errors->has('tnved') ? ' has-error' : '' }}">
                            <h5 class="control-label">Код ТН ВЭД</h5>
                            {{ Form::text('tnved',
                                isset($product) ? $product->tnved : null,
                                ['class' => 'with-border'])
                            }}
                        </div>
                    </div>

                    <div class="col-xl-3">
                        <div class="submit-field">
                            <h5 class="control-label">Размер задатка</h5>
                            <div class="input-with-icon">
                                <div id="autocomplete-container">
                                    <input class="with-border" type="text" value="3" name='deposit' disabled>
                                </div>
                                <i class="icon-feather-percent"></i>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3">
                        <div class="submit-field{{ $errors->has('parent_category_id') ? ' has-error' : '' }}">
                            <h5 class="control-label">Основная категория</h5>
                            {!! Form::select('parent_category_id', 
                                $categoriesArray, 
                                null, 
                                [
                                    'class' => 'selectpicker with-border',
                                    'id' => 'categoryId',
                                    'data-live-search' => 'true',
                                    'data-size' => '7',
                                    'title' => '-- SELECT --',
                                ]) !!}
                        </div>
                    </div>

                    <div class="col-xl-3">
                        <div class="submit-field{{ $errors->has('child_category_id') ? ' has-error' : '' }}">
                            <h5 class="control-label">Под категория</h5>
                            <select id="childCategoryId" class="with-border" name="child_category_id"></select>
                        </div>
                    </div>

                    <div class="clearfix"></div>

                    <div class="col-xl-3">
                        <div class="submit-field{{ $errors->has('manufacturer_country_id') ? ' has-error' : '' }}">
                            <h5 class="control-label">Страна происхождения</h5>
                            {!! Form::select('manufacturer_country_id', 
                                $countryArray, 
                                null, 
                                [
                                    'class' => 'selectpicker with-border',
                                    'data-live-search' => 'true',
                                    'data-size' => '7',
                                    'title' => '-- SELECT --',
                                ]) !!}
                        </div>
                    </div>

                    <div class="col-xl-3">
                        <div class="submit-field{{ $errors->has('manufacturer_title') ? ' has-error' : '' }}">
                            <h5 class="control-label">Производитель</h5>
                            {{ Form::text('manufacturer_title',
                                isset($product) ? $product->manufacturer_title : null,
                                ['class' => 'with-border'])
                            }}
                        </div>
                    </div>

                    <div class="col-xl-3">
                        <div class="submit-field{{ $errors->has('srok_godnosti') ? ' has-error' : '' }}">
                            <h5 class="control-label">Срок годности</h5>

                            <div class="input-with-icon">
                                {{ Form::text('srok_godnosti',
                                    isset($product) ? $product->srok_godnosti : null,
                                    ['class' => 'with-border', 'id' => 'datePicker2'])
                                }}
                                <i class="icon-line-awesome-calendar"></i>
                            </div>
                            
                        </div>
                    </div>

                    <div class="col-xl-3">
                        <div class="submit-field{{ $errors->has('warranty') ? ' has-error' : '' }}">
                            <h5 class="control-label">Гарантия на товар</h5>
                            {{ Form::text('warranty',
                                isset($product) ? $product->warranty : null,
                                ['class' => 'with-border'])
                            }}
                        </div>
                    </div>

                    <div class="clearfix"></div>

                    <div class="col-xl-3">
                        <div class="submit-field{{ $errors->has('measure_id') ? ' has-error' : '' }}">
                            <h5 class="control-label">Ед. измерения</h5>
                            {!! Form::select('measure_id', 
                                $measuresArray, 
                                null, 
                                [
                                    'id' => 'measure_id',
                                    'class' => 'selectpicker with-border',
                                    'data-live-search' => 'true',
                                    'data-size' => '7',
                                    'title' => '-- SELECT --',
                                ]) !!}
                        </div>
                    </div>

                    <div class="col-xl-3">
                        <div class="submit-field{{ $errors->has('quantity') ? ' has-error' : '' }}">
                            <h5 class="control-label">Количество</h5>
                            <div class="input-with-icon">
                                <div id="autocomplete-container">
                                    {{ Form::text('quantity',
                                        isset($product) ? $product->quantity : null,
                                        [
                                            'class' => 'with-border',
                                            'onkeypress' => 'javascript:return isNumber(event)',
                                            'placeholder' => 'Количество'
                                        ])
                                    }}
                                </div>
                                <i class="adding">piece</i>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3">
                        <div class="submit-field{{ $errors->has('min_order') ? ' has-error' : '' }}">
                            <h5 class="control-label">Мин партия</h5>
                            <div class="input-with-icon">
                                {{ Form::text('min_order',
                                    isset($product) ? $product->min_order : null,
                                    [
                                        'id' => 'min_order',
                                        'class' => 'with-border',
                                        'onkeypress' => 'javascript:return isNumber(event)',
                                        'placeholder' => 'Количество'
                                    ])
                                }}
                                <i class="adding">piece</i>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3">
                        <div class="submit-field{{ $errors->has('max_order') ? ' has-error' : '' }}">
                            <h5 class="control-label">Макс партия</h5>
                            <div class="input-with-icon">
                                {{ Form::text('max_order',
                                    isset($product) ? $product->max_order : null,
                                    [
                                        'id' => 'max_order',
                                        'class' => 'with-border',
                                        'onkeypress' => 'javascript:return isNumber(event)',
                                        'placeholder' => 'Количество'
                                    ])
                                }}
                                <i class="adding">piece</i>
                            </div>
                        </div>
                    </div>

                    <div class="clearfix"></div>

                    <div class="col-xl-3">
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

                    <div class="col-xl-3">
                        <div class="submit-field{{ $errors->has('price') ? ' has-error' : '' }}">
                            <h5 class="control-label">Цена за единицу товара</h5>
                            <div class="input-with-icon">
                                <div id="autocomplete-container">
                                    {{ Form::text('price',
                                        isset($product) ? $product->price : null,
                                        [
                                            'class' => 'with-border',
                                            'onkeypress' => 'javascript:return isNumber(event)',
                                            'placeholder' => 'Цена'
                                        ])
                                    }}
                                </div>
                                <i>SUM</i>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3">
                        <div class="submit-field">
                            <h5>
                                Сумма&nbsp;
                                <span>(autocalculate)</span>&nbsp;&nbsp;
                                <i class="help-icon" data-tippy-placement="right" title="Calculates automatically"></i>
                            </h5>
                            <div class="input-with-icon">
                                <div id="autocomplete-container">
                                    <input id="autocomplete-input" class="with-border" type="text" value="122000000" disabled>
                                </div>
                                <i>SUM</i>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3">
                        <div class="submit-field{{ $errors->has('nds') ? ' has-error' : '' }}">
                            <div class="checkbox">
                                <input type="checkbox" id="chkIsNds">
                                <label for="chkIsNds">
                                    <span class="checkbox-icon"></span> 
                                    Цена с НДС
                                    <i class="help-icon" data-tippy-placement="right" title="НДС"></i>
                                </label>
                            </div>
                            <div class="input-with-icon">
                                {{ Form::text('nds',
                                    isset($product) ? $product->nds : null,
                                    [
                                        'disabled' => 'true',
                                        'onkeypress' => 'javascript:return isNumber(event)',
                                        'id' => 'txtNds'
                                    ])
                                }}
                                <i id="ndsPetcentIcon"></i>
                            </div>
                        </div>
                    </div>

                    <div class="clearfix"></div>

                    <div class="col-xl-3">
                        <div class="submit-field{{ $errors->has('produced_year') ? ' has-error' : '' }}">
                            <h5 class="control-label">Год выпуска товара</h5>
                            {{ Form::text('produced_year',
                                isset($product) ? $product->produced_year : null,
                                ['class' => 'with-border'])
                            }}
                        </div>
                    </div>                              

                    <div class="col-xl-3">
                        <div class="submit-field{{ $errors->has('usage_percentage') ? ' has-error' : '' }}">
                            <div class="checkbox">
                                <input type="checkbox" id="chkIsOld">
                                <label for="chkIsOld">
                                    <span class="checkbox-icon"></span> 
                                    Б\У
                                    <i class="help-icon" data-tippy-placement="right" title="для бывших в эксплуатации "></i>
                                </label>
                            </div>
                            <div class="input-with-icon">
                                {{ Form::text('usage_percentage',
                                    isset($product) ? $product->usage_percentage : null,
                                    [
                                        'disabled' => 'true',
                                        'id' => 'txtUsagePercentage'
                                    ])
                                }}
                                <i id="usagePetcentIcon"></i>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3">
                        <div class="submit-field{{ $errors->has('usage_period') ? ' has-error' : '' }}">
                            <h5>&nbsp;</h5>
                            {{ Form::text('usage_period',
                                isset($product) ? $product->usage_period : null,
                                [
                                    'disabled' => 'true',
                                    'id' => 'txtUsagePeriod'
                                ])
                            }}
                        </div>
                    </div>

                    <div class="col-xl-3">
                        <div class="submit-field{{ $errors->has('usage_condition') ? ' has-error' : '' }}">
                            <h5>&nbsp;</h5>
                            {{ Form::text('usage_condition',
                                isset($product) ? $product->usage_condition : null,
                                [
                                    'disabled' => 'true',
                                    'id' => 'txtUsageCondition'
                                ])
                            }}
                        </div>
                    </div>

                    <div class="clearfix"></div>

                    <div class="col-xl-4">
                        <div class="submit-field{{ $errors->has('basis_id') ? ' has-error' : '' }}">
                            <h5 class="control-label">Базис поставки</h5>
                            {!! Form::select('basis_id', 
                                $basisArray, 
                                null, 
                                [
                                    'class' => 'selectpicker with-border',
                                    'data-live-search' => 'true',
                                    'data-size' => '7',
                                    'title' => '-- SELECT --',
                                ]) !!}
                        </div>
                    </div>

                    <div class="col-xl-4">
                        <div class="submit-field{{ $errors->has('basis_day') ? ' has-error' : '' }}" title="Срок поставки допускает произвольный текст." data-tippy-placement="bottom">
                            <h5 class="control-label">Срок поставки</h5>
                            {{ Form::text('basis_day',
                                isset($product) ? $product->basis_day : null,
                                [
                                    'class' => 'with-border',
                                    'placeholder' => 'Срок поставки'
                                ])
                            }}
                        </div>
                    </div>

                    <div class="col-xl-4">
                        <div class="submit-field{{ $errors->has('basis_transport_type') ? ' has-error' : '' }}">
                            <h5 class="control-label">Вид транспортировки</h5>
                            {{ Form::text('basis_transport_type',
                                isset($product) ? $product->basis_transport_type : null,
                                [
                                    'class' => 'with-border',
                                    'placeholder' => 'Вид транспортировки'
                                ])
                            }}
                        </div>
                    </div>

                    <div class="clearfix"></div>

                    <div class="col-xl-3">
                        <div class="submit-field{{ $errors->has('expire_at') ? ' has-error' : '' }}">
                            <h5 class="control-label">Срок действия объявления</h5>

                            <div class="input-with-icon">
                                {{ Form::text('expire_at',
                                    isset($product) ? $product->expire_at : null,
                                    [
                                        'class' => 'with-border',
                                        'id' => 'datePicker'
                                    ])
                                }}
                                <i class="icon-line-awesome-calendar"></i>
                            </div>
                            
                        </div>
                    </div>

                    <div class="clearfix"></div>

                    <div class="col-xl-12">
                        <div class="submit-field{{ $errors->has('description') ? ' has-error' : '' }}">
                            <h5 class="control-label">
                                Характеристики товара
                                <span>(описание товара)</span>
                            </h5>
                            {{ Form::textarea('description',
                                isset($product) ? $product->description : null,
                                [
                                    'class' => 'with-border',
                                    'cols' => '30',
                                    'rows' => '2'
                                ])
                            }}
                        </div>
                    </div>

                    <div class="clearfix"></div>

                    <div class="col-xl-12">
                        <div class="submit-field{{ $errors->has('conditions') ? ' has-error' : '' }}">
                            <h5 class="control-label">Особые условия</h5>
                            {{ Form::textarea('conditions',
                                isset($product) ? $product->conditions : null,
                                [
                                    'class' => 'with-border',
                                    'cols' => '30',
                                    'rows' => '2'
                                ])
                            }}
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
                                <label class="uploadButton-button ripple-effect" for="featured_image">Фото товара</label>
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
<script src="{{ asset('sweetalert/sweetalert.min.js') }}"></script>
<script src="{{ asset('datePicker/js/bootstrap-datepicker.js') }}"></script>
<script src="{{ asset('datePicker/locales/bootstrap-datepicker.ru.min.js') }}"></script>

<script>

const $minOrder = document.querySelector('#min_order');
const $maxOrder = document.querySelector('#max_order');

$("#measure_id").on("change",function(){
    $('.adding').html($('#measure_id :selected').text());
});

$('#datePicker2').datepicker({
    format: "yyyy-mm-dd",
    weekStart: 1,
    clearBtn: true,
    autoclose: true,
    language: "{{ str_replace('_', '-', app()->getLocale()) }}"
});

$('#datePicker').datepicker({
    format: "yyyy-mm-dd",
    weekStart: 1,
    clearBtn: true,
    autoclose: true,
    language: "{{ str_replace('_', '-', app()->getLocale()) }}"
});

$('#chkIsNds').change(function(){
    if ($('#chkIsNds').is(':checked') == true){

        $('#txtNds').prop('disabled', false);
        $('#txtNds').addClass('with-border');
        $('#txtNds').attr("placeholder", "НДС процент");

        $('#ndsPetcentIcon').addClass('icon-feather-percent');
    }
    else {

        $('#txtNds').prop('disabled', true);
        $('#txtNds').removeClass('with-border');
        $('#txtNds').attr("placeholder", "");

        $('#ndsPetcentIcon').removeClass('icon-feather-percent');
    }
});

$('#chkIsOld').change(function(){
    if ($('#chkIsOld').is(':checked') == true){
        $('#txtUsagePercentage').prop('disabled', false);
        $('#txtUsagePeriod').prop('disabled', false);
        $('#txtUsageCondition').prop('disabled', false);

        $('#txtUsagePercentage').attr("placeholder", "процент износа");
        $('#txtUsagePeriod').attr("placeholder", "срок эксплуатации");
        $('#txtUsageCondition').attr("placeholder", "состояние товара");

        $('#txtUsagePercentage').addClass('with-border');
        $('#txtUsagePeriod').addClass('with-border');
        $('#txtUsageCondition').addClass('with-border');

        $('#usagePetcentIcon').addClass('icon-feather-percent');
    }
    else {
        $('#txtUsagePercentage').prop('disabled', true);
        $('#txtUsagePeriod').prop('disabled', true);
        $('#txtUsageCondition').prop('disabled', true);

        $('#txtUsagePercentage').attr("placeholder", "");
        $('#txtUsagePeriod').attr("placeholder", "");
        $('#txtUsageCondition').attr("placeholder", "");

        $('#txtUsagePercentage').removeClass('with-border');
        $('#txtUsagePeriod').removeClass('with-border');
        $('#txtUsageCondition').removeClass('with-border');

        $('#usagePetcentIcon').removeClass('icon-feather-percent');
    }
});

function isNumber(evt) {
    var iKeyCode = (evt.which) ? evt.which : evt.keyCode
    if (iKeyCode != 46 && iKeyCode > 31 && (iKeyCode < 48 || iKeyCode > 57))
        return false;

    return true;
}

$('#categoryId').on('change',function(){
    var categoryId = $(this).val();    
    if(categoryId){
        var select = document.getElementById("childCategoryId");
        var length = select.options.length;
        for (var i = 0; i < length; i++) {
          select.options[i] = null;
        }
        $.ajax({
           type:"GET",
           url:"{{url('api/getChildCategories')}}?category_id="+categoryId,
           success:function(res){   
                $.each(res,function(key,value){
                    console.log(value); 
                    $("#childCategoryId").
                        append('<option value="'+key+'">'+value+'</option>');
                });
            }
        });
    }    
});

function validateForm() {
    if($maxOrder.value < $minOrder.value) {
        swal("Ooops..", "Max is less than Min", "error");
        return false;
    } else {
        document.frmMr.submit();
    }
}
</script>
@endsection