@extends('admin.layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Edit currency
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($currency, ['route' => ['currencies.update', $currency->id], 'method' => 'patch']) !!}

                        @include('admin.currency.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection