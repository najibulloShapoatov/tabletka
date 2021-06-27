@extends('frontend.layouts.app')

@section('title', 'Категория')

@section('styles')
    <!-- Plugins CSS -->
    <link rel="stylesheet" href="/public/assets/css/plugins/plugins.css">
@endsection

@section('content')
    <div class="content-body">


        <div class="page-header border-bottom mb-8">
            <div class="container">
                <div class="d-md-flex justify-content-between align-items-center py-4">
                    <h1 class="page-title font-size-3 font-weight-medium m-0 text-lh-lg">{!! $cat->title !!} </h1>
                    {{--
                    <nav class="woocommerce-breadcrumb font-size-2">
                        <a href="../home/index.html" class="h-primary">Home</a>
                        <span class="breadcrumb-separator mx-1"><i class="fas fa-angle-right"></i></span>
                        <a href="v6.html" class="h-primary">Electronics</a>
                        <span class="breadcrumb-separator mx-1"><i class="fas fa-angle-right"></i></span>
                        <a href="v6.html" class="h-primary">Cameras</a>
                        <span class="breadcrumb-separator mx-1"><i class="fas fa-angle-right"></i></span>Build Your DSLR
                    </nav>--}}
                </div>
            </div>
        </div>
        <div class="site-content space-bottom-3" id="content">
            <div class="container">
                <div class="row">
                    <div class="d-flex">
                    <div id="primary" class="content-area order-2">
                        <div class="shop-control-bar d-lg-flex justify-content-between align-items-center mb-5 text-center text-md-left">
                            <div class="shop-control-bar__left mb-4 m-lg-0">
                                <p class="woocommerce-result-count m-0"> {{ $pcount }} продуктов</p>
                            </div>
                            <div class="shop-control-bar__right d-md-flex align-items-center">
                                <form class="woocommerce-ordering mb-4 m-md-0" method="get">
                                    @php
                                        use Illuminate\Support\Facades\Cookie;
                                        $sort = Cookie::get('sort');
                                        $sort = (empty($sort))? 'default' : $sort;
                                    @endphp
                                    <select id="sort_products" class="js-select selectpicker dropdown-select orderby" name="orderby" data-style="border-bottom shadow-none outline-none py-2">
                                        <option {{ ($sort == 'default')? 'selected':'' }} value="default">По умолчанию</option>
                                        {{--                                        <option {{ ($sort == 'popularity')? 'selected':'' }} value="popularity">Самые популярные</option>--}}
                                        <option {{ ($sort == 'bestseller')? 'selected':'' }} value="bestseller">Самые продаваемые</option>
                                        <option {{ ($sort == 'sale')? 'selected':'' }} value="sale">Скидки</option>
                                        <option {{ ($sort == 'new')? 'selected':'' }} value="new">Новинки </option>
                                        <option {{ ($sort == 'price-desc')? 'selected':'' }} value="price-desc">Стоимость (↓)</option>
                                        <option {{ ($sort == 'price-asc')? 'selected':'' }} value="price-asc">Стоимость (↑)</option>
                                    </select>

                                </form>
                                {{--<form class="number-of-items ml-md-4 mb-4 m-md-0 d-none d-xl-block" method="get">

                                    <select class="js-select selectpicker dropdown-select orderby" name="orderby" data-style="border-bottom shadow-none outline-none py-2" data-width="fit">
                                        <option value="show10">Show 10</option>
                                        <option value="show15">Show 15</option>
                                        <option value="show20" selected="selected">Show 20</option>
                                        <option value="show25">Show 25</option>
                                        <option value="show30">Show 30</option>
                                    </select>

                                </form>--}}
                                <ul class="nav nav-tab ml-lg-4 justify-content-center justify-content-md-start ml-md-auto" id="pills-tab" role="tablist">
                                    <li class="nav-item border">
                                        <a class="nav-link p-0 height-38 width-38 justify-content-center d-flex align-items-center active" id="pills-one-example1-tab" data-toggle="pill" href="#pills-one-example1" role="tab" aria-controls="pills-one-example1" aria-selected="true">
                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="17px" height="17px">
                                                <path fill-rule="evenodd" fill="rgb(25, 17, 11)" d="M-0.000,0.000 L3.000,0.000 L3.000,3.000 L-0.000,3.000 L-0.000,0.000 Z" />
                                                <path fill-rule="evenodd" fill="rgb(25, 17, 11)" d="M7.000,0.000 L10.000,0.000 L10.000,3.000 L7.000,3.000 L7.000,0.000 Z" />
                                                <path fill-rule="evenodd" fill="rgb(25, 17, 11)" d="M14.000,0.000 L17.000,0.000 L17.000,3.000 L14.000,3.000 L14.000,0.000 Z" />
                                                <path fill-rule="evenodd" fill="rgb(25, 17, 11)" d="M-0.000,7.000 L3.000,7.000 L3.000,10.000 L-0.000,10.000 L-0.000,7.000 Z" />
                                                <path fill-rule="evenodd" fill="rgb(25, 17, 11)" d="M7.000,7.000 L10.000,7.000 L10.000,10.000 L7.000,10.000 L7.000,7.000 Z" />
                                                <path fill-rule="evenodd" fill="rgb(25, 17, 11)" d="M14.000,7.000 L17.000,7.000 L17.000,10.000 L14.000,10.000 L14.000,7.000 Z" />
                                                <path fill-rule="evenodd" fill="rgb(25, 17, 11)" d="M-0.000,14.000 L3.000,14.000 L3.000,17.000 L-0.000,17.000 L-0.000,14.000 Z" />
                                                <path fill-rule="evenodd" fill="rgb(25, 17, 11)" d="M7.000,14.000 L10.000,14.000 L10.000,17.000 L7.000,17.000 L7.000,14.000 Z" />
                                                <path fill-rule="evenodd" fill="rgb(25, 17, 11)" d="M14.000,14.000 L17.000,14.000 L17.000,17.000 L14.000,17.000 L14.000,14.000 Z" />
                                            </svg>
                                        </a>
                                    </li>
                                    <li class="nav-item border">
                                        <a class="nav-link p-0 height-38 width-38 justify-content-center d-flex align-items-center" id="pills-two-example1-tab" data-toggle="pill" href="#pills-two-example1" role="tab" aria-controls="pills-two-example1" aria-selected="false">
                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="23px" height="17px">
                                                <path fill-rule="evenodd" fill="rgb(25, 17, 11)" d="M-0.000,0.000 L3.000,0.000 L3.000,3.000 L-0.000,3.000 L-0.000,0.000 Z" />
                                                <path fill-rule="evenodd" fill="rgb(25, 17, 11)" d="M7.000,0.000 L23.000,0.000 L23.000,3.000 L7.000,3.000 L7.000,0.000 Z" />
                                                <path fill-rule="evenodd" fill="rgb(25, 17, 11)" d="M-0.000,7.000 L3.000,7.000 L3.000,10.000 L-0.000,10.000 L-0.000,7.000 Z" />
                                                <path fill-rule="evenodd" fill="rgb(25, 17, 11)" d="M7.000,7.000 L23.000,7.000 L23.000,10.000 L7.000,10.000 L7.000,7.000 Z" />
                                                <path fill-rule="evenodd" fill="rgb(25, 17, 11)" d="M-0.000,14.000 L3.000,14.000 L3.000,17.000 L-0.000,17.000 L-0.000,14.000 Z" />
                                                <path fill-rule="evenodd" fill="rgb(25, 17, 11)" d="M7.000,14.000 L23.000,14.000 L23.000,17.000 L7.000,17.000 L7.000,14.000 Z" />
                                            </svg>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-one-example1" role="tabpanel" aria-labelledby="pills-one-example1-tab">

                                <ul class="products list-unstyled row no-gutters row-cols-2 row-cols-lg-3 ml-3 row-cols-wd-4 mb-6">

                                     @if(count($products) > 0)
                                        @foreach($products as $item)
                                            <li class="product col">
                                                <div class="product__inner product-cart overflow-hidden mr-5 mb-5 p-3 p-md-4d875">
                                                    <div class="woocommerce-LoopProduct-link woocommerce-loop-product__link d-block position-relative">
                                                        <div class="woocommerce-loop-product__thumbnail">
                                                            <a href="{{ url('/product/' . $item->id) }}" class="d-block">
                                                                @if($item->image)
                                                                    <img src="/public/uploads/products/{{ $item->id . '/thumb_' . $item->image }}" class="img-fluid d-block mx-auto attachment-shop_catalog size-shop_catalog wp-post-image img-fluid" alt="image-description">
                                                                @else
                                                                    <img src="/public/frontend/src/images/thumb_no-product-image.jpg" class="img-fluid d-block mx-auto attachment-shop_catalog size-shop_catalog wp-post-image img-fluid" alt="image-description">
                                                                @endif
                                                            </a>
                                                        </div>
                                                        <div class="woocommerce-loop-product__body product__body pt-3 bg-white">
                                                            <div class="text-uppercase font-size-1 mb-1 text-truncate">
                                                                <a href="{{ url('/products/'. $item->category->id) }}">{!! $item->category->title !!}</a></div>
                                                            <h2 class="woocommerce-loop-product__title product__title h6 text-lh-md mb-1 text-height-2 crop-text-2 h-dark">
                                                                <a href="{{ url('/product/'. $item->id) }}">{!! mb_substr($item->title, 0, 30) !!}</a></h2>
{{--                                                            <div class="font-size-2  mb-1 text-truncate"><a href="../others/authors-single.html" class="text-gray-700">Jay Shetty</a></div>--}}
                                                            <div class="price d-flex align-items-center font-weight-medium font-size-3">
                                                                <span class="woocommerce-Price-amount amount">
                                                                    <span class="woocommerce-Price-currencySymbol ">
                                                                        @if($item->is_sale == 1)
                                                                            <span class="text-line-trought color-red fz-13">{!! $item->price !!}</span>
                                                                            <span class="ml-1">{!! $item->price_discount !!}</span>
                                                                        @else
                                                                            <span>{!! $item->price !!}</span>
                                                                        @endif
                                                                    </span>TJS
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <div class="product__hover d-flex align-items-center">
                                                            <a data-id="{{ $item->id }}" class=" addOneToCart text-uppercase text-dark h-dark font-weight-medium mr-auto" data-toggle="tooltip" data-placement="right" title="" data-original-title="В корзину">
                                                                <span class="product__add-to-cart cursor-pointer">B корзину</span>
                                                                <span class="product__add-to-cart-icon font-size-4"><i class="flaticon-icon-126515"></i></span>
                                                            </a>
                                                            {{--<a href="single-product-" class="mr-1 h-p-bg btn btn-outline-primary border-0">
                                                                <i class="flaticon-switch"></i>
                                                            </a>--}}
                                                            @php
                                                                $wishlistSts = \App\Model\Cart::getStatus($item->id);
                                                            @endphp
                                                            <a  data-id="{{ $item->id }}" data-sts="{{ $wishlistSts }}" id="addtowish" class="h-p-bg btn btn-outline-primary border-0">
                                                                <i class="flaticon-heart"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        @endforeach
                                    @endif
                                </ul>

                            </div>
                            <div class="tab-pane fade" id="pills-two-example1" role="tabpanel" aria-labelledby="pills-two-example1-tab">

                                <ul class="products list-unstyled ml-3 mb-6">
                                    @if(count($products)>0)
                                        @foreach($products as $item)
                                            <li class="product product__list">
                                                <div class="product__inner overflow-hidden p-3 p-md-4d875">
                                                    <div class="woocommerce-LoopProduct-link woocommerce-loop-product__link row position-relative">
                                                        <div class="col-md-auto woocommerce-loop-product__thumbnail thumb mb-3 mb-md-0">
                                                            <a href="{{ url('/product/'. $item->id ) }}" class="d-block">
                                                            @if($item->image)
                                                                <img src="/public/uploads/products/{{ $item->id . '/thumb_' . $item->image }}" class="img-fluid d-block mx-auto attachment-shop_catalog size-shop_catalog wp-post-image img-fluid" alt="image-description">
                                                            @else
                                                                <img src="/public/frontend/src/images/thumb_no-product-image.jpg" class="img-fluid d-block mx-auto attachment-shop_catalog size-shop_catalog wp-post-image img-fluid" alt="image-description">
                                                            @endif
                                                                </a>
                                                        </div>
                                                        <div class="col-md woocommerce-loop-product__body product__body pt-3 bg-white mb-3 mb-md-0">
                                                            <div class="text-uppercase font-size-1 mb-1 text-truncate"><a href="{{ url('/products/'. $item->category->id) }}">{!! $item->category->title !!}</a></div>
                                                            <h2 class="woocommerce-loop-product__title product__title h6 text-lh-md mb-1 crop-text-2 h-dark"><a href="{{ url('/product/'. $item->id) }}" tabindex="0">{!! mb_substr($item->title, 0, 100) !!}</a></h2>
{{--                                                            <div class="font-size-2  mb-2 text-truncate"><a href="../others/authors-single.html" class="text-gray-700">Jay Shetty</a></div>--}}
{{--                                                            <p class="font-size-2 mb-2 crop-text-2">After disappearing for three years, Artemis Fowl has returned to a life different from the one he left. And spends his days teaching his twin siblings the</p>--}}
                                                            <div class="price d-flex align-items-center font-weight-medium font-size-3">
                                                                <span class="woocommerce-Price-amount amount">
                                                                    <span class="woocommerce-Price-currencySymbol ">
                                                                        @if($item->is_sale == 1)
                                                                            <span class="text-line-trought color-red fz-13">{!! $item->price !!}</span>
                                                                            <span class="ml-1">{!! $item->price_discount !!}</span>
                                                                        @else
                                                                            <span>{!! $item->price !!}</span>
                                                                        @endif
                                                                    </span>TJS
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-auto d-flex align-items-center">
                                                            <a data-id="{{$item->id}}" class="addOneToCart text-uppercase text-dark h-dark font-weight-medium mr-4" data-toggle="tooltip" data-placement="right" title="" data-original-title="В корзину">
                                                                <span class="product__add-to-cart">В корзину</span>
                                                                <span class="product__add-to-cart-icon font-size-4"><i class="flaticon-icon-126515"></i></span>
                                                            </a>
                                                            {{--<a href="single-product-" class="mr-1 h-p-bg btn btn-outline-primary border-0">
                                                                <i class="flaticon-switch"></i>
                                                            </a>--}}
                                                            @php
                                                                $wishlistSts = \App\Model\Cart::getStatus($item->id);
                                                            @endphp
                                                            <a data-id="{{ $item->id }}" data-sts="{{ $wishlistSts }}" id="addtowish" class="h-p-bg btn btn-outline-primary border-0">
                                                                <i class="flaticon-heart"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        @endforeach
                                    @endif
                                </ul>

                            </div>
                        </div>
                        {!! $products->links() !!}

                    </div>
                    <div id="secondary" class="sidebar widget-area order-1" role="complementary">
                        <div id="widgetAccordion">
                            <div id="woocommerce_product_categories-2" class="widget p-4d875 border woocommerce widget_product_categories">
                                <div id="widgetHeadingOne" class="widget-head">
                                    <a class="d-flex align-items-center justify-content-between text-dark" href="#" data-toggle="collapse" data-target="#widgetCollapseOne" aria-expanded="true" aria-controls="widgetCollapseOne">
                                        <h3 class="widget-title mb-0 font-weight-medium font-size-3">Категории</h3>
                                        <svg class="mins" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="15px" height="2px">
                                            <path fill-rule="evenodd" fill="rgb(22, 22, 25)" d="M0.000,-0.000 L15.000,-0.000 L15.000,2.000 L0.000,2.000 L0.000,-0.000 Z" />
                                        </svg>
                                        <svg class="plus" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="15px" height="15px">
                                            <path fill-rule="evenodd" fill="rgb(22, 22, 25)" d="M15.000,8.000 L9.000,8.000 L9.000,15.000 L7.000,15.000 L7.000,8.000 L0.000,8.000 L0.000,6.000 L7.000,6.000 L7.000,-0.000 L9.000,-0.000 L9.000,6.000 L15.000,6.000 L15.000,8.000 Z" />
                                        </svg>
                                    </a>
                                </div>
                                <div id="widgetCollapseOne" class="mt-3 widget-content collapse show" aria-labelledby="widgetHeadingOne" data-parent="#widgetAccordion">
                                    <ul class="product-categories">
                                        @if(count($cats) > 0)
                                            @foreach($cats as $c)
                                                @if($c->parent_id == $cat->id)
                                                    <li class="cat-item cat-item-9 cat-parent">
                                                        <a href="{{ url('/products/' . $c->id) }}">{!! $c->title !!}</a>
                                                    </li>
                                                @endif
                                            @endforeach
                                        @endif

                                    </ul>
                                </div>
                            </div>
                            <div id="woocommerce_price_filter-2" class="widget p-4d875 border woocommerce widget_price_filter">
                                <div id="widgetHeadingTwo" class="widget-head">
                                    <a class="d-flex align-items-center justify-content-between text-dark" href="#" data-toggle="collapse" data-target="#widgetCollapseTwo" aria-expanded="true" aria-controls="widgetCollapseTwo">
                                        <h3 class="widget-title mb-0 font-weight-medium font-size-3">
                                            Фильтр по цене</h3>
                                        <svg class="mins" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="15px" height="2px">
                                            <path fill-rule="evenodd" fill="rgb(22, 22, 25)" d="M0.000,-0.000 L15.000,-0.000 L15.000,2.000 L0.000,2.000 L0.000,-0.000 Z" />
                                        </svg>
                                        <svg class="plus" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="15px" height="15px">
                                            <path fill-rule="evenodd" fill="rgb(22, 22, 25)" d="M15.000,8.000 L9.000,8.000 L9.000,15.000 L7.000,15.000 L7.000,8.000 L0.000,8.000 L0.000,6.000 L7.000,6.000 L7.000,-0.000 L9.000,-0.000 L9.000,6.000 L15.000,6.000 L15.000,8.000 Z" />
                                        </svg>
                                    </a>
                                </div>
                                <div id="widgetCollapseTwo" class="mt-4 widget-content collapse show" aria-labelledby="widgetHeadingTwo" data-parent="#widgetAccordion">
                                    <form >
                                        <div class="box">
                                            <div class="box-body">
                                                <input type="text" class="ion-range-2" />
                                            </div>
                                        </div>
                                        <div class="col-12 d-flex mt-3 justify-content-end">
                                            <button id="change_filter" type="button" class="btn btn-filter mb-1 float-right" style="padding: 7px 12px;">Пременить</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            @if(count($hotest) > 0)
                                <div id="Featuredbooks" class="widget p-4d875 border">
                                    <div id="widgetHeading25" class="widget-head">
                                        <a class="d-flex align-items-center justify-content-between text-dark" href="#" data-toggle="collapse" data-target="#widgetCollapse25" aria-expanded="true" aria-controls="widgetCollapse25">
                                            <h3 class="widget-title mb-0 font-weight-medium font-size-3">Популярные продукты</h3>
                                            <svg class="mins" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="15px" height="2px">
                                                <path fill-rule="evenodd" fill="rgb(22, 22, 25)" d="M0.000,-0.000 L15.000,-0.000 L15.000,2.000 L0.000,2.000 L0.000,-0.000 Z" />
                                            </svg>
                                            <svg class="plus" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="15px" height="15px">
                                                <path fill-rule="evenodd" fill="rgb(22, 22, 25)" d="M15.000,8.000 L9.000,8.000 L9.000,15.000 L7.000,15.000 L7.000,8.000 L0.000,8.000 L0.000,6.000 L7.000,6.000 L7.000,-0.000 L9.000,-0.000 L9.000,6.000 L15.000,6.000 L15.000,8.000 Z" />
                                            </svg>
                                        </a>
                                    </div>
                                    <div id="widgetCollapse25" class="mt-5 widget-content collapse show" aria-labelledby="widgetHeading25" data-parent="#widgetAccordion">
                                        @foreach($hotest as $item)
                                            <div class="mb-5">
                                                <div class="media d-md-flex">
                                                    <a class="d-block" href="{{ url('/product/'. $item->id) }}">
                                                        <img class="img-fluid" src="{{ ($item->image)? '/public/uploads/products/'.$item->id.'/thumb_'.$item->image :'/public/frontend/src/images/thumb_no-product-image.jpg' }}" alt="no-image" style="width: 80px">
                                                    </a>
                                                    <div class="media-body ml-3 pl-1">
                                                        <h6 class="font-size-2 text-lh-md font-weight-normal title-top-product">
                                                            <a href="{{ url('/product/'. $item->id) }}">{!! mb_substr($item->title, 0, 25) !!}</a>
                                                        </h6>
                                                        <span class="font-weight-medium price-top-product">{{ ($item->is_sale==1)? $item->price_discount: $item->price }} &nbsp;TJS</span>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    </div>
                </div>
            </div>
        </div>



    </div>
    @php
        $from = (empty(Cookie::get('filter_from')))? '1' : Cookie::get('filter_from');
        $to = (empty(Cookie::get('filter_to')))? '5000' : Cookie::get('filter_to');
    @endphp
@endsection


@section('scripts')
    <script>
        $('body').addClass('left-sidebar');
    </script>
    <!-- Plugins & Activation JS For Only This Page -->
    <script src="/public/assets/js/plugins/ion-rangeslider/ion.rangeSlider.min.js"></script>
    <script>

        (function ($) {
            "use strict";
            /*Ion Range Slider 2*/
            let from;
            let to;
            if( $('.ion-range-2').length ) {
                $('.ion-range-2').ionRangeSlider({
                    skin: 'round',
                    type: 'double',
                    min: 1,
                    max: 5000,
                    from: {{ $from }},
                    to: {{ $to }},
                    step: 1,
                    onStart: updateInputs,
                    onChange: updateInputs,
                    onFinish: updateInputs
                });
            }
            function updateInputs (data) {
                from = data.from;
                to = data.to;
            }

            $(document).on('click', '#change_filter', function () {
                let formData = new FormData();
                formData.append('from', from);
                formData.append('to', to);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-Token': $('meta[name=csrf-token]').attr('content')
                    }
                });
                $.ajax({
                    url: '/change-filter',
                    data: formData,
                    type: "POST",
                    contentType: false,
                    cache: false,
                    processData: false,
                    //dataType: 'json',
                    success: function (data) {
                        location.reload();
                    },
                    error: function (data) {
                        console.log(data);
                    }
                });
            });

        })(jQuery);
    </script>
@endsection
