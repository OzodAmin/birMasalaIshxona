@extends('layouts.app')

@section('title')
    Products list
@endsection

@section('content')
<!-- Page Content ==================== -->
<div class="full-page-container">
    <div class="full-page-content-container" data-simplebar>
        <div class="full-page-content-inner">
            <!-- Freelancers List Container -->
            <div class="freelancers-container freelancers-grid-layout">
                @foreach ($products as $product)
                @if($product->expire_at > \Carbon\Carbon::now())
                <!--Freelancer -->
                <div class="freelancer">
                    <!-- Overview -->
                    <div class="freelancer-overview">
                        <div class="freelancer-overview-inner">
                            <!-- Avatar -->
                            <div class="">
                                <a href="{{ LaravelLocalization::getLocalizedURL($locale, 'product/'.$product->translate($locale)->slug) }}">
                                    <img src="/uploads/product/admin_{{$product->featured_image}}" alt="" class="img-responsive img-thumbnail">
                                </a>
                            </div>

                            <!-- Name -->
                            <div class="freelancer-name">
                                <h4>
                                    <a href="{{ LaravelLocalization::getLocalizedURL($locale, 'product/'.$product->translate($locale)->slug) }}">{{ $product->title }}</a>
                                </h4>
                                <span>
                                    <strong>Цена</strong> 
                                    <?= number_format($product->price,2); ?> {{ $product->currency->code }}
                                </span>
                                <br>
                                <span>
                                    <strong>Кол-во</strong>
                                    {{ $product->quantity }} {{ $product->measureTable->title_short }}
                                </span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Details -->
                    <div class="freelancer-details">
                        <div data-countdown="<?= $product->expire_at; ?>"></div>
                        <div style="display: none;">{{$product->id}}</div>
                        <div class="freelancer-details-list">
                            <ul>
                                <li>День<strong id="days{{$product->id}}"></strong></li>
                                <li>Час<strong id="hours{{$product->id}}"></strong></li>
                                <li>Минут<strong id="minutes{{$product->id}}"></strong></li>
                                <li>Сек<strong id="seconds{{$product->id}}"></strong></li>
                            </ul>
                        </div>
                        <a href="{{ LaravelLocalization::getLocalizedURL($locale, 'product/'.$product->translate($locale)->slug) }}" class="button button-sliding-icon ripple-effect">
                            Просмотр <i class="icon-material-outline-arrow-right-alt"></i>
                        </a>
                    </div>
                </div>
                <!-- Freelancer / End -->
                @endif
                @endforeach
            </div>
            <!-- Freelancers Container / End -->

            <!-- Pagination -->
            {{ $products->links() }}
            <!-- Pagination / End -->
        </div>
    </div>
    <!-- Full Page Content / End -->
</div>
@endsection

@section('scripts')
<script src="{{ asset('front/js/jquery.countdown.min.js') }}"></script>
<script>
    $('[data-countdown]').each(function() {
        var $this = $(this), finalDate = $(this).data('countdown');
        $this.countdown(finalDate, function(event) {
            var id = $this.next().text();
            document.getElementById("days"+id).innerHTML = event.strftime('%D');
            document.getElementById("hours"+id).innerHTML = event.strftime('%H');
            document.getElementById("minutes"+id).innerHTML = event.strftime('%M');
            document.getElementById("seconds"+id).innerHTML = event.strftime('%S');
        });
    });
</script>
@endsection