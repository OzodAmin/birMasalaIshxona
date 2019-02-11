<?php ?>
@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <div class="row">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Список платежей
                        <a href="{{ route('payments.create') }}" class="btn btn-success">
                            <i class="fa fa-btn fa-plus"></i> 
                            &nbsp;Новый платеж
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

                            @foreach ($payments as $payment)

                                <tr class="payments-users">
                                    <td>
                                        <a href="{{ route('payments.show',$payment->id) }}">
                                            {{ $payment->display_name }}
                                        </a>
                                    </td>
                                    <td>
                                        <a class="btn btn-primary" href="{{ route('roles.edit',$payment->id) }}">
                                            <i class="fa fa-btn fa-edit"></i>
                                            &nbsp;Edit
                                        </a>

                                        <form action="{{ url('backend/payments/'.$payment->id) }}" method="POST" style="display: inline-block">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}

                                            <button type="submit" id="delete-task-{{ $payment->id }}" class="btn btn-danger">
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
                {{ $payments->links() }}
            </div>
        </div>
@endsection