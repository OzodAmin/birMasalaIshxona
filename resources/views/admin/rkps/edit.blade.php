@extends('admin.layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Edit rkp
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($rkp, ['route' => ['rkpsAdmin.update', $rkp->id], 'method' => 'patch']) !!}
                      <div class="col-sm-6">
                        {{ Html::image('uploads/rkp/'.$rkp->featured_image, 'alt', ['class' => 'img-responsive']) }}
                      </div>
                      <div class="col-sm-6">
                        <h4><b>Наименование банка</b></h4>
                        <p>{{ $rkp->bank_name }}</p><br>

                        <h4><b>Код банка</b></h4>
                        <p>{{ $rkp->bank_code }}</p><br>

                        <h4><b>Расчетный счет</b></h4>
                        <p>{{ $rkp->bank_account }}</p><br>
                      
                        <h4><b>Денежная единица</b></h4>
                        <p>{{ $rkp->currency->title }}</p><br>

                        {!! Form::label('rkp_account_id', 'Депозитный счет') !!}
                        {!! Form::select('rkp_account_id', $banksArray, null, ['class' => 'form-control']) !!}<br>

                        <h4><b>Статус</b></h4>
                        {!! Form::select('status_id', $statusArray, null, ['class' => 'form-control']) !!}<br>

                        {!! Form::label('notes', 'Примечание') !!}
                        {{ Form::text('notes', $rkp->notes, ['class' => 'form-control']) }}<br>

                        {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                        <a href="{!! route('rkpsAdmin.index') !!}" class="btn btn-default">Cancel</a>
                      </div>

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection