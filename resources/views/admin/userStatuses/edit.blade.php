@extends('admin.layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Статус - {{ $status->translate('ru')->name }}
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($status, ['route' => ['user_statuses.update', $status->id], 'method' => 'patch']) !!}
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
                          </ul>

                          <div class="tab-content">
                              <?php $key = 1;
                              foreach( LaravelLocalization::getSupportedLocales() as $locale => $properties ): ?>
                              <div class="tab-pane {{ $key==1 ? 'active' : '' }}" id="tab_{{ $key }}">

                                  <div class="form-group col-sm-6">
                                      {!! Form::label($locale.'[name]', 'Заголовок:') !!}
                                      {{ Form::text($locale.'[name]', $status->translate($locale)->name, ['class' => 'form-control'])
                                      }}
                                  </div>

                                  <!-- Submit Field -->
                                  <div class="form-group col-sm-12">
                                      {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                                      <a href="{!! route('user_statuses.index') !!}" class="btn btn-default">Cancel</a>
                                  </div>
                              </div>
                              <?php $key++; endforeach; ?>
                          </div>
                      </div>
                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection