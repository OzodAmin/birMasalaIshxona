@extends('admin.layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Edit city
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($city, ['route' => ['cities.update', $city->id], 'method' => 'patch']) !!}

                        @include('admin.cities.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection