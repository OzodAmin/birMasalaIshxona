@extends('dashboard.layouts.app')

@section('title')
    Редактировать банковский счет
@endsection

@section('content')

<div class="dashboard-headline">
    <h3>{{ $rkp->title }}</h3>

    <nav id="breadcrumbs" class="dark">
        <ul>
            <li>
                <a href="{{ url('dashboard') }}">
                    Профиль
                </a>
            </li>
            <li>
                <a href="{{ route('rkps.index') }}">
                    Банковские счета
                </a>
            </li>
            <li>Редактировать банковский счет</li>
        </ul>
    </nav>
</div>

{!! Form::model($rkp, ['route' => ['rkps.update', $rkp->id], 'method' => 'patch', 'files' => true]) !!}

    @include('dashboard.rkps.fields')

{!! Form::close() !!}

@endsection