@extends('dashboard.layouts.app')

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
    <h3>Мои товары</h3>

    <!-- Breadcrumbs -->
    <nav id="breadcrumbs" class="dark">
        <ul>
            <li>
                <a href="{{ route('ownProducts.create') }}">
                    Добавить товар&nbsp;<i class="icon-feather-file-plus"></i>
                </a>
            </li>
        </ul>
    </nav>
</div>

<!-- Row -->
<div class="row">

    <!-- Dashboard Box -->
    <div class="col-xl-12">
        <div class="dashboard-box margin-top-0">
            <div class="content">
                <ul class="dashboard-box-list">
                    @foreach ($products as $product)
                    <li>
                        <!-- Job Listing -->
                        <div class="job-listing">

                            <!-- Job Listing Details -->
                            <div class="job-listing-details">

                                <!-- Logo -->
                                <a href="#" class="job-listing-company-logo">
                                    {{ Html::image('uploads/product/admin_'.$product->featured_image) }}
                                </a>

                                <!-- Details -->
                                <div class="job-listing-description">
                                    <h3 class="job-listing-title">
                                        <a href="#">
                                            {{ $product->title }}
                                        </a>&nbsp;
                                        <span class="dashboard-status-button {{ $product->statusTable->class }}">
                                            {{ $product->statusTable->name }}
                                        </span>
                                    </h3>

                                    <!-- Job Listing Footer -->
                                    <div class="job-listing-footer">
                                        <ul>
                                            <li>
                                                <i class="icon-material-outline-date-range"></i>
                                                &nbsp;Posted on {{ $product->created_at }}
                                            </li>
                                            <li>
                                                <i class="icon-material-outline-date-range"></i>
                                                &nbsp;Expiring on {{ $product->expire_at }}
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Buttons -->
                        <div class="buttons-to-right always-visible">
                            <a href="#" class="button ripple-effect">
                                {{ $product->categoryMain->title }}
                                <i class="icon-material-outline-arrow-right"></i> 
                            </a>
                            <a href="#" class="button ripple-effect">
                                {{ $product->categoryChild->title }}
                            </a>
                            @if($product->status == 1)

                            <a href="{{ route('ownProducts.edit',$product->id) }}"
                                class="button gray ripple-effect ico"
                                title="Edit"
                                data-tippy-placement="top">
                                <i class="icon-feather-edit"></i>
                            </a>
                            <a href="#" class="button gray ripple-effect ico" title="Remove" data-tippy-placement="top">
                                <i class="icon-feather-trash-2"></i>
                            </a>

                            @endif
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    {{ $products->links() }}
</div>
@endsection