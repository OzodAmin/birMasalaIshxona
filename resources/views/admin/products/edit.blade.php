@extends('admin.layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            {{ $product->translate('ru')->title }}
        </h1>
        <p>{{ $product->created_at }}</p>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($product, ['route' => ['products.update', $product->id], 'method' => 'patch', 'files' => true]) !!}

<div class="nav-tabs-custom col-xs-12">
  <ul class="nav nav-tabs">
      <?php $key = 1;
      foreach( LaravelLocalization::getSupportedLocales() as $locale => $properties ): ?>
      <li class="{{ $key==1 ? 'active' : '' }}">
          <a href="#tab_{{ $key }}" data-toggle="tab">
              <span class="locale-title"><i class="fa fa-globe" aria-hidden="true"></i> {{ $properties['native'] }}</span>
          </a>
      </li>
      <?php $key++; endforeach; ?>
      <li>
          <a href="#tab_{{ $key }}" data-toggle="tab">
              <span class="locale-title"><i class="fa fa-picture-o" aria-hidden="true"></i> Изображение</span>
          </a>
      </li>
      <li>
          <a href="#tab_product" data-toggle="tab">
              <span class="locale-title text-warning"><i class="fa fa-align-center" aria-hidden="true"></i> Товар</span>
          </a>
      </li>
      <li>
          <a href="#tab_price" data-toggle="tab">
              <span class="locale-title text-warning"><i class="fa fa-align-center" aria-hidden="true"></i> Цена</span>
          </a>
      </li>
      <li>
          <a href="#tab_measure" data-toggle="tab">
              <span class="locale-title text-warning"><i class="fa fa-align-center" aria-hidden="true"></i> измерения</span>
          </a>
      </li>
      <li>
          <a href="#tab_basis" data-toggle="tab">
              <span class="locale-title text-warning"><i class="fa fa-align-center" aria-hidden="true"></i> Базис</span>
          </a>
      </li>
      <li>
          <a href="#tab_warranty" data-toggle="tab">
              <span class="locale-title text-warning"><i class="fa fa-align-center" aria-hidden="true"></i> Срок годности</span>
          </a>
      </li>      
      <li>
          <a href="#tab_producer" data-toggle="tab">
              <span class="locale-title text-warning"><i class="fa fa-align-center" aria-hidden="true"></i> Производитель</span>
          </a>
      </li>
  </ul>

  <div class="tab-content">
      <?php $key = 1;
      foreach( LaravelLocalization::getSupportedLocales() as $locale => $properties ): ?>
      <div class="tab-pane {{ $key==1 ? 'active' : '' }}" id="tab_{{ $key }}">

          <div class="form-group col-sm-6">
              {!! Form::label($locale.'[title]', 'Заголовок '.$properties['native']) !!}
              {{ Form::text(
                  $locale.'[title]',$product->translate($locale)->title,
                  ['class' => 'form-control'])
              }}
          </div>

          <div class="form-group col-sm-6">
              {!! Form::label($locale.'[slug]', 'URL:') !!}
              {{ Form::text(
                  $locale.'[slug]',$product->translate($locale)->slug,
                  ['class' => 'form-control'])
              }}
          </div>

          <div class="clearfix"></div>

          <div class="form-group col-sm-12">
              {!! Form::label($locale.'[description]', 'Характеристики товара:') !!}
              {{ Form::textarea($locale.'[description]', $product->translate($locale)->description, ['class' => 'form-control'])
              }}
          </div>

          <div class="clearfix"></div>

          <div class="form-group col-sm-12">
              {!! Form::label($locale.'[conditions]', 'Особые условия:') !!}
              {{ Form::textarea($locale.'[conditions]', $product->translate($locale)->conditions, ['class' => 'form-control'])
              }}
          </div>

          <div class="clearfix"></div>
      </div>

      <?php $key++; endforeach; ?>
      <div class="tab-pane" id="tab_{{ $key }}">
          <div class="form-group col-sm-12">

              {!! Form::label(false, 'Изображение') !!}

              <?php if( isset($product) && $product->featured_image ): ?>
              <div class="file-wrap">
                  {{ Html::image('uploads/product/admin_'.$product->featured_image, false, array('class' => 'img-responsive img-thumbnail')) }}
              </div>
              <div class="checkbox">
                  <label>
                      {!! Form::checkbox('clear_image', true, false) !!} Удалить
                  </label>
              </div>
              <?php endif; ?>

              {!! Form::file('featured_image') !!}

          </div>
      </div>

      <div class="tab-pane" id="tab_product">
        <div class="form-group col-sm-6">
          {!! Form::label('parent_category_id', 'Основная категория') !!}
          {!! Form::select('parent_category_id',$categoriesArray, null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group col-sm-6">
          {!! Form::label('child_category_id', 'Под категория') !!}
          {!! Form::select('child_category_id',$categoriesChildArray, null, ['class' => 'form-control']) !!}
        </div>

        <div class="clearfix"></div>

        <div class="form-group col-sm-4">
          {!! Form::label('tnved', 'Код ТН ВЭД') !!}
          {{ Form::text('tnved',$product->tnved,['class' => 'form-control'])}}    
        </div>
        <div class="form-group col-sm-4">
          {!! Form::label('deposit', 'Размер задатка') !!}
          {{ Form::text('deposit',$product->deposit,['class' => 'form-control'])}}    
        </div>
        <div class="form-group col-sm-4">
          {!! Form::label('expire_at', 'Срок действия объявления') !!}
          {{ Form::text('expire_at',$product->expire_at,['class' => 'form-control'])}}
        </div>
      </div>

      <div class="tab-pane" id="tab_price">
        <div class="form-group col-sm-4">
          {!! Form::label('currency_id', 'Денежная единица') !!}
          {!! Form::select('currency_id',$currencyArray, null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group col-sm-4">
          {!! Form::label('price', 'Цена за единицу товара') !!}
          {{ Form::text('price',$product->price,['class' => 'form-control'])}}
        </div>

        <div class="form-group col-sm-4">
          {!! Form::label('nds', 'Цена с НДС') !!}
          <div class="input-group">
            {{ Form::text('nds',$product->nds,['class' => 'form-control'])}}
            <div class="input-group-addon">%</div>
          </div>
        </div>
      </div>

      <div class="tab-pane" id="tab_measure">
        <div class="form-group col-sm-3">
          {!! Form::label('measure_id', 'Ед. измерения') !!}
          {!! Form::select('measure_id',$measuresArray, null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group col-sm-3">
          {!! Form::label('quantity', 'Количество') !!}
          <div class="input-group">
            {{ Form::text('quantity',$product->quantity,['class' => 'form-control'])}}
            <div class="input-group-addon">{{ $product->measureTable->title_short }}</div>
          </div>
        </div>

        <div class="form-group col-sm-3">
          {!! Form::label('min_order', 'Мин партия') !!}
          <div class="input-group">
            {{ Form::text('min_order',$product->min_order,['class' => 'form-control']) }} 
            <div class="input-group-addon">{{ $product->measureTable->title_short }}</div>
          </div>
        </div>

        <div class="form-group col-sm-3">
          {!! Form::label('max_order', 'Макс партия') !!}
          <div class="input-group">
            {{ Form::text('max_order',$product->max_order,['class' => 'form-control'])}} 
            <div class="input-group-addon">{{ $product->measureTable->title_short }}</div>
          </div>
        </div>
      </div>

      <div class="tab-pane" id="tab_basis">
        <div class="form-group col-sm-4">
          {!! Form::label('basis_id', 'Базис поставки') !!}
          {!! Form::select('basis_id',$basisArray, null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group col-sm-4">
          {!! Form::label('basis_day', 'Срок поставки') !!}
          {{ Form::text('basis_day',$product->basis_day,['class' => 'form-control'])}}
        </div>

        <div class="form-group col-sm-4">
          {!! Form::label('basis_transport_type', 'Вид транспортировки') !!}
          {{ Form::text('basis_transport_type',$product->basis_transport_type,['class' => 'form-control'])}}
        </div>
      </div>

      <div class="tab-pane" id="tab_warranty">
        <div class="form-group col-sm-4">
          {!! Form::label('produced_year', 'Год выпуска товара') !!}
          {{ Form::text('produced_year',$product->produced_year,['class' => 'form-control'])}}
        </div>
        <div class="form-group col-sm-4">
          {!! Form::label('srok_godnosti', 'Срок годности') !!}
          {{ Form::text('srok_godnosti',$product->srok_godnosti,['class' => 'form-control'])}}    
        </div>
        <div class="form-group col-sm-4">
          {!! Form::label('warranty', 'Гарантия на товар') !!}
          {{ Form::text('warranty',$product->warranty,['class' => 'form-control'])}}    
        </div>

        <div class="clearfix"></div>

        <div class="form-group col-sm-4">
          {!! Form::label('usage_percentage', 'Б\У (usage_percentage)') !!}
          {{ Form::text('usage_percentage',$product->usage_percentage,['class' => 'form-control'])}}
        </div>

        <div class="form-group col-sm-4">
          {!! Form::label('usage_period', 'Б\У (usage_period)') !!}
          {{ Form::text('usage_period',$product->usage_period,['class' => 'form-control'])}}
        </div>

        <div class="form-group col-sm-4">
          {!! Form::label('usage_condition', 'Б\У (usage_condition)') !!}
          {{ Form::text('usage_condition',$product->usage_condition,['class' => 'form-control'])}}
        </div>
      </div>

      <div class="tab-pane" id="tab_producer">
        <div class="form-group col-sm-4">
          {!! Form::label('manufacturer_country_id', 'Страна происхождения') !!}
          {!! Form::select('manufacturer_country_id',$countryArray, null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group col-sm-8">
          {!! Form::label('manufacturer_title', 'Производитель') !!}
          {{ Form::text('manufacturer_title',$product->manufacturer_title,['class' => 'form-control'])}}    
        </div>
      </div>
  </div>
</div>

<div class="form-group col-sm-3">
  {!! Form::label('status', 'Status') !!}
  {!! Form::select('status',$statusesArray, null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('products.index') !!}" class="btn btn-default">Cancel</a>
</div>

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection