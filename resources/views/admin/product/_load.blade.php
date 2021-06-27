
@if(count($data['items']) > 0)
    @foreach($data['items'] as $item)
        <tr  class="text-center" style="vertical-align: middle" id="table_item_adm_{{ $item->id }}">
            <th width="15%"  style="vertical-align: middle">
                @if($item->image)
                    <div class="image-cat">
                        <img src="/public/uploads/products/{{ $item->id . '/'. $item->image }}" alt="">
                    </div>
                @else
                    Нет фото
                @endif
            </th>
            <td width="20%" class="text-center" style="vertical-align: middle"> <strong>{!! mb_substr($item->title, 0, 15) !!}</strong></td>
            <td class="text-center"  style="vertical-align: middle">{!! $item->articul !!}</td>
            {{--                                        <td class="text-center" style="vertical-align: middle">{!! $item->slug !!}</td>--}}
            <td class="text-center" style="vertical-align: middle">{!! $item->price !!}</td>
            <td class="text-center" style="vertical-align: middle">{!! $item->price_discount !!}</td>
            <td class="text-center" style="vertical-align: middle">{!! $item->quantity !!}</td>
            <td width="170" class="text-center act"  style="vertical-align: middle">
                <span data-id="{{ $item->id }}" id="edit_product" class="ti-pencil edit-item mr-10"></span>
                <span  data-id="{{ $item->id }}" id="delete_product" class="ti-trash delete-item"></span>
            </td>
        </tr>
    @endforeach
@endif
