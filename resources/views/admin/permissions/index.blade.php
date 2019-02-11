<?php ?>
@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <div class="row">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Права доступа
                        <a href="{{ route('permissions.create') }}" class="btn btn-success">
                            <i class="fa fa-btn fa-plus"></i> 
                            &nbsp;Новый права
                        </a>
                    </div>
                    <div class="panel-body">
                        @include('flash::message')
                        <table class="table table-striped table-bordered table-condensed">
                            <thead>
                            <tr>
                                <th>Название</th>
                                <th>Права на</th>
                                <th>Действия</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach ($permissions as $permission)

                                <tr class="permissions-users">
                                    <td>
                                        {{ $permission->display_name }}
                                    </td>
                                     <td>
                                        {{ $permission->name }}
                                    </td>
                                    <td>
                                        <a class="btn btn-primary" href="{{ route('permissions.edit',$permission->id) }}">
                                            <i class="fa fa-btn fa-edit"></i>
                                            &nbsp;Edit
                                        </a>

                                        <form action="{{ url('backend/permissions/'.$permission->id) }}" method="POST" style="display: inline-block">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}

                                            <button type="submit" id="delete-task-{{ $permission->id }}" class="btn btn-danger">
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
                {{ $permissions->links() }}
            </div>
        </div>
@endsection