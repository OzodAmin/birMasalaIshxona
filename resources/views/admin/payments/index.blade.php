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
                                <th>Дата создания</th>
                                <th>Тип платежа</th>
                                <th>Сумма платежа</th>
                                <th>Действия</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach ($payments as $payment)

                                <tr class="payments-users">
                                    <td>
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal{{ $payment->id }}">
                                          {{ $payment->created_at }}
                                        </button>

<div class="modal fade" id="modal{{ $payment->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">{{ $payment->payType->name }}</h4>
            </div>
            <div class="modal-body">
                <h4>Номер документа и дата платежа</h4>
                <p><?= $payment->docNomer.' от '.$payment->date ?></p>
                <h4>Сумма платежа</h4>
                <p><?= $payment->summa.' '.$payment->currency->code; ?></p>
                <h4>Детали платежа</h4>
                <p><?= $payment->reason; ?></p>
                @switch($payment->rkpPayType)
                    @case(1)
                        <center><u><h4>Отправитель</h4></u></center>
                        <div class="col-md-12">
                            <h4>Организация</h4>
                            <p>{{ $payment->userSend->company_legal_name }}</p>
                        </div>
                        <div class="col-md-12">
                            <h4>Банк</h4>
                            <p>{{ $payment->userSendAccount->bank_name }}</p>
                        </div>
                        <div class="col-md-6">
                            <h4>Счет</h4>
                            <p>{{ $payment->userSendAccount->bank_account }}</p>
                        </div>
                        <div class="col-md-6">
                            <h4>Код банка</h4>
                            <p>{{ $payment->userSendAccount->bank_code }}</p>
                        </div>
                        <hr>
                        <center><u><h4>Получатель</h4></u></center>
                        <div class="col-md-8">
                            <h4>Депозитный счет</h4>
                            <p>{{ $payment->account->bank_name }}</p>
                        </div>
                        <div class="col-md-4">
                            <h4>ИНП</h4>
                            <p>{{ $payment->userSendAccount->inp }}</p>
                        </div>
                        @break
                @endswitch
                        
            </div>
            <div class="modal-footer">
                <span>Оператор: {{ $payment->operator->username }}</span>
                <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
            </div>
        </div>
    </div>
</div>
                                    </td>
                                    <td>
                                        {{ $payment->payType->name }}
                                    </td>
                                    <td>
                                        <?= $payment->summa.' '.$payment->currency->code; ?>
                                    </td>
                                    <td>
                                        <a class="btn btn-primary" href="{{ route('payments.edit',$payment->id) }}">
                                            <i class="fa fa-btn fa-edit"></i>
                                        </a>

                                        <form action="{{ url('backend/payments/'.$payment->id) }}" method="POST" style="display: inline-block">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}

                                            <button type="submit" id="delete-task-{{ $payment->id }}" class="btn btn-danger">
                                                <i class="fa fa-btn fa-trash"></i>
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