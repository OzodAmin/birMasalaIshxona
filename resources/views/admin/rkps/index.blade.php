<?php ?>
@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <div class="row">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Rkp Management
                    </div>

                    <div class="panel-body">
                        @include('flash::message')
                        <table class="table table-striped table-bordered table-condensed">
                            <thead>
                            <tr>
                                <th>Status</th>
                                <th>Наименование банка</th>
                                <th>Клиент</th>
                                <th>Валюта</th>
                                <th>Остаток</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach ($rkps as $item)

                                <tr class="">
                                    <td>
                                        <span class="label {{ $item->statusTable->admin_css }}">
                                            {{ $item->statusTable->name }}
                                        </span>
                                    </td>
                                    <td>{{ $item->bank_name }}</td>
                                    <td>{{ $item->user->company_legal_name }}</td>
                                    <td>{{ $item->currency->title }}</td>
                                    <td>{{ $item->saldo }}</td>
                                    
                                    <td>
                                        <a class="btn btn-success" href="{{ url('backend/payments/create?id='.$item->id) }}">
                                            <i class="fa fa-btn fa-upload"></i>
                                        </a>
                                        <a class="btn btn-success" href="{{ route('rkpsAdmin.edit',$item->id) }}">
                                            <i class="fa fa-btn fa-edit"></i>&nbsp;Edit
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            {{ $rkps->links() }}
        </div>
    </div>
@endsection