@extends('layouts.admin')



@section('content')


    <!-- Content Body Start -->
    <div class="content-body">



        <!-- Page Headings Start -->
        <div class="row justify-content-between align-items-center mb-10">

            <!-- Page Heading Start -->
            <div class="col-12 col-lg-auto mb-20">
                <div class="page-heading">
                    <h3>Информация о заказе</h3>
                </div>
            </div><!-- Page Heading End -->

        </div><!-- Page Headings End -->

        <div class="row mbn-30">

            <!--Order Details Head Start-->
            <div class="col-12 mb-30">
                <div class="row mbn-15">
                    <div class="col-12 col-md-4 mb-15">
                        <h4 class="text-primary fw-600 m-0">Заказ:  #{{ $order->order_number }}</h4>
                    </div>
                    <div class="text-left text-md-center col-12 col-md-4 mb-15 ">
                        <span>Статус :&nbsp;&nbsp;
                            <span data-id="{{ $order->id }}" data-sts="{{ $order->order_status }}" id="change_status_order" class="cursor-pointer order-status-{{ $order->id }}">
                                @if($order->order_status == 1)
                                    <span class="badge badge-round badge-danger">Новый заказ</span>
                                @elseif($order->order_status == 2)
                                    <span class="badge badge-round badge-primary">Обработан</span>
                                @elseif($order->order_status == 3)
                                    <span class="badge badge-round badge-warning">Отказ</span>
                                @elseif($order->order_status == 4)
                                    <span class="badge badge-round badge-success">Доставлен</span>
                                @endif
                            </span>
                        </span>
                    </div>
                    <div class="text-left text-md-right col-12 col-md-4 mb-15">
                        <p>{{ $order->order_date }}</p>
                    </div>
                </div>
            </div>
            <!--Order Details Head End-->

            <!--Order Details Customer Information Start-->
            <div class="col-12 mb-30">
                <div class="order-details-customer-info row mbn-20">

                    <!--Billing Info Start-->
                    <div class="col-lg-4 col-md-6 col-12 mb-20">
                        <h4 class="mb-25">Платежная информация</h4>
                        <ul>
                            <li> <span>Имя</span> <span>{!! $order->user->name !!}</span> </li>
                            <li> <span>Фамилия</span> <span>{!! $order->user->surname !!}</span> </li>
                            <li> <span>Город</span> <span>{!! $order->user->city !!}</span> </li>
                            <li> <span>Адрес</span> <span>{!! $order->user->address !!}</span> </li>
                            <li> <span>Email</span> <span>{!! $order->user->email !!}</span> </li>
                            <li> <span>Phone</span> <span> +992 {!! $order->user->phone !!}</span> </li>
                            <li> <span>Доставка</span> <span>{!! 'Оплата при получение' !!}</span> </li>
                            <li> <span>Итог к оплате</span> <strong>{!! $order->order_sum !!} TJS</strong> </li>

                        </ul>
                    </div>
                    <!--Billing Info End-->



                </div>
            </div>
            <!--Order Details Customer Information Start-->

            <!--Order Details List Start-->
            <div class="col-12 mb-30">
                <div class="table-responsive">
                    <table class="table table-bordered table-vertical-middle">
                        <thead>
                        <tr>
{{--                            <th>Order ID</th>--}}
                            <th></th>
                            <th>Названия продукта</th>
                            <th class="text-center">Цена</th>
                            <th class="text-center">Количество</th>
                            <th class="text-center">Итого</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($order->items) >0)
                            @foreach($order->items as $item)
                        <tr>
{{--                            <td>#MSP40022</td>--}}
                            <td width="170">
                                <img src="{{ ($item->product->image)? '/public/uploads/products/'.$item->product->id.'/thumb_'.$item->product->image : '/public/uploads/products/thumb_no-product-image.jpg' }}" alt="" class="product-image rounded-circle">
                            </td>
                            <td>
                                <a href="{{ url('/product/'.$item->product->id) }}">{!! mb_substr($item->product->title, 0, 55) !!}</a></td>
                            <td class="text-center">{{ $item->price }}TJS</td>
                            <td class="text-center">{{ $item->quantity }}</td>
                            <td class="text-center"> <strong>{{ number_format((float)($item->price * $item->quantity), 2, '.', ' ') }} TJS</strong></td>
                        </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
            <!--Order Details List End-->

        </div>

        <!-- Modal -->
        <div class="modal" id="change_sts_order_modal">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Изменения статуса заказа</h5>
                        <button class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <span>
                            <strong class="mr-20">Текуший статус :</strong>
                            <span id="current_sts"></span>
                        </span>

                        <div class="d-flex mt-20 align-items-center">
                            <strong class="mr-20">Новый статус :</strong>
                            <div class="col-8">
                                <select id="new_sts_order" class="form-control nice-select">
                                        <option value="1">Новый заказ</option>
                                        <option value="2">Обработан</option>
                                        <option value="3">Отказ</option>
                                        <option value="4">Доставлен</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button data-id="0" data-sts="0" id="save_sts_order" class="button button-primary button-round">Сохранить</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('scripts')
    <script src="/public/assets/js/plugins/nice-select/jquery.nice-select.min.js"></script>
    <script src="/public/assets/js/plugins/nice-select/niceSelect.active.js"></script>
@endsection
