<?php ?>
@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <div class="row">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Роль
                        <a href="{{ route('roles.create') }}" class="btn btn-success">
                            <i class="fa fa-btn fa-plus"></i> 
                            &nbsp;Новый роль
                        </a>
                    </div>
                    <div class="panel-body">
                        @include('flash::message')
                        <table class="table table-striped table-bordered table-condensed">
                            <thead>
                            <tr>
                                <th>Название</th>
                                <th>Действия</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach ($roles as $role)

                                <tr class="roles-users">
                                    <td>
                                        <a href="{{ route('roles.show',$role->id) }}">
                                            {{ $role->display_name }}
                                        </a>
                                    </td>
                                    <td>
                                        <a class="btn btn-primary" href="{{ route('roles.edit',$role->id) }}">
                                            <i class="fa fa-btn fa-edit"></i>
                                            &nbsp;Edit
                                        </a>

                                        <form action="{{ url('backend/roles/'.$role->id) }}" method="POST" style="display: inline-block">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}

                                            <button type="submit" id="delete-task-{{ $role->id }}" class="btn btn-danger">
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
                {{ $roles->links() }}
            </div>
        </div>
@endsection