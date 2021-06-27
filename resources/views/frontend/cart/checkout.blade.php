@extends('frontend.layouts.app')

@section('title', 'Оформления заказа')

@section('styles')
@endsection

@section('content')

    <div class="content-body">



        <div id="content" class="site-content bg-punch-light space-bottom-3">
            <div class="col-full container">
                <div id="primary" class="content-area">
                    <main id="main" class="site-main">
                        <article id="post-6" class="post-6 page type-page status-publish hentry">
                            <header class="entry-header space-top-2 space-bottom-1 mb-2">
                                <h4 class="entry-title font-size-7 text-center">Оформления заказа</h4>
                            </header>

                            @if(!empty($basket['items']))
                            <div class="entry-content">
                                <div class="woocommerce">

                                    <form name="checkout"  class="checkout woocommerce-checkout row mt-8" enctype="multipart/form-data" >
                                        <div class="col2-set col-md-6 col-lg-7 col-xl-8 mb-6 mb-md-0" id="customer_details">
                                            <div class="px-4 pt-5 bg-white border">
                                                <div class="woocommerce-billing-fields">
                                                    <h3 class="mb-4 font-size-3">Платежные реквизиты</h3>
                                                    <div class="woocommerce-billing-fields__field-wrapper row">

                                                        <p class="col-lg-6 mb-4d75 form-row form-row-first validate-required woocommerce-invalid woocommerce-invalid-required-field" id="billing_first_name_field" data-priority="10">
                                                            <label for="billing_first_name" class="form-label">Имя <abbr class="required" title="обязательный">*</abbr></label>
                                                            <input type="text" required class="input-text form-control" name="billing_first_name" id="billing_first_name" placeholder="" value="{{ ($userInfo)? $userInfo->name : '' }}" autocomplete="given-name" autofocus="autofocus">
                                                        </p>
                                                        <p class="col-lg-6 mb-4d75 form-row form-row-last validate-required" id="billing_last_name_field" data-priority="20">
                                                            <label for="billing_last_name" class="form-label">Фамилия</label>
                                                            <input type="text" class="input-text form-control" name="billing_last_name" id="billing_last_name" placeholder="" value="{{ ($userInfo)? $userInfo->surname : '' }}" autocomplete="family-name">
                                                        </p>
                                                        <p class="col-lg-12 col-sm-12 mb-4d75 form-row form-row-last validate-required" id="billing_last_name_field" data-priority="20">
                                                            <label for="order_comments" class="form-label">Адрес <abbr class="required" title="обязательный">*</abbr></label>
                                                            <textarea name="order_comments" required class="input-text form-control" id="billing_address" placeholder="" rows="5" cols="5">{{ ($userInfo)? $userInfo->address : '' }}</textarea>
                                                        </p>
                                                        <p class="col-lg-12 col-sm-12 mb-4d75 form-row form-row-last validate-required" id="billing_last_name_field" data-priority="20">
                                                            <label for="order_comments" class="form-label">Город </label>
                                                            <input type="text" class="input-text form-control" name="billing_city" id="billing_city" placeholder="" value="{{ ($userInfo)? $userInfo->city : '' }}" >
                                                        </p>

                                                        <p class="col-lg-6 mb-4d75 form-row form-row-first validate-required woocommerce-invalid woocommerce-invalid-required-field" id="billing_first_name_field" data-priority="10">
                                                            <label for="billing_first_name" class="form-label">Телефон <abbr class="required" title="обязательный">*</abbr></label>
                                                            <input type="text" required class="input-text form-control"  id="billing_phone" placeholder="" value="{{ ($userInfo)? $userInfo->phone : '' }}" autocomplete="given-name" autofocus="autofocus">
                                                        </p>
                                                        <p class="col-lg-6 mb-4d75 form-row form-row-last validate-required" id="billing_last_name_field" data-priority="20">
                                                            <label for="billing_last_name" class="form-label">E-mail</label>
                                                            <input type="text" class="input-text form-control" name="billing_last_name" id="billing_email" placeholder="" value="{{ ($userInfo)? $userInfo->email : '' }}" autocomplete="family-name">
                                                        </p>







                                                </div>
                                            </div>
                                        </div>
                                        </div>
                                        <div id="order_review" class="col-md-6 col-lg-5 col-xl-4 woocommerce-checkout-review-order">
                                            <div id="checkoutAccordion" class="border border-gray-900 bg-white mb-5">

                                                <div class="p-4d875 border">
                                                    <div id="checkoutHeadingOnee" class="checkout-head">
                                                        <a href="#" class="text-dark d-flex align-items-center justify-content-between" data-toggle="collapse" data-target="#checkoutCollapseOnee" aria-expanded="true" aria-controls="checkoutCollapseOnee">
                                                            <h3 class="checkout-title mb-0 font-weight-medium font-size-3">Ваш заказ</h3>
                                                            <svg class="mins" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="15px" height="2px">
                                                                <path fill-rule="evenodd" fill="rgb(22, 22, 25)" d="M0.000,-0.000 L15.000,-0.000 L15.000,2.000 L0.000,2.000 L0.000,-0.000 Z" />
                                                            </svg>
                                                            <svg class="plus" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="15px" height="15px">
                                                                <path fill-rule="evenodd" fill="rgb(22, 22, 25)" d="M15.000,8.000 L9.000,8.000 L9.000,15.000 L7.000,15.000 L7.000,8.000 L0.000,8.000 L0.000,6.000 L7.000,6.000 L7.000,-0.000 L9.000,-0.000 L9.000,6.000 L15.000,6.000 L15.000,8.000 Z" />
                                                            </svg>
                                                        </a>
                                                    </div>
                                                    <div id="checkoutCollapseOnee" class="mt-4 checkout-content collapse show" aria-labelledby="checkoutHeadingOnee" data-parent="#checkoutAccordion">
                                                        <table class="shop_table woocommerce-checkout-review-order-table">
                                                            <thead class="d-none">
                                                            <tr>
                                                                <th class="product-name">Продукт</th>
                                                                <th class="product-total">Итог</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            @if(count($basket['items']) >0)
                                                                @foreach($basket['items'] as $item)
                                                                    <tr class="cart_item">
                                                                        <td class="product-name">
                                                                            {!! mb_substr($item->title,0, 30) !!}&nbsp; <strong class="product-quantity">× {{ $item->cart_qnt }}</strong>
                                                                        </td>
                                                                        <td class="product-total">
                                                                            <span class="woocommerce-Price-amount amount">{{ $item->cart_price }}<span class="woocommerce-Price-currencySymbol ml-2">TJS</span></span>
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                            @endif
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="p-4d875 border">
                                                    <div id="checkoutHeadingTwo" class="checkout-head">
                                                        <a href="#" class="text-dark d-flex align-items-center justify-content-between" data-toggle="collapse" data-target="#checkoutCollapseTwo" aria-expanded="false" aria-controls="checkoutCollapseTwo">
                                                            <h3 class="checkout-title mb-0 font-weight-medium font-size-3">Доставка</h3>
                                                            <svg class="mins" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="15px" height="2px">
                                                                <path fill-rule="evenodd" fill="rgb(22, 22, 25)" d="M0.000,-0.000 L15.000,-0.000 L15.000,2.000 L0.000,2.000 L0.000,-0.000 Z" />
                                                            </svg>
                                                            <svg class="plus" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="15px" height="15px">
                                                                <path fill-rule="evenodd" fill="rgb(22, 22, 25)" d="M15.000,8.000 L9.000,8.000 L9.000,15.000 L7.000,15.000 L7.000,8.000 L0.000,8.000 L0.000,6.000 L7.000,6.000 L7.000,-0.000 L9.000,-0.000 L9.000,6.000 L15.000,6.000 L15.000,8.000 Z" />
                                                            </svg>
                                                        </a>
                                                    </div>
                                                    <div id="checkoutCollapseTwo" class="mt-4 checkout-content collapse show" aria-labelledby="checkoutHeadingTwo" data-parent="#checkoutAccordion">

                                                        <ul id="shipping_method">
                                                            <input type="hidden" id="shipping_cost"  value="0" data-id="Самовывоз">
                                                            <li>
                                                                <input type="radio" name="shipping_method[0]" checked data-index="0" data-id="Самовывоз" id="shipping_method_0_flat_rate1" value="0" class="shipping_method">
                                                                <label for="shipping_method_0_flat_rate1">Самовывоз</label>
                                                            </li>
                                                            <li>
                                                                <input type="radio" name="shipping_method[0]" data-index="0" data-id="Внутри города" id="shipping_method_0_flat_rate2" value="{{ $city_cost }}" class="shipping_method" >
                                                                <label for="shipping_method_0_flat_rate2">Внутри города:
                                                                    <span class="woocommerce-Price-amount amount">
                                                                        {{ $city_cost }}<span class="woocommerce-Price-currencySymbol ml-2">TJS</span>
                                                                    </span>
                                                                </label>
                                                            </li>
                                                            <li>
                                                                <input type="radio" name="shipping_method[0]" data-index="0" data-id="За городом" id="shipping_method_0_flat_rate3" value="{{ $no_city_cost }}" class="shipping_method" >
                                                                <label for="shipping_method_0_flat_rate3">За городом:
                                                                    <span class="woocommerce-Price-amount amount">
                                                                        {{ $no_city_cost }}<span class="woocommerce-Price-currencySymbol ml-2">TJS</span>
                                                                    </span>
                                                                </label>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="p-4d875 border">
                                                    <table class="shop_table shop_table_responsive">
                                                        <tbody>
                                                        <tr class="order-total">
                                                            <th>Всего</th>
                                                            <td data-title="Total">
                                                                <strong>
                                                                    <span class="woocommerce-Price-amount amount">
                                                                        <span id="total_order">{{ $basket['sum'] }} TJS</span><span class="woocommerce-Price-currencySymbol ml-3">TJS</span>
                                                                    </span>
                                                                </strong>
                                                            </td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="p-4d875 border">
                                                    <div id="checkoutHeadingThreee" class="checkout-head">
                                                        <a href="#" class="text-dark d-flex align-items-center justify-content-between" data-toggle="collapse" data-target="#checkoutCollapseThreee" aria-expanded="true" aria-controls="checkoutCollapseThreee">
                                                            <h3 class="checkout-title mb-0 font-weight-medium font-size-3">Оплата</h3>
                                                            <svg class="mins" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="15px" height="2px">
                                                                <path fill-rule="evenodd" fill="rgb(22, 22, 25)" d="M0.000,-0.000 L15.000,-0.000 L15.000,2.000 L0.000,2.000 L0.000,-0.000 Z" />
                                                            </svg>
                                                            <svg class="plus" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="15px" height="15px">
                                                                <path fill-rule="evenodd" fill="rgb(22, 22, 25)" d="M15.000,8.000 L9.000,8.000 L9.000,15.000 L7.000,15.000 L7.000,8.000 L0.000,8.000 L0.000,6.000 L7.000,6.000 L7.000,-0.000 L9.000,-0.000 L9.000,6.000 L15.000,6.000 L15.000,8.000 Z" />
                                                            </svg>
                                                        </a>
                                                    </div>
                                                    <div id="checkoutCollapseThreee" class="mt-4 checkout-content collapse show" aria-labelledby="checkoutHeadingThreee" data-parent="#checkoutAccordion">
                                                        <div id="payment" class="woocommerce-checkout-payment">
                                                            <input type="hidden" id="payment_method" value="1">
                                                            <ul class="wc_payment_methods payment_methods methods">
                                                                <li class="wc_payment_method payment_method_bacs mb-0 d-table">
                                                                    <input id="payment_method_bacs" type="radio" class="input-radio payment-method" checked name="payment_method" value="1" data-order_button_text="">
                                                                    <label for="payment_method_bacs">Оплата при доставке </label>
                                                                    <div class="payment_box payment_method_bacs" style="display: block;">
                                                                        <p>
                                                                            Вы оплачиваете покупку при получении курьеру.
                                                                        </p>
                                                                    </div>
                                                                </li>
                                                                <li class="wc_payment_method payment_method_cheque mb-0 d-table">
                                                                    <input id="payment_method_cheque" type="radio" class="input-radio payment-method" name="payment_method" value="2" data-order_button_text="">
                                                                    <label for="payment_method_cheque">Корти милли</label>
                                                                    <div class="payment_box payment_method_cheque" style="display: block;">
                                                                        <p>В процессе.</p>
                                                                    </div>
                                                                </li>

                                                                <li class="wc_payment_method payment_method_cod mb-0 d-table">
                                                                    <input id="payment_method_cod" type="radio" class="input-radio payment-method" name="payment_method" value="3"  data-order_button_text="">
                                                                    <label for="payment_method_cod">VISA/Master карты</label>
                                                                    <div class="payment_box payment_method_cod" style="display: block;">
                                                                        <p>В процессе.</p>
                                                                    </div>
                                                                </li>
                                                                <li class="wc_payment_method payment_method_cod mb-0 d-table">
                                                                    <input id="payment_method_alif" type="radio" class="input-radio payment-method" name="payment_method" value="4"  data-order_button_text="">
                                                                    <label for="payment_method_alif">Alif mobi</label><br>
                                                                    <div class="payment_box payment_method_cod" style="display: block;">
                                                                        <p>В процессе.</p>
                                                                    </div>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-row place-order">
                                                <span id="make_order" class="button alt btn btn-dark btn-block rounded-0 py-4">Оформить заказ</span>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            @else
                                <div class="col-12 mb-3">
                                    <div class="alert alert-lg alert-danger">
                                        Не имея товаров в корзине, пытаетесь оформить заказ :)
                                    </div>
                                </div>
                            @endif

                        </article>

                    </main>

                </div>

            </div>

        </div>



    </div>
@endsection


@section('scripts')
    <script>
        $('body').addClass('right-sidebar woocommerce-checkout u-unfold-opened');
    </script>
@endsection
