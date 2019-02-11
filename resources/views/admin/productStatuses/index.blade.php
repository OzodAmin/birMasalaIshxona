<?php ?>
@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <div class="row">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Статусы продуктов
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

                            @foreach ($statuses as $status)
                                <tr class="cities-users">
                                    <td>{{ $status->name }}</td>
                                    <td>
                                        <a class="btn btn-primary" 
                                            href="{{ route('product_statuses.edit',$status->id) }}">
                                            <i class="fa fa-btn fa-edit"></i>&nbsp;Edit
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                {{ $statuses->links() }}
            </div>
        </div>
@endsection