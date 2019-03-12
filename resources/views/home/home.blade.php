@extends('layouts.app')

@section('title')
    Index
@endsection

@section('content')

<!-- Intro Banner ============================= -->
<div class="intro-banner dark-overlay" data-background-image="images/home-background-02.jpg">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="intro-banner-search-form margin-top-95 margin-bottom-95">

                    <!-- Search Field -->
                    <div class="intro-search-field">
                        <label for ="intro-keywords" class="field-title ripple-effect">What you need done?</label>
                        <input id="intro-keywords" type="text" placeholder="e.g. build me a website">
                    </div>

                    <!-- Button -->
                    <div class="intro-search-button">
                        <button class="button ripple-effect">Search</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
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
            <div class="accordion js-accordion">
                <div class="accordion__item js-accordion-item">
                    <div class="accordion-header js-accordion-header">
                        <i class="{{ $category->image }}"></i> {{ $category->title }}
                    </div>
                    <div class="accordion-body js-accordion-body">
                        <div class="accordion-body__contents">
                            <ul class="list-3 color">
                                @foreach ($category->categoryChilds as $cat)
                                    <li>
                                        <a href="/category/{{$cat->id}}">{{ $cat->title }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
<!-- Features Jobs -->
<div class="section gray margin-top-45 padding-top-65 padding-bottom-75">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                
                <!-- Section Headline -->
                <div class="section-headline margin-top-0 margin-bottom-35">
                    <h3>Last products</h3>
                    <a href="/products" class="headline-link">Browse All products</a>
                </div>
                
                <!-- Jobs Container -->
                <div class="listings-container compact-list-layout margin-top-35">
                    @foreach ($products as $product)
                    <!-- Job Listing -->
                    <a href="{{ LaravelLocalization::getLocalizedURL($locale, 'product/'.$product->translate($locale)->slug) }}" class="job-listing with-apply-button">

                        <!-- Job Listing Details -->
                        <div class="job-listing-details">

                            <!-- Logo -->
                            <div class="job-listing-company-logo">
                                {{ Html::image('uploads/product/admin_'.$product->featured_image) }}
                            </div>

                            <!-- Details -->
                            <div class="job-listing-description">
                                <h3 class="job-listing-title">
                                    {{ $product->title }}
                                </h3>

                                <!-- Job Listing Footer -->
                                <div class="job-listing-footer">
                                    <ul>
                                        <li>
                                            <i class="icon-material-outline-date-range"></i>
                                            &nbsp;Posted on {{ $product->created_at }}
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </a>
                    @endforeach
                </div>
                <!-- Jobs Container / End -->

            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
@endsection