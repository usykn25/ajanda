@extends('Backend/backend-master')
@section('css')
<style>
    /**
 * Owl Carousel v2.3.4
 * Copyright 2013-2018 David Deutsch
 * Licensed under: SEE LICENSE IN https://github.com/OwlCarousel2/OwlCarousel2/blob/master/LICENSE
 */
    /*
     *  Owl Carousel - Core
     */
    .owl-carousel {
        display: none;
        width: 100%;
        -webkit-tap-highlight-color: transparent;
        /* position relative and z-index fix webkit rendering fonts issue */
        position: relative;
        z-index: 1; }
    .owl-carousel .owl-stage {
        position: relative;
        -ms-touch-action: pan-Y;
        touch-action: manipulation;
        -moz-backface-visibility: hidden;
        /* fix firefox animation glitch */ }
    .owl-carousel .owl-stage:after {
        content: ".";
        display: block;
        clear: both;
        visibility: hidden;
        line-height: 0;
        height: 0; }
    .owl-carousel .owl-stage-outer {
        position: relative;
        overflow: hidden;
        /* fix for flashing background */
        -webkit-transform: translate3d(0px, 0px, 0px); }
    .owl-carousel .owl-wrapper,
    .owl-carousel .owl-item {
        -webkit-backface-visibility: hidden;
        -moz-backface-visibility: hidden;
        -ms-backface-visibility: hidden;
        -webkit-transform: translate3d(0, 0, 0);
        -moz-transform: translate3d(0, 0, 0);
        -ms-transform: translate3d(0, 0, 0); }
    .owl-carousel .owl-item {
        position: relative;
        min-height: 1px;
        float: left;
        -webkit-backface-visibility: hidden;
        -webkit-tap-highlight-color: transparent;
        -webkit-touch-callout: none; }
    .owl-carousel .owl-item img {
        display: block;
        width: 100%; }
    .owl-carousel .owl-nav.disabled,
    .owl-carousel .owl-dots.disabled {
        display: none; }
    .owl-carousel .owl-nav .owl-prev,
    .owl-carousel .owl-nav .owl-next,
    .owl-carousel .owl-dot {
        cursor: pointer;
        -webkit-user-select: none;
        -khtml-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none; }
    .owl-carousel .owl-nav button.owl-prev,
    .owl-carousel .owl-nav button.owl-next,
    .owl-carousel button.owl-dot {
        background: none;
        color: inherit;
        border: none;
        padding: 0 !important;
        font: inherit; }
    .owl-carousel.owl-loaded {
        display: block; }
    .owl-carousel.owl-loading {
        opacity: 0;
        display: block; }
    .owl-carousel.owl-hidden {
        opacity: 0; }
    .owl-carousel.owl-refresh .owl-item {
        visibility: hidden; }
    .owl-carousel.owl-drag .owl-item {
        -ms-touch-action: pan-y;
        touch-action: pan-y;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none; }
    .owl-carousel.owl-grab {
        cursor: move;
        cursor: grab; }
    .owl-carousel.owl-rtl {
        direction: rtl; }
    .owl-carousel.owl-rtl .owl-item {
        float: right; }

    /* No Js */
    .no-js .owl-carousel {
        display: block; }

    /*
     *  Owl Carousel - Animate Plugin
     */
    .owl-carousel .animated {
        animation-duration: 1000ms;
        animation-fill-mode: both; }

    .owl-carousel .owl-animated-in {
        z-index: 0; }

    .owl-carousel .owl-animated-out {
        z-index: 1; }

    .owl-carousel .fadeOut {
        animation-name: fadeOut; }

    @keyframes fadeOut {
        0% {
            opacity: 1; }
        100% {
            opacity: 0; } }

    /*
     * 	Owl Carousel - Auto Height Plugin
     */
    .owl-height {
        transition: height 500ms ease-in-out; }

    /*
     * 	Owl Carousel - Lazy Load Plugin
     */
    .owl-carousel .owl-item {
        /**
                  This is introduced due to a bug in IE11 where lazy loading combined with autoheight plugin causes a wrong
                  calculation of the height of the owl-item that breaks page layouts
               */ }
    .owl-carousel .owl-item .owl-lazy {
        opacity: 0;
        transition: opacity 400ms ease; }
    .owl-carousel .owl-item .owl-lazy[src^=""], .owl-carousel .owl-item .owl-lazy:not([src]) {
        max-height: 0; }
    .owl-carousel .owl-item img.owl-lazy {
        transform-style: preserve-3d; }

    /*
     * 	Owl Carousel - Video Plugin
     */
    .owl-carousel .owl-video-wrapper {
        position: relative;
        height: 100%;
        background: #000; }

    .owl-carousel .owl-video-play-icon {
        position: absolute;
        height: 80px;
        width: 80px;
        left: 50%;
        top: 50%;
        margin-left: -40px;
        margin-top: -40px;
        background: url("owl.video.play.png") no-repeat;
        cursor: pointer;
        z-index: 1;
        -webkit-backface-visibility: hidden;
        transition: transform 100ms ease; }

    .owl-carousel .owl-video-play-icon:hover {
        -ms-transform: scale(1.3, 1.3);
        transform: scale(1.3, 1.3); }

    .owl-carousel .owl-video-playing .owl-video-tn,
    .owl-carousel .owl-video-playing .owl-video-play-icon {
        display: none; }

    .owl-carousel .owl-video-tn {
        opacity: 0;
        height: 100%;
        background-position: center center;
        background-repeat: no-repeat;
        background-size: contain;
        transition: opacity 400ms ease; }

    .owl-carousel .owl-video-frame {
        position: relative;
        z-index: 1;
        height: 100%;
        width: 100%; }
</style>
@endsection

@section('content')
<div class="container-fluid">
    <div class="page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{!! route('Products') !!}">Ürünler</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Göster</a></li>
        </ol>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-3 col-lg-6  col-md-6 col-xxl-5 ">
                            <!-- Tab panes -->
                            <div class="tab-content" id="myTabContent">
                                @if(json_decode($product->gallery))
                                    @foreach(json_decode($product->gallery) as $key => $value)
                                        <div class="tab-pane fade show {{ $key == 0 ? 'active' : ''}}" id="gall{{ $key }}" role="tabpanel" aria-labelledby="home-tab" tabindex="0" style="width: 100%; height: 220px;">
                                            <img class="img-fluid " src="{{ PUBLIC_DIR }}/uploads/urun/{{ $value }}" alt="">
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                            <ul class="nav nav-tabs slide-item-list mt-3" id="myTab" role="tablist">
                                @if(json_decode($product->gallery))
                                @foreach(json_decode($product->gallery) as $key => $value)
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link {{ $key == 0 ? 'active' : ''}}" id="gall{{ $key }}" data-bs-toggle="tab" data-bs-target="#gall{{ $key }}"  role="tab" aria-controls="home-tab-pane" aria-selected="true"><img class="img-fluid me-2" src="{{ PUBLIC_DIR }}/uploads/urun/{{ $value }}" alt="" height="50" width="80" ></a>
                                </li>
                                @endforeach
                                @endif

                            </ul>
                        </div>
                        <!--Tab slider End-->
                        <div class="col-xl-9 col-lg-6  col-md-6 col-xxl-7 col-sm-12">
                            <div class="product-detail-content">
                                <!--Product details-->
                                <div class="new-arrival-content pr">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <img src="{{ PUBLIC_DIR }}/uploads/school-arma/{{ $school->schoolArma }}" alt="" width="100">
                                        </div>
                                        <div class="col-md-10">
                                            <h4 class="mt-md-0 mt-3">{{ $school->schoolName }} ({{ $school->CityName }} / {{ $school->DistrictName }})</h4>
                                            <div class="d-table mb-2">
                                                <p class="price float-start d-block">{{ $product->productName }} ({{ $category->title }})</p>
                                            </div>
                                            <p>Ürün Barkodu: <span class="item">{{ $product->productBarkod }}</span>
                                            </p>
                                        </div>
                                    </div>
                                    <hr>
                                    <p>Availability: <span class="item"> In stock <i
                                                class="fa fa-shopping-basket"></i></span>
                                    </p>
                                    <p>Product code: <span class="item">0405689</span> </p>
                                    <p>Brand: <span class="item">Lee</span></p>
                                    <p>Product tags:&nbsp;&nbsp;
                                        <span class="badge badge-success light">bags</span>
                                        <span class="badge badge-success light">clothes</span>
                                        <span class="badge badge-success light">shoes</span>
                                        <span class="badge badge-success light">dresses</span>
                                    </p>
                                    <p class="text-content">There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable.
                                        If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing.</p>
                                    <div class="d-flex align-items-end flex-wrap mt-4">
                                        <div class="filtaring-area mb-3 me-3">
                                            <div class="size-filter">
                                                <h4 class="m-b-15">Select size</h4>

                                                <div class="btn-group mb-sm-0 mb-2" role="group" aria-label="Basic radio toggle button group">
                                                    <input type="radio" class="btn-check" name="btnradio" id="btnradio1" checked="">
                                                    <label class="btn btn-outline-primary form-label mb-0" for="btnradio1">XS</label>

                                                    <input type="radio" class="btn-check" name="btnradio" id="btnradio2">
                                                    <label class="btn btn-outline-primary form-label mb-0" for="btnradio2">SM</label>

                                                    <input type="radio" class="btn-check" name="btnradio" id="btnradio3">
                                                    <label class="btn btn-outline-primary form-label mb-0" for="btnradio3">MD</label>

                                                    <input type="radio" class="btn-check" name="btnradio" id="btnradio4">
                                                    <label class="btn btn-outline-primary form-label mb-0" for="btnradio4">LG</label>

                                                    <input type="radio" class="btn-check" name="btnradio" id="btnradio5">
                                                    <label class="btn btn-outline-primary form-label mb-0" for="btnradio5">XL</label>
                                                </div>
                                            </div>
                                        </div>
                                        <!--Quantity start-->
                                        <div class="col-sm-2 col-4 px-0  mb-3 me-3">
                                            <input name="num" class="form-control input-btn input-number" value="1">
                                        </div>
                                        <!--Quanatity End-->
                                        <div class="shopping-cart  mb-3 me-3">
                                            <a class="btn btn-primary" href="javascript:void(0)"><i
                                                    class="fa fa-shopping-basket me-2"></i>Add
                                                to cart</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div>
            <h3 class="font-w600 mb-4 mt-3">{{ $school->schoolName }} ({{ $school->CityName }} / {{ $school->DistrictName }})</h3>
            <div class="owl-carousel card-slider">

                @if($schoolProducts)
                @foreach($schoolProducts as $product)
                    <div class="items">
                        <div class="card">
                        <div class="card-body product-grid-card">
                            <div class="new-arrival-product">
                                <div class="new-arrivals-img-contnent">
                                    <img class="img-fluid rounded" src="{{ PUBLIC_DIR }}uploads/urun/{{ $product->gallery[0] }}" alt="" style="min-height: 150px;max-height: 150px;">
                                </div>
                                <div class="new-arrival-content text-center mt-3">
                                    <h6>{{ $product->school_name }}</h6>
                                    <h4>{{ $product->category_title }}</h4>
                                    <span class="price">{{ $product->product_name }}</span>
                                </div>
                                <hr>
                                <div class="d-flex" style="justify-content: center;flex-direction: row-reverse;">
                                    <a href="{!! route('ProductShow',['id'=>$product->product_id]) !!}" class="btn btn-info shadow  sharp me-1"><i class="fas fa-eye"></i></a>
                                    <a href="{!! route('ProductEdit',['id'=>$product->product_id]) !!}" class="btn btn-primary shadow  sharp me-1"><i class="fas fa-pencil-alt"></i></a>
                                    <a href="#" onclick="productDelete({{ $product->product_id }});" class="btn btn-danger shadow  sharp"><i class="fa fa-trash"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                @endforeach
                @endif
            </div>
    </div>
</div>
@endsection

@section('js')
    <script src="{{ PUBLIC_DIR }}/Backend/js/owl.carousel.js"></script>
    <script src="{{ PUBLIC_DIR }}/Backend/js/dz.carousel.js"></script>
    <script>

        function productDelete(id){
            Swal.fire({
                title: 'Emin misiniz?',
                text: "Ürün silinecektir!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#1cc88a',
                confirmButtonText: 'Evet, Sil!',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Vazgeç',
            }).then((result) => {
                if (result.value) {
                    if(id){
                        $(this).prop( "disabled", true );
                        $.ajax({
                            url: '{!! route("ProductDelete") !!}',
                            type: "POST",
                            data: { ProductID: id },
                            dataType: 'json',
                            success: function(s){
                                toastr[s.Type](s.Message, s.Title)
                                if(s.Redirect != null){
                                    window.setTimeout( function(){
                                        window.location = s.Redirect
                                    }, 500 );
                                }
                            }
                        });
                    }
                }
            })
        }
    </script>
@endsection
