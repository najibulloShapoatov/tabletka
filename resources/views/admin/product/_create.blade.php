<tr  class="text-center" style="vertical-align: middle" id="table_item_adm_{{ $data->id }}">
    <th width="15%"  style="vertical-align: middle">
        @if($data->image)
            <div class="image-cat">
                <img src="/public/uploads/products/{{ $data->id . '/'. $data->image }}" alt="">
            </div>
        @else
            Нет фото
        @endif
    </th>
    <td width="20%" class="text-center" style="vertical-align: middle"> <strong>{!! mb_substr($data->title, 0, 15) !!}</strong></td>
    <td class="text-center"  style="vertical-align: middle">{!! $data->articul !!}</td>
    {{--                                        <td class="text-center" style="vertical-align: middle">{!! $item->slug !!}</td>--}}
    <td class="text-center" style="vertical-align: middle">{!! $data->price !!}</td>
    <td class="text-center" style="vertical-align: middle">{!! $data->price_discount !!}</td>
    <td class="text-center" style="vertical-align: middle">{!! $data->quantity !!}</td>
    <td width="170" class="text-center act"  style="vertical-align: middle">
        <span data-id="{{ $data->id }}" id="edit_product" class="ti-pencil edit-item mr-10"></span>
        <span  data-id="{{ $data->id }}" id="delete_product" class="ti-trash delete-item"></span>
    </td>
</tr>
