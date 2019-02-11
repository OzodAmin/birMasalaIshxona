@extends('dashboard.layouts.app')

@section('title')
    Мои банковские счета
@endsection

@section('content')

@if (session()->has('data'))
    <div class="notification notice closeable">
        <p>
            <strong>{{ session('data') }}</strong>
        </p>
        <a class="close"></a>
    </div>
@endif

<div class="dashboard-headline">
    <h3>Мои банковские счета</h3>

    <!-- Breadcrumbs -->
    <nav id="breadcrumbs" class="dark">
        <ul>
            <li>
                <a href="{{ route('rkps.create') }}">
                    Добавить банковский счет&nbsp;<i class="icon-feather-file-plus"></i>
                </a>
            </li>
        </ul>
    </nav>
</div>

<!-- Row -->
<div class="row">

    <!-- Dashboard Box -->
    <div class="col-xl-12">
        <div class="listings-container margin-top-35">
            @foreach ($rkps as $item)

            <a class="job-listing">
                <div class="job-listing-details">
                    <div class="job-listing-description">
                        <h4 class="job-listing-company">
                            <span class="dashboard-status-button {{ $item->statusTable->front_css }}">
                                {{ $item->statusTable->name }}
                            </span>
                        </h4>
                        <h3 class="job-listing-title">
                            {{ $item->bank_name }}
                        </h3>
                        <p class="job-listing-text">
                            Денежная единица: {{ $item->currency->title }}<br>
                            Расчетный счет: {{ $item->bank_account }}<br>
                            Код банка: {{ $item->bank_code }}<br>
                            Инп: {{ $item->inp }}<br>
                            Остаток: <i class="icon-material-outline-account-balance-wallet"></i> 
                            <?= $item->saldo.' '.$item->currency->code ?><br>
                            <i class="icon-material-outline-access-time"></i> 
                            {{ $item->created_at }}
                        </p>
                        <a href="{{ route('rkps.edit',$item->id) }}" class="button ripple-effect">Изменить <i class="icon-feather-edit"></i></a>
                    </div>
                </div>
            </a>

            @endforeach

        </div>
    </div>
    {{ $rkps->links() }}
</div>
@endsection