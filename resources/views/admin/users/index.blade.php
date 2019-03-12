<?php ?>
@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <div class="row">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        User Management&nbsp;
                        <a href="{{ route('users.create') }}" class="btn btn-success">
                            <i class="fa fa-btn fa-plus"></i> 
                            &nbsp;New User
                        </a>
                    </div>

                    <div class="panel-body">
                        @include('flash::message')
                        @if ($message = Session::get('success'))
                            <div class="alert alert-success">
                                <p>{{ $message }}</p>
                            </div>
                        @endif
                        <table class="table table-striped table-bordered table-condensed">
                            <thead>
                            <tr>
                                <th>Ф.И.О</th>
                                <th>Email</th>
                                <th>Организация</th>
                                <th>Роль</th>
                                <th>Статус</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach ($users as $user)

                                <tr class="list-users">
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->company_legal_name }}</td>
                                    <td>
                                        @foreach($user->roles as $role)
                                            {{ $role->display_name }}
                                        @endforeach
                                    </td>
                                    <td>
                                        @switch($user->status)
                                            @case(1)
                                                <span  class="label label-default statuses">
                                                    На модерации
                                                </span >
                                                @break
                                            @case(2)
                                                <span  class="label label-success">
                                                    Активный
                                                </span >
                                                @break
                                            @case(3)
                                                <span  class="label label-danger">
                                                    Нарушение правил торгов
                                                </span >
                                                @break
                                            @case(4)
                                                <span  class="label label-danger">
                                                    Неуплата комиссионных сборов
                                                </span >
                                                @break
                                            @case(5)
                                                <span  class="label label-danger">
                                                    Неполнота предоставленных документов
                                                </span >
                                                @break
                                            @case(6)
                                                <span  class="label label-danger">
                                                    Неактивен по прочим причинам
                                                </span >
                                                @break
                                            @case(7)
                                                <span  class="label label-warning">
                                                    Заблокирован сотрудником РКП
                                                </span >
                                                @break
                                            @default
                                                <span class="label label-primary">???</span>
                                        @endswitch
                                        
                                    </td>
                                    <td>
                                        <a class="btn btn-info" href="{{ route('users.show',$user->id) }}">
                                            <i class="fa fa-btn fa-eye"></i>&nbsp;Show
                                        </a>
                                        <a class="btn btn-primary" href="{{ route('users.edit',$user->id) }}">
                                            <i class="fa fa-btn fa-edit"></i>&nbsp;Edit
                                        </a>

                                        <form action="{{ url('backend/users/'.$user->id) }}" method="POST" style="display: inline-block">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}

                                            <button type="submit" id="delete-task-{{ $user->id }}" class="btn btn-danger">
                                                Заблокировать
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            {{ $users->links() }}
        </div>
    </div>
@endsection