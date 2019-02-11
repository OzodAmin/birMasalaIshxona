@extends('dashboard.layouts.app')

@section('title')
    Новый товар
@endsection

@section('content')

<div class="dashboard-headline">
    <h3>Новый товар</h3>

    <nav id="breadcrumbs" class="dark">
        <ul>
            <li>
                <a href="{{ url('dashboard') }}">
                    Профиль
                </a>
            </li>
            <li>
                <a href="{{ route('ownProducts.index') }}">
                    Мои товары
                </a>
            </li>
            <li>Новый товар</li>
        </ul>
    </nav>
</div>

{!! Form::open(['method' => 'POST','route' => 'ownProducts.store', 'onsubmit' => 'return validateForm()', 'files' => true]) !!}

    @include('dashboard.products.fields')

{!! Form::close() !!}

@endsection