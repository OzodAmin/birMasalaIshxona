@extends('dashboard.layouts.app')

@section('title')
    Новый товар
@endsection

@section('content')

<div class="dashboard-headline">
    <h3>{{ $product->title }}</h3>

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
            <li>Редактировать товар</li>
        </ul>
    </nav>
</div>

{!! Form::model($product, ['route' => ['ownProducts.update', $product->id], 'method' => 'patch', 'files' => true]) !!}

    @include('dashboard.products.fields')

{!! Form::close() !!}

@endsection