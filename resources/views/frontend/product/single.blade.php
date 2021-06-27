@extends('frontend.layouts.app')

@section('title', 'Продукт')

@section('styles')
@endsection

@section('content')

    <div class="content-body">

        <div class="page-header border-bottom mb-8">
            <div class="container">
                <div class="d-md-flex justify-content-between align-items-center py-4">
                    <h1 class="page-title font-size-3 font-weight-medium m-0 text-lh-lg">Продукт</h1>
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
        <div id="primary" class="content-area">
            <main id="main" class="site-main ">
                <div class="product">
                    <div class="bg-single-product">
                        <div class="container">
                            <div class="row">
                                <div
                                    class="col-md-4 col-wd-5 woocommerce-product-gallery woocommerce-product-gallery--with-images images">
                                    <figure class="woocommerce-product-gallery__wrapper pt-8 mb-0">
                                        <div class="js-slick-carousel u-slick"
                                             data-pagi-classes="text-center u-slick__pagination my-4">
                                            <div class="js-slide" style="display: flex; justify-content: center">
                                                <div class="p-img">
                                                @if($product->image)
                                                    <img src="/public/uploads/products/{{ $product->id .'/' . $product->image }}" alt="Image Description" class="mx-auto img-fluid">
                                                @else
                                                    <img src="/public/frontend/src/images/no-product-image.jpg" alt="Image Description" class="mx-auto img-fluid">
                                                @endif
                                                </div>
                                            </div>
                                            @if(count($product->galery) > 0)
                                                @foreach($product->galery as $g)
                                                    <div class="js-slide" style="display: flex; justify-content: center">
                                                        <div class="p-img">
                                                        <img src="/public/uploads/products/{{ $g->product_id .'/' . $g->image }}" alt="Image Description"
                                                             class="mx-auto img-fluid">
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>
                                    </figure>
                                </div>
                                <div class="col-md-8 col-wd-7 pl-0 summary entry-summary">
                                    <div class="space-top-2 px-4 px-xl-5 px-wd-7 pb-5">
                                        <h1 class="product_title entry-title font-size-7 mb-3">{{ $product->title }}</h1>
                                        <div class="font-size-2 mb-4">

                                        <p class="price font-size-22 mt-5 font-weight-medium mb-3">
                                        <span class="woocommerce-Price-amount amount">
                                            <span class="woocommerce-Price-currencySymbol mr-2">{{ ($product->is_sale==1)? $product->price_discount : $product->price }}</span>TJS
                                        </span>
                                        </p>
                                        <div class="mb-2 mt-5 font-size-2">
                                            <span class="font-weight-medium">Категория :</span>
                                            <span class="ml-2 text-gray-600">{{ $product->category->title }}</span>
                                        </div>

                                        {{--<div class="woocommerce-product-details__short-description font-size-2 mb-5">
                                            <p class="">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                                                eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim
                                                veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
                                                commodo consequat. Excepteur sint occaecat.</p>
                                        </div>--}}
                                        <form class="cart d-md-flex align-items-center flex-wrap mt-5" method="post"
                                              enctype="multipart/form-data">
                                            <div class="quantity mb-4 mb-md-0 d-flex align-items-center">

                                                <div class="border px-3 width-125">
                                                    <div class="js-quantity">
                                                        <div class="d-flex align-items-center">
                                                            <label class="screen-reader-text sr-only">Количество</label>
                                                            <a class="js-minus text-dark" href="javascript:;">
                                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                                     xmlns:xlink="http://www.w3.org/1999/xlink" width="10px"
                                                                     height="1px">
                                                                    <path fill-rule="evenodd" fill="rgb(22, 22, 25)"
                                                                          d="M-0.000,-0.000 L10.000,-0.000 L10.000,1.000 L-0.000,1.000 L-0.000,-0.000 Z" />
                                                                </svg>
                                                            </a>
                                                            <input id="qnt-product" type="number"
                                                                   class="bg-single-product input-text qty text js-result form-control text-center border-0"
                                                                   step="1" min="1" max="100" name="quantity" value="1"
                                                                   >
                                                            <a class="js-plus text-dark" href="javascript:;">
                                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                                     xmlns:xlink="http://www.w3.org/1999/xlink" width="10px"
                                                                     height="10px">
                                                                    <path fill-rule="evenodd" fill="rgb(22, 22, 25)"
                                                                          d="M10.000,5.000 L6.000,5.000 L6.000,10.000 L5.000,10.000 L5.000,5.000 L-0.000,5.000 L-0.000,4.000 L5.000,4.000 L5.000,-0.000 L6.000,-0.000 L6.000,4.000 L10.000,4.000 L10.000,5.000 Z" />
                                                                </svg>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                            <button data-id="{{ $product->id }}"  type="submit" name="add-to-cart" value="7145"
                                                    class=" addToCart mb-4 mb-md-0 btn btn-filter border-0 rounded-0 p-3 min-width-250 ml-md-4 single_add_to_cart_button button alt">Добавить в корзину</button>

                                            <ul class="list-unstyled nav ml-xl-5 mt-md-4 mt-xl-0">
                                                <li class="mr-6 mb-4 mb-md-0">
                                                    @php
                                                        $wishlistSts = \App\Model\Cart::getStatus($product->id);
                                                    @endphp
                                                    <span  id="addtowish"
                                                             data-id="{{ $product->id }}"
                                                             data-sts="{{ $wishlistSts }}"
                                                             class="h-primary cursor-pointer wishlist_{{$product->id}}">
                                                    <i class="flaticon-heart mr-2"></i> Добавить в мои желания
                                                    </span>
                                                </li>

                                            </ul>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="woocommerce-tabs wc-tabs-wrapper mb-10">

                        <ul class="tabs wc-tabs nav bg-single-product pb-6 justify-content-md-center flex-nowrap flex-md-wrap overflow-auto overflow-md-visble"
                            id="pills-tab" role="tablist">
                            <li class="flex-shrink-0 flex-md-shrink-1 nav-item">
                                <a class="py-2 nav-link font-weight-medium active" id="pills-one-example1-tab"
                                   data-toggle="pill" href="#pills-one-example1" role="tab"
                                   aria-controls="pills-one-example1" aria-selected="true">
                                    Описание
                                </a>
                            </li>
                            <li class="flex-shrink-0 flex-md-shrink-1 nav-item">
                                <a class="py-2 nav-link font-weight-medium" id="pills-two-example1-tab" data-toggle="pill"
                                   href="#pills-two-example1" role="tab"
                                   aria-controls="pills-two-example1" aria-selected="false">
                                    Инструкция
                                </a>
                            </li>
                        </ul>


                        <div class="tab-content container" id="pills-tabContent">
                            <div class="woocommerce-Tabs-panel panel col-xl-8 offset-xl-2 entry-content wc-tab tab-pane fade pt-9 show active"
                                 id="pills-one-example1" role="tabpanel" aria-labelledby="pills-one-example1-tab">
                                {!! html_entity_decode($product->description) !!}
                            </div>
                            <div class="woocommerce-Tabs-panel panel col-xl-8 offset-xl-2 entry-content wc-tab tab-pane fade pt-9"
                                 id="pills-two-example1" role="tabpanel" aria-labelledby="pills-two-example1-tab">

                                <div class="table-responsive mb-4">
                                    {!! html_entity_decode($product->instruction) !!}
                                </div>

                            </div>
                        </div>
                    </div>

                    @if(count($productRecomend)>0)
                        <section class="space-bottom-3">
                            <div class="container">
                                <header class="mb-5 d-md-flex justify-content-between align-items-center">
                                    <h2 class="font-size-7 mb-3 mb-md-0">С этим также покупают</h2>
                                </header>
                                <div class="js-slick-carousel products no-gutters "
                                     data-arrows-classes="u-slick__arrow u-slick__arrow-centered--y"
                                     data-arrow-left-classes="fas fa-chevron-left u-slick__arrow-inner u-slick__arrow-inner--left ml-lg-n7"
                                     data-arrow-right-classes="fas fa-chevron-right u-slick__arrow-inner u-slick__arrow-inner--right mr-lg-n7"
                                     data-slides-show="4" data-responsive='[{
                                   "breakpoint": 1500,
                                   "settings": {
                                     "slidesToShow": 4
                                   }
                                },{
                                   "breakpoint": 1199,
                                   "settings": {
                                     "slidesToShow": 3
                                   }
                                }, {
                                   "breakpoint": 992,
                                   "settings": {
                                     "slidesToShow": 2
                                   }
                                }, {
                                   "breakpoint": 554,
                                   "settings": {
                                     "slidesToShow": 2
                                   }
                                }]'>
                                    @foreach($productRecomend as $pr)
                                        @php
                                            $item = $pr->product;
                                            @endphp
                                            <div class="product">
                                            <div class="product__inner overflow-hidden bg-white p-3 p-md-4 cat-on-home ml-3 mr-3 mb-5">
                                                <div
                                                    class="woocommerce-LoopProduct-link woocommerce-loop-product__link d-block position-relative">
                                                    <div class="woocommerce-loop-product__thumbnail">
                                                        <a href="{{ url('/product/' . $item->id) }}" class="d-block">
                                                            <img
                                                                @php
                                                                    $imgsrc = ($item->image)? '/public/uploads/products/'.$item->id.'/thumb_'.$item->image : '/public/frontend/src/images/thumb_no-product-image.jpg';
                                                                @endphp
                                                                src="{{ $imgsrc }}"
                                                                class="img-fluid d-block mx-auto attachment-shop_catalog size-shop_catalog wp-post-image"
                                                                alt="image-description"></a>
                                                    </div>
                                                    <div class="woocommerce-loop-product__body product__body pt-3 bg-white">
                                                        <div class="text-uppercase font-size-1 mb-1 text-truncate">
                                                            <a class="text-category-on-product" href="{{ url('/products/'. $item->category->id) }}">{!! $item->category->title !!}</a>
                                                        </div>
                                                        <h2
                                                            class="woocommerce-loop-product__title product__title h6 text-lh-md mb-1 text-height-2 crop-text-2 h-dark">
                                                            <a href="{{ url('/product/' . $item->id) }}">
                                                                {!! mb_substr($item->title, 0, 35) !!}
                                                            </a>
                                                        </h2>
                                                        <div
                                                            class="price d-flex align-items-center font-weight-medium font-size-3">
                                                                    <span class="woocommerce-Price-amount amount d-flex">
                                                                        <span class=  "woocommerce-Price-currencySymbol d-flex mr-1 ">
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
                                                        <a data-id="{{ $item->id }}"
                                                           class=" addOneToCart text-uppercase text-dark h-dark font-weight-medium mr-auto"
                                                           data-toggle="tooltip" data-placement="right"
                                                           data-original-title="В корзину">
                                                            <span class="product__add-to-cart">В корзину</span>
                                                            <span class="product__add-to-cart-icon font-size-4"><i
                                                                    class="flaticon-icon-126515"></i></span>
                                                        </a>
                                                        <a data-id="{{ $item->id }}"
                                                           @php
                                                               $wishlistSts = \App\Model\Cart::getStatus($item->id);
                                                           @endphp
                                                           data-sts="{{ $wishlistSts }}"
                                                           id="addtowish"
                                                           class="h-p-bg btn btn-outline-primary border-0">
                                                            <i class="flaticon-heart"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </section>
                    @endif
                </div>
            </main>
        </div>


    </div>

@endsection


@section('scripts')
@endsection
