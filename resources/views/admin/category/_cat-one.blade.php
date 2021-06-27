
    <th width="15%"  style="vertical-align: middle">
        @if($data->image)
            <div class="image-cat">
                <img src="/public/uploads/categories/{{ $data->id . '/'. $data->image }}" alt="">
            </div>
        @else
            Нет фото
        @endif
    </th>
    <td class="text-center" style="vertical-align: middle"> <strong>{!! $data->sort_order !!}</strong></td>
    <td class="text-center"  style="vertical-align: middle">{!! $data->title !!}</td>
    <td class="text-center" style="vertical-align: middle">{!! $data->slug !!}</td>
    <td width="170" class="text-center act"  style="vertical-align: middle">
        <span data-id="{{ $data->id }}" id="edit_category" class="ti-pencil edit-item mr-10"></span>
        <span data-id="{{ $data->id }}" id="show_category" class="ti-menu edit-item mr-10"></span>
        <span  data-id="{{ $data->id }}" id="delete_category" class="ti-trash delete-item"></span>
    </td>
