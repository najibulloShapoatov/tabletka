

<div id="cart_items">
    @if(count($basket['items'])>0)
        @foreach($basket['items'] as $cart)
            <div class="px-4 py-5 px-md-6 border-bottom cart_item_{{ $cart->id }}">
                <div class="media" style="overflow: hidden">
                    <a data-id="{{$cart->id}}" class="d-block p-img-thumb">
                        @if($cart->image)
                            <img src="/public/uploads/products/{{ $cart->id . '/thumb_' . $cart->image }}" class="img-fluid"alt="image-description">
                        @else
                            <img src="/public/frontend/src/images/thumb_no-product-image.jpg" class="img-fluid"alt="image-description">
                        @endif
                    </a>
                    <div class="media-body ml-4d875">
                        <div class="text-primary text-uppercase font-size-1 mb-1 text-truncate">
                            <a href="{{ url('/product/' . $cart->id) }}">
                                {!! $cart->category->title !!}
                            </a>
                        </div>
                        <h2 class="woocommerce-loop-product__title h6 text-lh-md mb-1 text-height-2 crop-text-2">
                            <a href="#" class="text-dark">{!! $cart->title !!}</a>
                        </h2>

                        <div class="price d-flex align-items-center font-weight-medium font-size-3">
                            <span class="woocommerce-Price-amount amount">{{ $cart->cart_qnt }} x  {{ $cart->cart_price }}<span class="woocommerce-Price-currencySymbol"></span>TJS</span>
                        </div>
                    </div>
                    <div class="mt-3 ml-3">
                        <span  data-id="{{ $cart->id }}" class="text-dark cursor-pointer removeCartItem"><i class="fas fa-times"></i></span>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
</div>


<div class="px-4 py-5 px-md-6 d-flex justify-content-between align-items-center font-size-3">
    <h4 class="mb-0 font-size-3">Итого:</h4>
    <div class="font-weight-medium">{{ $basket['sum'] }}  TJS</div>
</div>
<div class="px-4 mb-8 px-md-6">
    <a href="{{ url('/cart') }}" class="btn btn-block py-4 rounded-0 btn-outline-dark mb-4">Корзина</a>
    <a href="{{ url('/checkout') }}" class="btn btn-block py-4 rounded-0 btn-dark">Оформит заказ</a>
</div>

