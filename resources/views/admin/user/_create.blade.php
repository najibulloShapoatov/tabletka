<tr id="table_item_adm_{{ $data->id }}">
    <th class="text-center" width="15%"  style="vertical-align: middle">
        @if($data->image)
            <div class="image-cat">
                <img src="/public/uploads/users/{{ $data->id . '/'. $data->image }}" alt="">
            </div>
        @else
            Нет фото
        @endif
    </th>
    <td class="text-center" style="vertical-align: middle"> <strong>{!! $data->name !!}</strong></td>
    <td class="text-center" style="vertical-align: middle"> <strong>{!! $data->roles->title !!}</strong></td>
    <td class="text-center"  style="vertical-align: middle">{!! $data->phone !!}</td>
    <td class="text-center" style="vertical-align: middle">{!! $data->email !!}</td>
    <td  width="170" class="text-center act" style="vertical-align: middle; font-size: 16px;">
        <label  data-id="{{ $data->id }}" id="change_user_active" class="adomx-switch">
            <input  id="sts_{{ $data->id }}" type="checkbox" {{ ($data->is_active == 1)? 'checked' : ""}}>
            <i class="lever"></i>
            <span id="sts_text_{{ $data->id }}" class="text">{{ ($data->is_active == 1)? 'Да' : "Нет"}}</span>
        </label>
    </td>
    <td width="170" class="text-center act"  style="vertical-align: middle">
        <span data-id="{{ $data->id }}" id="edit_user" class="ti-pencil edit-item mr-10"></span>
        <span  data-id="{{ $data->id }}" id="delete_user" class="ti-trash delete-item"></span>
    </td>
</tr>
