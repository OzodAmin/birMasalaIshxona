<?php ?>
@extends('admin.layouts.app')

@section('content')
    <div class="">
        <div class="row">
                <div class="panel panel-default">
                    <div class="panel-heading">Create New Measure</div>

                    <div class="panel-body">
                        @if (count($errors) > 0)
                            <div class="alert alert-danger alert-dismissible fade in" role="alert"> 
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button> 
                                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        {!! Form::open(['route' => 'measures.store']) !!}

                            @include('admin.measure.fields')

                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
@endsection