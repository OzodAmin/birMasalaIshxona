@extends('dashboard.layouts.app')

@section('title')
    Новый банковский счет
@endsection

@section('content')

<div class="dashboard-headline">
    <h3>Новый банковский счет</h3>

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
            <li>Новый банковский счет</li>
        </ul>
    </nav>
</div>

{!! Form::open(['method' => 'POST','route' => 'rkps.store', 'files' => true]) !!}

    @include('dashboard.rkps.fields')

{!! Form::close() !!}

@endsection