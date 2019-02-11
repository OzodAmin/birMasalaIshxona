@extends('admin.layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Edit child category
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($category, ['route' => ['childCategories.update', $category->id], 'method' => 'patch']) !!}

                        @include('admin.categoryChild.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection