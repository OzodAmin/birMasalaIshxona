<?php ?>
@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <div class="row">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Holiday Management&nbsp;
                        <a href="{{ route('holidays.create') }}" class="btn btn-success">
                            <i class="fa fa-btn fa-plus"></i> 
                            &nbsp;New Holiday
                        </a>
                    </div>
                    <div class="panel-body">
                        @include('flash::message')
                        <table class="table table-striped table-bordered table-condensed">
                            <thead>
                            <tr>
                                <th>Дата</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach ($holidays as $value)

                                <tr class="holidays-users">
                                    <td>{{ $value->holiday }}</td>
                                    <td>
                                        <a class="btn btn-primary" href="{{ route('holidays.edit',$value->id) }}"><i class="fa fa-btn fa-edit"></i> Edit</a>

                                        <form action="{{ url('backend/holidays/'.$value->id) }}" method="POST" style="display: inline-block">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}

                                            <button type="submit" id="delete-task-{{ $value->id }}" class="btn btn-danger">
                                                <i class="fa fa-btn fa-trash"></i> Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                {{ $holidays->links() }}
            </div>
        </div>
@endsection