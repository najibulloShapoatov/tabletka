<div id="item_r_prod_{{$prod->id}}" class="col-6 mb-20">
    <div class="r_pod_item" style="border: 1px solid #ccc; border-radius: 4px;">
        <div style="margin: 10px;">
            <div class="d-flex">
                <div class="image-r_prod">
                    @if($prod->image)
                        <img src="/public/uploads/products/{{ $prod->id . '/thumb_'. $prod->image }}" class="mr-3" alt="">
                    @else
                        <img src="/public/frontend/src/images/thumb_no-product-image.jpg" class="mr-3" alt="">
                    @endif
                </div>
                <div class="media-body ml-10">
                    <h4 class="mt-0">{!! mb_substr($prod->title, 0, 23) !!}</h4>
                    <h6>{!! mb_substr($prod->articul, 0, 20) !!}</h6>
                    <p>{{ ($prod->is_sale == 1)? $prod->price_discount : $prod->price }} TJS</p>
                </div>
            </div>
            <span data-id="{{ $prod->id }}" id="delete_item_prod_rec_edit" class="ti-close delete-item" style="position: absolute; top: 5%; right: 2%;"></span>
        </div>
    </div>
</div>
