@if(count($data)>0)
    @foreach($data as $w)
        <div class="px-4 py-5 px-md-6 border-bottom wishlist_item_{{ $w->id }}">
            <div class="media" style="overflow: hidden">
                <a data-id="{{$w->id}}" class="d-block p-img-thumb">
                    @if($w->image)
                        <img src="/public/uploads/products/{{ $w->id . '/thumb_' . $w->image }}" class="img-fluid"alt="image-description">
                    @else
                        <img src="/public/frontend/src/images/no-product-image.jpg" class="img-fluid"alt="image-description">
                    @endif
                </a>
                <div class="media-body ml-4d875">
                    <div class="text-primary text-uppercase font-size-1 mb-1 text-truncate">
                        <a>
                            {!! $w->category->title !!}
                        </a>
                    </div>
                    <h2 class="woocommerce-loop-product__title h6 text-lh-md mb-1 text-height-2 crop-text-2">
                        <a href="{{ url('/product/' . $w->id) }}" class="text-dark">{!! $w->title !!}</a>
                    </h2>

                    <div class="price d-flex align-items-center font-weight-medium font-size-3">
                                                  <span class="woocommerce-Price-amount amount">{{ ($w->is_sale == 1)?$w->price_discount: $w->price }}
                                                      <span class="woocommerce-Price-currencySymbol">TJS</span></span>
                    </div>
                </div>
                <div class="mt-3 ml-3">
                    <span id="removeWishlist" data-id="{{ $w->id }}" class="text-dark cursor-pointer"><i class="fas fa-times"></i></span>
                </div>
            </div>
        </div>
    @endforeach
@endif
