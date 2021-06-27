<h6 class="font-weight-medium font-size-7 ml-lg-1 mb-lg-8 pb-xl-1">
    <span id="back_to_orders" class="cursor-pointer"><i class="flaticon-left-arrow"></i> Назад</span>
</h6>
<table class="table">
    <thead>
    <tr class="border">
        <th scope="col"
            class="py-3 border-bottom-0 font-weight-medium pl-3 pl-lg-5 text-center">#
        </th>
        <th scope="col" class="py-3 border-bottom-0 font-weight-medium text-center">Продукт
        </th>
        <th scope="col" class="py-3 border-bottom-0 font-weight-medium text-center">Количество
        </th>
        <th scope="col" class="py-3 border-bottom-0 font-weight-medium text-center">Цена за 1
        </th>
        <th scope="col" class="py-3 border-bottom-0 font-weight-medium text-center">Итого
        </th>
    </tr>
    </thead>
    <tbody>
    @if(count($or->items)>0)
        @foreach($or->items as $i)
            @php
            $item = $i->product;
            @endphp
            <tr class="border">
                <th class="pl-3 pl-md-5 font-weight-normal align-middle py-6 text-center">
                    <div class="d-flex align-items-center">
                        <a data-id="{{$item->id}}" class="d-block p-img-thumb">
                            @if($item->image)
                                <img src="/public/uploads/products/{{ $item->id . '/thumb_' . $item->image }}" class="img-fluid"alt="image-description">
                            @else
                                <img src="/public/frontend/src/images/no-product-image.jpg" class="img-fluid"alt="image-description">
                            @endif
                        </a>
                    </div>
                </th>
                <th class="pl-3 pl-md-5 font-weight-normal align-middle py-6">
                    <div class="d-flex align-items-center">
                        <div class="ml-xl-4">
                            <div class="font-weight-normal">
                                <a href="{{ url('/product/' . $item->id) }}" class="text-dark">{!! mb_substr($item->title, 0, 70) !!}</a>
                            </div>
                            <div class="font-size-2"> {!! $item->category->title !!}
                            </div>
                        </div>
                    </div>
                </th>


                <td class="align-middle py-5 text-center">{{ $i->quantity }}</td>
                <td class="align-middle py-5 text-center" width="15%">{{ $i->price }} TJS</td>
                <td class="align-middle py-5 text-center" width="15%">
                    <span class="text-primary">{{ number_format(((float) $i->price * $i->quantity), 2, '.', '') }}</span>  TJS
                </td>
            </tr>
        @endforeach
    @endif
    </tbody>
</table>
