@extends('layouts.app')

@section('title')
    Категории
@endsection

@section('content')

<!-- Category Boxes -->
<div class="container">
    <div class="raw">
        <div class="col-xl-12">
            <div class="section-headline centered margin-bottom-15 margin-top-15">
                <h3>Категории</h3>
            </div>
            </div>
        </div>
        @foreach ($categories as $category)
        <!-- Accordion Item -->
        <div class="col-xl-4 col-md-4">
            <h3>
                <i class="{{ $category->image }}"></i> {{ $category->title }}
            </h3>
            <ul class="list-3 color">
                @foreach ($category->categoryChilds as $cat)
                    <li><a href="/category/{{$cat->id}}">{{ $cat->title }}</a></li>
                @endforeach
            </ul>
        </div>
        @endforeach
    </div>
</div>
@endsection

@section('scripts')
@endsection