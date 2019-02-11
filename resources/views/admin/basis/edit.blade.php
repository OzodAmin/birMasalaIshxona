@extends('admin.layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Edit basis
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($basis, ['route' => ['basises.update', $basis->id], 'method' => 'patch']) !!}

                        @include('admin.basis.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection