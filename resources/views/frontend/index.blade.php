@extends('frontend.layouts.app')

@section('title', 'Главная')

@section('styles')
@endsection

@section('content')

    <div class="content-body">
        <section class=" banner-with-product " style="margin-top: 2rem;">
            <div class="container">
                <div class="row">


                        @if(count($homeCategories)>0)
                            @foreach($homeCategories as $item)
                                <div class="col-md-3 col-sm-6 mb-30">
                                    <div class="home-cat-item position-relative ">
                                        <a href="{{ url('/category/'. $item->id) }}">
                                            @if($item->image)
                                                <img src="/public/uploads/categories/{{ $item->id . '/'. $item->image }}" alt="">
                                            @else
                                                <img src="/public/Rectangle.png" alt="">
                                            @endif
                                            <div class="position-absolute top-25-procent ml-26px">
                                            <span class="text-on-home-category">{!! mb_substr($item->title, 0, 50) !!}</span>
                                            </div>
                                            </a>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                </div>
            </div>
        </section>

        <!-- New Releases -->
        <section class="space-bottom-3 banner-with-product " style="margin-top: 2rem;">
            <div class="container">
                <header class="mb-5 d-md-flex justify-content-between align-items-center">
                    <h2 class="font-size-7 mb-3 mb-md-0 text-title-home">Популярные</h2>
                    <ul class="nav nav-gray-700 flex-nowrap flex-md-wrap overflow-auto overflow-md-visible"
                        role="tablist">
                        <li class="nav-item mx-4 flex-shrink-0 flex-md-shrink-1">
                            <a class="nav-link custom-nav-link pb-1 px-0 active" id="history-tab" data-toggle="tab" href="#allpopularProd"
                               role="tab" aria-controls="allpopularProd" aria-selected="true">Все</a>
                        </li>
                        @if(!empty($popular['popularCategories']))
                            @foreach($popular['popularCategories'] as $cat)
                                @php
                                $pcat = (new \App\Model\Category())->getByID($cat->id);
                                @endphp
                                <li class="nav-item mx-4 flex-shrink-0 flex-md-shrink-1">
                                    <a class="nav-link custom-nav-link pb-1 px-0 " id="history-tab" data-toggle="tab" href="#{!! $pcat->slug !!}"
                                       role="tab" aria-controls="history-1" aria-selected="true">{!! $pcat->title !!}</a>
                                </li>
                            @endforeach
                        @endif
                    </ul>
                </header>
                <div class="tab-content u-slick__tab">

                    <div class="tab-pane fade show active" id="allpopularProd" role="tabpanel" aria-labelledby="history-tab">
                        <div class="row no-gutters">
                            <div class="col-xl-4 border-right-0 border bg-blue-cee px-1" style="margin-bottom: 2.8rem !important;">
                                <div
                                    class="banner px-lg-8 px-3 py-4 py-xl-0 d-flex h-100 align-items-center justify-content-center">
                                    <div class="banner__body">
                                        <div class="banner__image pb-1 mb-5">
                                            <img class="img-fluid" src="/public/frontend/src/images/banner1.png"
                                                 alt="image-description">
                                        </div>
                                        <h3 class="banner_text m-0">
                                            <span class="d-block mb-1 text-title-baner-1">Получи</span>
                                            <span class="d-block mb-3 text-banner-sale-25pr">Скидку в -25%</span>
                                            <span
                                                class="d-block mb-5 text-uppercase text-banner-300som">ПРИ ПОКУПКИ НА СУММУ 300 TJS.</span>
                                        </h3>
                                        <a href="#" class="btn btn-primary btn-wide btn-banner-1 rounded-0">Подробнее</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-8">
                                <ul
                                     {{--style="margin-bottom:-30px" --}} class="products list-unstyled row no-gutters row-cols-2 row-cols-lg-3 row-cols-wd-3  ">
                                    @if(!empty($popular['allPopularProducts']))
                                        @foreach($popular['allPopularProducts'] as $item)
                                            <li class="product col">
                                                <div class="product__inner overflow-hidden home ml-30 mb-30 p-md-3d2">
                                                    <div
                                                        class="woocommerce-LoopProduct-link woocommerce-loop-product__link d-block position-relative">
                                                        <div class="woocommerce-loop-product__thumbnail">
                                                            <a href="{{ url('/product/'. $item->id) }}" class="d-block">
                                                                <img
                                                                    @php
                                                                    $imgSrc = ($item->image)? '/public/uploads/products/'.$item->id.'/thumb_'.$item->image :'/public/frontend/src/images/thumb_no-product-image.jpg'
                                                                    @endphp
                                                                    src="{{$imgSrc}}"
                                                                    class="img-fluid d-block mx-auto attachment-shop_catalog size-shop_catalog wp-post-image img-fluid"
                                                                    alt="image-description"></a>
                                                        </div>
                                                        <div class="woocommerce-loop-product__body product__body pt-3 bg-white">
                                                            <div class="text-uppercase font-size-1 mb-1 text-truncate">
                                                                @php
                                                                $itemcat = \App\Model\Category::where('id', $item->category_id)->get()->first();
                                                                @endphp
                                                                <a class="text-category-on-product" href="{{ url('/products/'. $itemcat->id) }}">{!! $itemcat->title !!}</a>
                                                            </div>
                                                            <h2
                                                                class="woocommerce-loop-product__title product__title h6 text-lh-md mb-1 text-height-2 crop-text-2 h-dark">
                                                                <a href="{{ url('/product/'. $item->id) }}">{!! mb_substr($item->title, 0, 35) !!}</a></h2>
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
                                                               title="В корзину">
                                                                <span class="product__add-to-cart">В корзину</span>
                                                                <span class="product__add-to-cart-icon font-size-4"><i
                                                                        class="flaticon-icon-126515"></i></span>
                                                            </a>
                                                            <a data-id="{{ $item->id }}"
                                                               @php
                                                               $wSTS = \App\Model\Cart::getStatus($item->id)
                                                               @endphp
                                                               data-sts="{{ $wSTS }}"
                                                               id="addtowish"
                                                               class="h-p-bg btn btn-outline-primary border-0">
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
                    </div>




                    @if(!empty($popular['popularCategories']))
                        @foreach($popular['popularCategories'] as $cat)
                            @php
                                $pcat = (new \App\Model\Category())->getByID($cat->id);
                            @endphp
                            <div class="tab-pane fade" id="{{ $pcat->slug }}" role="tabpanel" aria-labelledby="sciencemath-tab">
                                <div class="row no-gutters">
                                    <div class="col-xl-4 border-right-0 border bg-blue-cee px-1">
                                        <div
                                            class="banner px-lg-8 px-3 py-4 py-xl-0 d-flex h-100 align-items-center justify-content-center">
                                            <div class="banner__body">
                                                <div class="banner__image pb-1 mb-5">
                                                    <img class="img-fluid" src="/public/frontend/src/img/350x282/img1.png"
                                                         alt="image-description">
                                                </div>
                                                <h3 class="banner_text m-0">
                                                    <span class="d-block mb-1 font-size-10 font-weight-regular">Get Extra</span>
                                                    <span class="d-block mb-3 font-size-12 text-primary font-weight-medium">Sale
                                                        -25%</span>
                                                    <span
                                                        class="d-block mb-5 text-uppercase font-size-7 font-weight-regular text-gray-400">On
                                                        Order Over $100</span>
                                                </h3>
                                                <a href="#" class="btn btn-primary btn-wide rounded-0">View
                                                    More</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-8">
                                        <ul
                                             style="margin-bottom:-30px"  class="products list-unstyled row no-gutters row-cols-2 row-cols-lg-3 row-cols-wd-4    ">
                                            @foreach($popular['popularProductCategories'] as $key => $products)
                                                @if($cat->id == $key)
                                                    @foreach($products as $item)
                                                        <li class="product col">
                                                            <div class="product__inner overflow-hidden home  ml-30 mb-30 p-md-3d2">
                                                                <div
                                                                    class="woocommerce-LoopProduct-link woocommerce-loop-product__link d-block position-relative">
                                                                    <div class="woocommerce-loop-product__thumbnail">
                                                                        <a href="{{ url('/product/'. $item->id) }}" class="d-block">
                                                                            <img
                                                                                @php
                                                                                    $imgSrc = ($item->image)? '/public/uploads/products/'.$item->id.'/thumb_'.$item->image :'/public/frontend/src/images/thumb_no-product-image.jpg'
                                                                                @endphp
                                                                                src="{{$imgSrc}}"
                                                                                class="img-fluid d-block mx-auto attachment-shop_catalog size-shop_catalog wp-post-image img-fluid"
                                                                                alt="image-description"></a>
                                                                    </div>
                                                                    <div class="woocommerce-loop-product__body product__body pt-3 bg-white">
                                                                        <div class="text-uppercase font-size-1 mb-1 text-truncate">
                                                                            @php
                                                                                $itemcat = \App\Model\Category::where('id', $item->category_id)->get()->first();
                                                                            @endphp
                                                                            <a class="text-category-on-product" href="{{ url('/products/'. $itemcat->id) }}">{!! $itemcat->title !!}</a>
                                                                        </div>
                                                                        <h2
                                                                            class="woocommerce-loop-product__title product__title h6 text-lh-md mb-1 text-height-2 crop-text-2 h-dark">
                                                                            <a href="{{ url('/product/'. $item->id) }}">{!! mb_substr($item->title, 0, 35) !!}</a></h2>
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
                                                                           title="В корзину">
                                                                            <span class="product__add-to-cart">В корзину</span>
                                                                            <span class="product__add-to-cart-icon font-size-4"><i
                                                                                    class="flaticon-icon-126515"></i></span>
                                                                        </a>
                                                                        <a data-id="{{ $item->id }}"
                                                                           @php
                                                                               $wSTS = \App\Model\Cart::getStatus($item->id)
                                                                           @endphp
                                                                           data-sts="{{ $wSTS }}"
                                                                           id="addtowish"
                                                                           class="h-p-bg btn btn-outline-primary border-0">
                                                                            <i class="flaticon-heart"></i>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    @endforeach
                                                @endif
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </section>
        <!-- end New Releases -->

        <!-- Товары дня -->
        <section class="space-bottom-1 space-bottom-lg-3">
            <div class="bg-blue-cee space-2 space-lg-3">
                <div class="container ">
                    <div class="d-md-flex justify-content-between">
                        <header class="mb-4">
                            <h2 class="font-size-7 text-title-home">Товары дня</h2>
                        </header>
                        <ul class="nav justify-content-md-center nav-gray-700 mb-5 flex-nowrap flex-lg-wrap overflow-auto overflow-lg-visible"
                            role="tablist">
                            <li class="nav-item mx-5 mb-1 flex-shrink-0 flex-lg-shrink-1">
                                <a class="nav-link custom-nav-link px-0 active" id="example1-tab" data-toggle="tab" href="#newest"
                                   role="tab" aria-controls="newest" aria-selected="true">Новинка</a>
                            </li>
                            <li class="nav-item mx-5 mb-1 flex-shrink-0 flex-lg-shrink-1">
                                <a class="nav-link custom-nav-link px-0" id="example2-tab" data-toggle="tab" href="#salest" role="tab"
                                   aria-controls="salest" aria-selected="false">Скидки</a>
                            </li>
                            <li class="nav-item mx-5 mb-1 flex-shrink-0 flex-lg-shrink-1">
                                <a class="nav-link custom-nav-link px-0" id="example3-tab" data-toggle="tab" href="#top_sold" role="tab"
                                   aria-controls="top_sold" aria-selected="false">Топ продажи</a>
                            </li>
                            <li class="nav-item mx-5 mb-1 flex-shrink-0 flex-lg-shrink-1">
                                <a class="nav-link custom-nav-link px-0" id="example4-tab" data-toggle="tab" href="#most_viewed" role="tab"
                                   aria-controls="most_viewed" aria-selected="false">Просматриваемые</a>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-content" id="featuredBooksContent">
{{--                        Newest --}}
                        <div class="tab-pane fade show active" id="newest" role="tabpanel"
                             aria-labelledby="example1-tab">
                            <ul
                                 style="margin-bottom:-30px; margin-left: -30px;"  class="products list-unstyled row no-gutters row-cols-2 row-cols-md-4 row-cols-lg-4 row-cols-wd-4    ">
                                @if(count($pday['new'])> 0)
                                    @foreach($pday['new'] as $item)
                                        <li class="product col">
                                            <div class="product__inner overflow-hidden bg-white home-product-day  ml-30 mb-30 p-md-3d2">
                                                <div
                                                    class="woocommerce-LoopProduct-link woocommerce-loop-product__link d-block position-relative">
                                                    <div class="woocommerce-loop-product__thumbnail">
                                                        <a href="{{ url('/product/' . $item->id) }}" class="d-block">
                                                            <img
                                                                @if($item->image)
                                                                src="/public/uploads/products/{{ $item->id . '/thumb_' . $item->image }}"
                                                                @else
                                                                src="/public/frontend/src/images/thumb_no-product-image.jpg"
                                                                @endif
                                                                class="img-fluid d-block mx-auto attachment-shop_catalog size-shop_catalog wp-post-image img-fluid"
                                                                alt="image-description"></a>
                                                    </div>
                                                    <div class="woocommerce-loop-product__body product__body pt-3 bg-white">
                                                        <div class="text-uppercase font-size-1 mb-1 text-truncate">
                                                            <a class="text-category-on-product" href="{{ url('/products/' .$item->category->id) }}">{{ $item->category->title }}</a></div>
                                                        <h2
                                                            class="woocommerce-loop-product__title product__title h6 text-lh-md mb-1 text-height-2 crop-text-2 h-dark">
                                                            <a href="{{ url('/product/' . $item->id) }}">{!! mb_substr($item->title, 0, 35) !!}</a>
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
                                                        <a
                                                            data-id="{{ $item->id }}"
                                                           class=" addOneToCart cursor-pointer text-uppercase text-dark h-dark font-weight-medium mr-auto"
                                                           data-toggle="tooltip" data-placement="right" title="В корзину">
                                                            <span class="product__add-to-cart">В корзину</span>
                                                            <span class="product__add-to-cart-icon font-size-4"><i
                                                                    class="flaticon-icon-126515"></i></span>
                                                        </a>
                                                        <a data-id="{{ $item->id }}"
                                                           @php
                                                               $wishlistSts = \App\Model\Cart::getStatus($item->id);
                                                           @endphp
                                                           data-sts = "{{ $wishlistSts }}"
                                                           id="addtowish"
                                                           class="h-p-bg btn btn-outline-primary border-0">
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



                        <div class="tab-pane fade" id="salest" role="tabpanel" aria-labelledby="example2-tab">
                            <ul
                                 style="margin-bottom:-30px"  class="products list-unstyled row no-gutters row-cols-2 row-cols-md-4 row-cols-lg-4 row-cols-wd-4    ">
                                @if(count($pday['sale'])> 0)
                                    @foreach($pday['sale'] as $item)
                                        <li class="product col">
                                            <div class="product__inner overflow-hidden bg-white home-product-day  ml-30 mb-30 p-md-3d2">
                                                <div
                                                    class="woocommerce-LoopProduct-link woocommerce-loop-product__link d-block position-relative">
                                                    <div class="woocommerce-loop-product__thumbnail">
                                                        <a href="{{ url('/product/' . $item->id) }}" class="d-block">
                                                            <img
                                                                @if($item->image)
                                                                src="/public/uploads/products/{{ $item->id . '/thumb_' . $item->image }}"
                                                                @else
                                                                src="/public/frontend/src/images/thumb_no-product-image.jpg"
                                                                @endif
                                                                class="img-fluid d-block mx-auto attachment-shop_catalog size-shop_catalog wp-post-image img-fluid"
                                                                alt="image-description"></a>
                                                    </div>
                                                    <div class="woocommerce-loop-product__body product__body pt-3 bg-white">
                                                        <div class="text-uppercase font-size-1 mb-1 text-truncate">
                                                            <a class="text-category-on-product" href="{{ url('/products/' .$item->category->id) }}">{{ $item->category->title }}</a></div>
                                                        <h2
                                                            class="woocommerce-loop-product__title product__title h6 text-lh-md mb-1 text-height-2 crop-text-2 h-dark">
                                                            <a href="{{ url('/product/' . $item->id) }}">{!! mb_substr($item->title, 0, 35) !!}</a>
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
                                                        <a
                                                            data-id="{{ $item->id }}"
                                                            class=" addOneToCart cursor-pointer text-uppercase text-dark h-dark font-weight-medium mr-auto"
                                                            data-toggle="tooltip" data-placement="right" title="В корзину">
                                                            <span class="product__add-to-cart">В корзину</span>
                                                            <span class="product__add-to-cart-icon font-size-4"><i
                                                                    class="flaticon-icon-126515"></i></span>
                                                        </a>
                                                        <a data-id="{{ $item->id }}"
                                                           @php
                                                               $wishlistSts = \App\Model\Cart::getStatus($item->id);
                                                           @endphp
                                                           data-sts = "{{ $wishlistSts }}"
                                                           id="addtowish"
                                                           class="h-p-bg btn btn-outline-primary border-0">
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
                        <div class="tab-pane fade" id="top_sold" role="tabpanel" aria-labelledby="example3-tab">
                            <ul
                                 style="margin-bottom:-30px"  class="products list-unstyled row no-gutters row-cols-2 row-cols-md-4 row-cols-lg-4 row-cols-wd-4    ">
                                @if(count($pday['sold'])> 0)
                                    @foreach($pday['sold'] as $item)
                                        <li class="product col">
                                            <div class="product__inner overflow-hidden bg-white home-product-day  ml-30 mb-30 p-md-3d2">
                                                <div
                                                    class="woocommerce-LoopProduct-link woocommerce-loop-product__link d-block position-relative">
                                                    <div class="woocommerce-loop-product__thumbnail">
                                                        <a href="{{ url('/product/' . $item->id) }}" class="d-block">
                                                            <img
                                                                @if($item->image)
                                                                src="/public/uploads/products/{{ $item->id . '/thumb_' . $item->image }}"
                                                                @else
                                                                src="/public/frontend/src/images/thumb_no-product-image.jpg"
                                                                @endif
                                                                class="img-fluid d-block mx-auto attachment-shop_catalog size-shop_catalog wp-post-image img-fluid"
                                                                alt="image-description"></a>
                                                    </div>
                                                    <div class="woocommerce-loop-product__body product__body pt-3 bg-white">
                                                        <div class="text-uppercase font-size-1 mb-1 text-truncate">
                                                            <a class="text-category-on-product" href="{{ url('/products/' .$item->category->id) }}">{{ $item->category->title }}</a></div>
                                                        <h2
                                                            class="woocommerce-loop-product__title product__title h6 text-lh-md mb-1 text-height-2 crop-text-2 h-dark">
                                                            <a href="{{ url('/product/' . $item->id) }}">{!! mb_substr($item->title, 0, 35) !!}</a>
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
                                                        <a
                                                            data-id="{{ $item->id }}"
                                                            class=" addOneToCart cursor-pointer text-uppercase text-dark h-dark font-weight-medium mr-auto"
                                                            data-toggle="tooltip" data-placement="right" title="В корзину">
                                                            <span class="product__add-to-cart">В корзину</span>
                                                            <span class="product__add-to-cart-icon font-size-4"><i
                                                                    class="flaticon-icon-126515"></i></span>
                                                        </a>
                                                        <a data-id="{{ $item->id }}"
                                                           @php
                                                               $wishlistSts = \App\Model\Cart::getStatus($item->id);
                                                           @endphp
                                                           data-sts = "{{ $wishlistSts }}"
                                                           id="addtowish"
                                                           class="h-p-bg btn btn-outline-primary border-0">
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
                        <div class="tab-pane fade" id="most_viewed" role="tabpanel" aria-labelledby="example4-tab">
                            <ul
                                 style="margin-bottom:-30px"  class="products list-unstyled row no-gutters row-cols-2 row-cols-md-4 row-cols-lg-4 row-cols-wd-4    ">
                                @if(count($pday['viewed'])> 0)
                                    @foreach($pday['viewed'] as $item)
                                        <li class="product col">
                                            <div class="product__inner overflow-hidden bg-white home-product-day  ml-30 mb-30 p-md-3d2">
                                                <div
                                                    class="woocommerce-LoopProduct-link woocommerce-loop-product__link d-block position-relative">
                                                    <div class="woocommerce-loop-product__thumbnail">
                                                        <a href="{{ url('/product/' . $item->id) }}" class="d-block">
                                                            <img
                                                                @if($item->image)
                                                                src="/public/uploads/products/{{ $item->id . '/thumb_' . $item->image }}"
                                                                @else
                                                                src="/public/frontend/src/images/thumb_no-product-image.jpg"
                                                                @endif
                                                                class="img-fluid d-block mx-auto attachment-shop_catalog size-shop_catalog wp-post-image img-fluid"
                                                                alt="image-description"></a>
                                                    </div>
                                                    <div class="woocommerce-loop-product__body product__body pt-3 bg-white">
                                                        <div class="text-uppercase font-size-1 mb-1 text-truncate">
                                                            <a class="text-category-on-product" href="{{ url('/products/' .$item->category->id) }}">{{ $item->category->title }}</a></div>
                                                        <h2
                                                            class="woocommerce-loop-product__title product__title h6 text-lh-md mb-1 text-height-2 crop-text-2 h-dark">
                                                            <a href="{{ url('/product/' . $item->id) }}">{!! mb_substr($item->title, 0, 35) !!}</a>
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
                                                        <a
                                                            data-id="{{ $item->id }}"
                                                            class=" addOneToCart cursor-pointer text-uppercase text-dark h-dark font-weight-medium mr-auto"
                                                            data-toggle="tooltip" data-placement="right" title="В корзину">
                                                            <span class="product__add-to-cart">В корзину</span>
                                                            <span class="product__add-to-cart-icon font-size-4"><i
                                                                    class="flaticon-icon-126515"></i></span>
                                                        </a>
                                                        <a data-id="{{ $item->id }}"
                                                           @php
                                                               $wishlistSts = \App\Model\Cart::getStatus($item->id);
                                                           @endphp
                                                           data-sts = "{{ $wishlistSts }}"
                                                           id="addtowish"
                                                           class="h-p-bg btn btn-outline-primary border-0">
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
                </div>
            </div>
        </section>
        <!-- end Tovariy dnya  -->

        <!-- Most Popular For Food and Drink Books -->
        @if(count($catHome['one']['items']) >0)
            <section class="space-bottom-3 banner-with-product-carousel">
                <div class="container">
                    <h6 class="font-size-7 font-weight-medium mb-5 text-title-home">{!! $catHome['one']['cat']->title !!}</h6>
                    <div class="row">
                        <div class="col-lg-5 col-wd-4 pt-15 pb-15">
                            <div class="mb-8 mb-lg-0" style="height: 100%">
                                <div class="bg-img-hero img-fluid"
                                     style="background-image: url(/public/frontend/src/images/banner2.png); height: 100%">
                                    <div class="p-5 pl-lg-6 pr-lg-5 pt-lg-20pr pb-lg-5">
                                        <div class="mb-4 mb-lg-2 ml-5">
                                            <h2 class="font-size-26 mb-2 pb-1 mt-lg-1 ">
                                                <span class="hero__title-line-1 font-weight-bold d-block mb-2 text-banner-2-1">Получи</span>
                                                <span class="hero__title-line-2 d-block text-banner-2-2">
                                                    Скидку
                                                    <br/> -25%
                                                </span>
                                            </h2>
                                            <span class="h6 d-flex justify-content-end text-banner-2-3 " >ПРИ ПОКУПКИ НА СУММУ 300 TJS.</span>
                                        </div>
                                        {{--<div class="d-flex justify-content-end mt-n5">
                                            <img src="/public/frontend/src/img/250x225/img1.png"
                                                 class="img-fluid attachment-shop_catalog size-shop_catalog wp-post-image"
                                                 alt="image-description">
                                        </div>--}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-7 col-wd-8">
                            <div class="position-relative pt-4 pt-lg-0">
                                <div class="js-slick-carousel cat-one-home products no-gutters  position-static"
                                     data-arrows-classes="d-none d-lg-block position-absolute right-0 top-0 mt-n5 mt-lg-n9 arrow-cursor"
                                     data-arrow-left-classes="flaticon-back mr-5" data-arrow-right-classes="flaticon-next"
                                     data-pagi-classes="d-lg-none text-center u-slick__pagination position-absolute right-0 left-0 bottom-0 mb-n8"
                                     data-slides-show="3" data-responsive='[{
                                       "breakpoint": 1500,
                                       "settings": {
                                         "slidesToShow": 3
                                       }
                                    },{
                                       "breakpoint": 1199,
                                       "settings": {
                                         "slidesToShow": 2
                                       }
                                    }, {
                                       "breakpoint": 768,
                                       "settings": {
                                         "slidesToShow": 2
                                       }
                                    }]'>
                                    @foreach($catHome['one']['items'] as $item)
                                        <div class="product">
                                            <div class="product__inner overflow-hidden bg-white p-3 p-md-4 mx-3 cat-on-home">
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
                        </div>
                    </div>
                </div>
            </section>
        @endif
        <!-- end Most Popular For Food and Drink Books -->

        <!-- Feature Book -->
        <section class="space-bottom-2 space-bottom-lg-3">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="bg-img-hero img-fluid height-300 mb-5 mb-lg-0"
                             style="background-image: url(./public/frontend/src/images/banner-group1-item-1.png);">
                            <div class="p-5 pl-lg-10 pt-3 pt-lg-5">
                                <h2 class="font-size-7 mb-2 pb-1 text-lh-1dot4 banner-group-1">
                                    <span class="hero__title-line-1 font-weight-bold d-block banner-group1-item-1-text-1">Получи</span>
                                    <span class="hero__title-line-2 font-weight-normal d-block banner-group1-item-1-text-2">Скидку <br/> -25%</span>
                                </h2>
                                <span
                                   class="text-uppercase link-black-100 text-dark font-weight-medium">
                                    <span class=" d-inline-block banner-group1-item-1-text-3">ПРИ ПОКУПКИ НА СУММУ 300 TJS.</span>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="bg-img-hero img-fluid height-300 mb-5 mb-lg-0"
                             style="background-image: url(./public/frontend/src/images/banner-group1-item-2.png);">
                            <div class="p-5 pl-lg-6 pt-3 pt-lg-5">
                                <h2 class="font-size-7 mb-2 pb-1 text-lh-1dot4 banner-group-1">
                                    <span class="hero__title-line-1 font-weight-bold d-block banner-group1-item-2-text-1">Получи</span>
                                    <span class="hero__title-line-2 font-weight-normal d-block banner-group1-item-2-text-2">Скидку<br/> -25%</span>
                                </h2>
                                <span
                                   class="text-uppercase link-black-100 text-dark font-weight-medium">
                                    <span class=" d-inline-block banner-group1-item-2-text-3">ПРИ ПОКУПКИ НА СУММУ 300 TJS.</span>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="bg-img-hero img-fluid height-300 mb-5 mb-lg-0"
                             style="background-image: url(./public/frontend/src/images/banner-group1-item-3.png);">
                            <div class="p-5 pl-lg-6 pt-3 pt-lg-5">
                                <h2 class="font-size-7 mb-2 pb-1 text-lh-1dot4 banner-group-1">
                                    <span class="hero__title-line-1 font-weight-bold d-block banner-group1-item-3-text-1">Получи</span>
                                    <span class="hero__title-line-2 font-weight-normal d-block banner-group1-item-3-text-2">Скидку<br/> -25%</span>
                                </h2>
                                <span
                                   class="text-uppercase link-black-100 text-dark font-weight-medium">
                                    <span class=" d-inline-block banner-group1-item-3-text-3">ПРИ ПОКУПКИ НА СУММУ 300 TJS.</span>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- end Feature Book -->
        @if(count($catHome['two']['items']) >0)
            <!-- Biographies Books -->
            <section class="banner-with-product-carousel">
                <div class="bg-blue-cee space-2 space-xl-3">
                    <div class="container">
                        <h6 class="font-size-7 font-weight-medium mb-5 text-title-home">{!! $catHome['two']['cat']->title !!}</h6>
                        <div class="row">
                            <div class="col-lg-5 col-wd-4 mb-5">
                                <div class="mb-8 mb-lg-0" style="height: 100%">
                                    <div class="bg-img-hero img-fluid mb-6 mb-lg-0 height-373"
                                         style="background-image: url(./public/frontend/src/images/banner3.png); height: 100%">
                                        <div class="p-5 pl-lg-8 pr-lg-5 pt-lg-5 pb-lg-5">
                                            <div class="mb-4 mb-lg-2">
                                                <h2 class="font-size-26 mb-2 pb-1 mt-lg-1 text-white">
                                                    <span class="hero__title-line-1 font-weight-bold d-block mb-2 banner-3-text-1">Получи</span>
                                                    <span class="hero__title-line-2 font-weight-normal d-block banner-3-text-2">Скидку<br/> -25%</span>
                                                </h2>
                                                <span class="h6 font-weight-medium text-white banner-3-text-3" >ПРИ ПОКУПКИ НА СУММУ 300 TJS.</span>
                                            </div>
                                            {{--<div class="d-flex justify-content-end mt-n4">
                                                <img src="/public/frontend/src/img/250x217/img1.png"
                                                     class="img-fluid attachment-shop_catalog size-shop_catalog wp-post-image"
                                                     alt="image-description">
                                            </div>--}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-7 col-wd-8">
                                <div class="position-relative pt-4 pt-lg-0">
                                    <div class="js-slick-carousel products no-gutters   border-right position-static"
                                         data-arrows-classes="d-none d-lg-block position-absolute right-0 top-0 mt-n5 mt-lg-n9 arrow-cursor"
                                         data-arrow-left-classes="flaticon-back mr-5"
                                         data-arrow-right-classes="flaticon-next"
                                         data-pagi-classes="d-lg-none text-center u-slick__pagination position-absolute right-0 left-0 bottom-0 mb-n8"
                                         data-slides-show="3" data-responsive='[{
                                       "breakpoint": 1500,
                                       "settings": {
                                         "slidesToShow": 3
                                       }
                                    },{
                                       "breakpoint": 1199,
                                       "settings": {
                                         "slidesToShow": 2
                                       }
                                    }, {
                                       "breakpoint": 768,
                                       "settings": {
                                         "slidesToShow": 2
                                       }
                                    }]'>
                                        @foreach($catHome['two']['items'] as $item)
                                            <div class="product">
                                                <div class="product__inner overflow-hidden bg-white p-3 p-md-4 cat-on-home ml-5 mb-5">
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
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- end Biographies Books -->
        @endif


    </div>
@endsection


@section('scripts')
@endsection
