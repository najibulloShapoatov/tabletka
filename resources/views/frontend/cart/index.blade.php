@extends('frontend.layouts.app')

@section('title', 'Корзина')

@section('styles')
@endsection

@section('content')

    <div class="content-body">


        <div class="page-header border-bottom">
            <div class="container">
                <div class="d-md-flex justify-content-between align-items-center py-4">
                    <h1 class="page-title font-size-3 font-weight-medium m-0 text-lh-lg">Корзина</h1>
                </div>
            </div>
        </div>
        <div class="site-content bg-punch-light overflow-hidden" id="content">
            <div class="container">
                <header class="entry-header space-top-2 space-bottom-1 mb-2">
                    <h1 class="entry-title font-size-7">Ваша корзина:  {{ $data['qnt'] }} товаров</h1>
                </header>
                <div class="row pb-8">
                    <div id="primary" class="content-area">
                        <main id="main" class="site-main ">
                            <div class="page type-page status-publish hentry">

                                <div class="entry-content">
                                    <div class="woocommerce">
                                        <form class="woocommerce-cart-form table-responsive" action="#"
                                              method="post">
                                            <table
                                                class="shop_table shop_table_responsive cart woocommerce-cart-form__contents">
                                                <thead>
                                                <tr>
                                                    <th width="120" class="product-name">&nbsp;</th>
                                                    <th class="product-name">Продукт</th>
                                                    <th class="product-price">Цена</th>
                                                    <th class="product-quantity">Количество</th>
                                                    <th class="product-subtotal">Итого</th>
                                                    <th class="product-remove">&nbsp;</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @if(!empty($data['items']))
                                                    @foreach($data['items'] as $item)
                                                        <tr class="woocommerce-cart-form__cart-item cart_item  cart_item_{{ $item->id }}">
                                                            <td class="product-name" data-title="Product">
                                                                <div class="d-flex align-items-center">
                                                                    <div class="d-block" style="width: 120px; height: 180px">
                                                                    <a data-id="{{ $item->id }}" class="p-img-thumb">
                                                                        @if($item->image)
                                                                        <img src="/public/uploads/products/{{ $item->id .'/thumb_'. $item->image }}"
                                                                             class="attachment-shop_thumbnail size-shop_thumbnail wp-post-image"
                                                                             alt="">
                                                                        @else
                                                                            <img src="/public/frontend/src/images/thumb_no-product-image.jpg"
                                                                             class="attachment-shop_thumbnail size-shop_thumbnail wp-post-image"
                                                                             alt="">
                                                                        @endif

                                                                    </a>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td class="product-name" data-title="Product">
                                                                <div class="d-flex align-items-center">
                                                                    <div class="ml-3 m-w-200-lg-down">
                                                                        <a href="{{ url('/product/'.$item->id) }}">{!! $item->title !!}</a>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td class="product-price" data-title="Price">
                                                            <span class="woocommerce-Price-amount amount"> {{ ($item->is_sale == 1)? $item->price_discount : $item->price }}
                                                                <span class="woocommerce-Price-currencySymbol ml-2">TJS</span></span>
                                                            </td>
                                                            <td class="product-quantity" data-title="Quantity">
                                                                <div class="quantity d-flex align-items-center">

                                                                    <div class="border px-3 width-120">
                                                                        <div class="js-quantity">
                                                                            <div class="d-flex align-items-center">
                                                                                <label
                                                                                    class="screen-reader-text sr-only">Количество</label>
                                                                                <a data-id="{{$item->id}}" class="js-minus-cart text-dark"
                                                                                   href="javascript:;">
                                                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                                                         xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                                         width="10px" height="1px">
                                                                                        <path fill-rule="evenodd"
                                                                                              fill="rgb(22, 22, 25)"
                                                                                              d="M-0.000,-0.000 L10.000,-0.000 L10.000,1.000 L-0.000,1.000 L-0.000,-0.000 Z" />
                                                                                    </svg>
                                                                                </a>
                                                                                <input data-id="{{$item->id}}"  type="text"
                                                                                       class="input-text qty text cart_chg_qnt js-result-cart-{{ $item->id }} form-control text-center border-0"
                                                                                       step="1" min="1" max="100" name="quantity"
                                                                                       value="{{ $item->cart_qnt }}" >
                                                                                <a data-id="{{$item->id}}" class="js-plus-cart text-dark"
                                                                                   href="javascript:;">
                                                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                                                         xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                                         width="10px" height="10px">
                                                                                        <path fill-rule="evenodd"
                                                                                              fill="rgb(22, 22, 25)"
                                                                                              d="M10.000,5.000 L6.000,5.000 L6.000,10.000 L5.000,10.000 L5.000,5.000 L-0.000,5.000 L-0.000,4.000 L5.000,4.000 L5.000,-0.000 L6.000,-0.000 L6.000,4.000 L10.000,4.000 L10.000,5.000 Z" />
                                                                                    </svg>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                            </td>
                                                            <td class="product-subtotal" data-title="">
                                                        <span class="woocommerce-Price-amount amount">
                                                            <span class="price_total_item_{{ $item->id }}">
                                                                {{ number_format((float)( $item->cart_price * $item->cart_qnt ), 2, '.', '') }}
                                                                </span>
                                                            <span class="woocommerce-Price-currencySymbol ml-2">TJS</span></span>
                                                            </td>
                                                            <td class="product-remove">
                                                                <a data-id="{{ $item->id }}" class="remove removeCartItem"
                                                                   aria-label="Удалить">
                                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                                         xmlns:xlink="http://www.w3.org/1999/xlink" width="15px"
                                                                         height="15px">
                                                                        <path fill-rule="evenodd" fill="rgb(22, 22, 25)"
                                                                              d="M15.011,13.899 L13.899,15.012 L7.500,8.613 L1.101,15.012 L-0.012,13.899 L6.387,7.500 L-0.012,1.101 L1.101,-0.012 L7.500,6.387 L13.899,-0.012 L15.011,1.101 L8.613,7.500 L15.011,13.899 Z" />
                                                                    </svg>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @endif
                                                </tbody>
                                            </table>
                                        </form>
                                    </div>
                                </div>

                            </div>
                        </main>
                    </div>
                    <div id="secondary" class="sidebar cart-collaterals order-1" role="complementary">
                        <div id="cartAccordion" class="border border-gray-900 bg-white mb-5">
                            <div class="p-4d875 border">
                                <div id="cartHeadingOne" class="cart-head">
                                    <a class="d-flex align-items-center justify-content-between text-dark" href="#"
                                       data-toggle="collapse" data-target="#cartCollapseOne" aria-expanded="true"
                                       aria-controls="cartCollapseOne">
                                        <h3 class="cart-title mb-0 font-weight-medium font-size-3">Итоги корзины</h3>
                                        <svg class="mins" xmlns="http://www.w3.org/2000/svg"
                                             xmlns:xlink="http://www.w3.org/1999/xlink" width="15px" height="2px">
                                            <path fill-rule="evenodd" fill="rgb(22, 22, 25)"
                                                  d="M0.000,-0.000 L15.000,-0.000 L15.000,2.000 L0.000,2.000 L0.000,-0.000 Z" />
                                        </svg>
                                        <svg class="plus" xmlns="http://www.w3.org/2000/svg"
                                             xmlns:xlink="http://www.w3.org/1999/xlink" width="15px" height="15px">
                                            <path fill-rule="evenodd" fill="rgb(22, 22, 25)"
                                                  d="M15.000,8.000 L9.000,8.000 L9.000,15.000 L7.000,15.000 L7.000,8.000 L0.000,8.000 L0.000,6.000 L7.000,6.000 L7.000,-0.000 L9.000,-0.000 L9.000,6.000 L15.000,6.000 L15.000,8.000 Z" />
                                        </svg>
                                    </a>
                                </div>
                                <div id="cartCollapseOne" class="mt-4 cart-content collapse show"
                                     aria-labelledby="cartHeadingOne" data-parent="#cartAccordion">
                                    <table class="shop_table shop_table_responsive">
                                        <tbody>
                                        <tr class="cart-subtotal">
                                            <th>Итого</th>
                                            <td data-title="Subtotal">
                                                <span class="woocommerce-Price-amount amount">
                                                    <span id="subtotal">{{ $data['sum'] }}</span><span class="woocommerce-Price-currencySymbol ml-2">TJS</span></span>
                                            </td>
                                        </tr>
                                        {{--<tr class="order-shipping">
                                            <th>Доставка</th>
                                            <td data-title="Доставка" class="shipping_text">Самовывоз</td>
                                        </tr>--}}
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                           {{-- <div class="p-4d875 border">
                                <div id="cartHeadingTwo" class="cart-head">
                                    <a class="d-flex align-items-center justify-content-between text-dark" href="#"
                                       data-toggle="collapse" data-target="#cartCollapseTwo" aria-expanded="true"
                                       aria-controls="cartCollapseTwo">
                                        <h3 class="cart-title mb-0 font-weight-medium font-size-3">Доставка</h3>
                                        <svg class="mins" xmlns="http://www.w3.org/2000/svg"
                                             xmlns:xlink="http://www.w3.org/1999/xlink" width="15px" height="2px">
                                            <path fill-rule="evenodd" fill="rgb(22, 22, 25)"
                                                  d="M0.000,-0.000 L15.000,-0.000 L15.000,2.000 L0.000,2.000 L0.000,-0.000 Z" />
                                        </svg>
                                        <svg class="plus" xmlns="http://www.w3.org/2000/svg"
                                             xmlns:xlink="http://www.w3.org/1999/xlink" width="15px" height="15px">
                                            <path fill-rule="evenodd" fill="rgb(22, 22, 25)"
                                                  d="M15.000,8.000 L9.000,8.000 L9.000,15.000 L7.000,15.000 L7.000,8.000 L0.000,8.000 L0.000,6.000 L7.000,6.000 L7.000,-0.000 L9.000,-0.000 L9.000,6.000 L15.000,6.000 L15.000,8.000 Z" />
                                        </svg>
                                    </a>
                                </div>
                                <div id="cartCollapseTwo" class="mt-4 cart-content collapse show"
                                     aria-labelledby="cartHeadingTwo" data-parent="#cartAccordion">

                                    <input type="hidden" value="0" id="shipping_cost">

                                    <ul id="shipping_method">
                                        <li>
                                            <input data-id="0" checked type="radio" name="shipping_method[0]" data-index="0"
                                                   id="shipping_method_0_flat_rate1" value="Самовывоз"
                                                   class="shipping_method">
                                            <label for="shipping_method_0_flat_rate1">Самовывоз</label>
                                        </li>
                                        <li>
                                            <input data-id="{{ $city_cost }}" type="radio" name="shipping_method[0]" data-index="0"
                                                   id="shipping_method_0_flat_rate2" value="Внутри города Душанбе"
                                                   class="shipping_method" >
                                            <label for="shipping_method_0_flat_rate2">Внутри города Душанбе: <span
                                                    class="woocommerce-Price-amount amount">{{ $city_cost }}<span class="woocommerce-Price-currencySymbol ml-2">TJS</span></span></label>
                                        </li>
                                        <li>
                                            <input data-id="{{ $no_city_cost }}" type="radio" name="shipping_method[0]" data-index="0"
                                                   id="shipping_method_0_flat_rate3" value="За городом"
                                                   class="shipping_method" >
                                            <label for="shipping_method_0_flat_rate3">За городом: <span
                                                    class="woocommerce-Price-amount amount">{{ $no_city_cost }}<span class="woocommerce-Price-currencySymbol ml-2">TJS</span></span></label>
                                        </li>
                                    </ul>
                                </div>
                            </div>--}}
                            <div class="p-4d875 border">
                                <table class="shop_table shop_table_responsive">
                                    <tbody>
                                    <tr class="order-total">
                                        <th>Всего</th>
                                        <td data-title="Total">
                                            <strong>
                                                <span class="woocommerce-Price-amount amount">
                                                    <span id="total">{{ $data['sum'] }}</span><span class="woocommerce-Price-currencySymbol ml-3">TJS</span>
                                                </span>
                                            </strong>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="wc-proceed-to-checkout">
                            <a href="{{ url('/checkout') }}" class="checkout-button button alt wc-forward btn btn-dark btn-block rounded-0 py-4">
                                Оформить заказ
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection


@section('scripts')
    <script>
        $('body').addClass('right-sidebar woocommerce-cart');
    </script>
@endsection
