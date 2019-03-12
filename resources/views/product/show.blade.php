@extends('layouts.app')

@section('title')
    {{ $product->title }}
@endsection

@section('content')
<!-- Titlebar
================================================== -->
<div class="single-page-header" data-background-image="{{ asset('front/images/single-job.jpg') }}">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="single-page-header-inner">
                    <div class="left-side">
                        <div class="header-image">
                            {{ Html::image('uploads/product/admin_'.$product->featured_image) }}
                        </div>
                        <div class="header-details">
                            <h3>{{ $product->title }}</h3>
                            <ul>
                                <li>
                                    <a href="#">
                                        <i class="icon-material-outline-business"></i>
                                        {{ $product->user->company_legal_name }}
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="right-side">
                        <div class="salary-box">
                            <div class="salary-amount">
                                <?= number_format($product->price,2); ?> {{ $product->currency->code }}/{{ $product->measureTable->title_short }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Page Content ================================== -->
<div class="container">
    <div class="row">
        
        <!-- Content -->
        <div class="col-xl-8 col-lg-8 content-right-offset">

            <div class="single-page-section">
                <h3 class="margin-bottom-25">Product Description</h3>
                <p>{{ $product->description }}</p>

                <h3 class="margin-bottom-25">Product Requirements</h3>
                <p>{{ $product->conditions }}</p>
            </div>
        </div>
        

        <!-- Sidebar -->
        <div class="col-xl-4 col-lg-4">
            <div class="sidebar-container">
                @permission('price-process')
                    <a href="{{ url('/price-request/'.$product->id) }}" class="apply-now-button">Механизм запрос цен <i class="icon-material-outline-arrow-right-alt"></i></a>
                @endpermission
                    
                <!-- Sidebar Widget -->
                <div class="sidebar-widget">
                    <div class="job-overview">
                        <div class="job-overview-inner">
                            <ul>
                                <li>
                                    <i class="icon-material-outline-business"></i>
                                    <span>Производитель</span>
                                    <h5>{{ $product->manufacturer_title }}</h5>
                                </li>
                                <li>
                                    <i class="icon-material-outline-location-on"></i>
                                    <span>Страна производитель</span>
                                    <h5>{{ $product->country->title }}</h5>
                                </li>
                                <li>
                                    <i class="icon-material-outline-add-shopping-cart"></i>
                                    <span>Количество</span>
                                    <h5>{{ $product->quantity }} {{ $product->measureTable->title_short }}</h5>
                                </li>
                                <li>
                                    <i class="icon-material-outline-assessment"></i>
                                    <span>Мин/макс партия</span>
                                    <h5>{{ $product->min_order }} - {{ $product->max_order }} {{ $product->measureTable->title_short }}</h5>
                                </li>
                                <li>
                                    <i class="icon-material-outline-access-time"></i>
                                    <span>Срок доставки</span>
                                    <h5>{{ $product->basis_day }}</h5>
                                </li>
                                <li>
                                    <i class="icon-material-outline-access-time"></i>
                                    <span>Date Posted</span>
                                    <h5>{{ $product->created_at }}</h5>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>
@endsection