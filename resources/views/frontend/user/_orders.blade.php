<table class="table">
    <thead>
    <tr class="border">
        <th scope="col"
            class="py-3 border-bottom-0 font-weight-medium pl-3 pl-lg-5">Заказ №
        </th>
        <th scope="col" class="py-3 border-bottom-0 font-weight-medium">Дата
        </th>
        <th scope="col" class="py-3 border-bottom-0 font-weight-medium">Статус
        </th>
        <th scope="col" class="py-3 border-bottom-0 font-weight-medium">Итог
        </th>
        <th scope="col" class="py-3 border-bottom-0 font-weight-medium">Действие
        </th>
    </tr>
    </thead>
    <tbody>
    @if(count($ordrs)>0)
        @foreach($ordrs as $item)
            <tr class="border">
                <th class="pl-3 pl-md-5 font-weight-normal align-middle py-6">#{!! $item->order_number !!}
                </th>
                <td class="align-middle py-5">{{ date_format(new DateTime($item->order_date), "Y.m.d") }}</td>
                <td class="align-middle py-5">
                    @if($item->order_status == 1)
                        <span class="badge badge-danger">Расматривается</span>
                    @elseif($item->order_status == 2)
                        <span class="badge badge-primary">Обработан</span>
                    @elseif($item->order_status == 3)
                        <span class="badge badge-warning">Отказан</span>
                    @elseif($item->order_status == 4)
                        <span class="badge badge-success">Доставлен</span>
                    @endif
                </td>
                <td class="align-middle py-5">
                    <span class="text-primary">{{ $item->order_sum . ' TJS  за ' . count($item->items) }}</span>  предметов</td>
                <td class="align-middle py-5">
                    <div class="d-flex justify-content-center">
                        <button data-id="{{ $item->id }}" id="view_order_details_user"
                                class="btn btn-dark rounded-0 btn-wide font-weight-medium">Подробно
                        </button>
                    </div>
                </td>
            </tr>
        @endforeach
    @endif
    </tbody>
</table>
