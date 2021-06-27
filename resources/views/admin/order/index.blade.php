@extends('layouts.admin')



@section('content')


    <!-- Content Body Start -->
    <div class="content-body">


        <!-- Page Headings Start -->
        <div class="row justify-content-between align-items-center mb-10">

            <!-- Page Heading Start -->
            <div class="col-12 col-lg-auto mb-20">
                <div class="page-heading">
                    <h3>Заказы {{--<span>/ Order List</span>--}}</h3>
                </div>
            </div><!-- Page Heading End -->

        </div><!-- Page Headings End -->

        <div class="row">

            <!--Order List Start-->
            <div class="col-12">
                <div class="table-responsive">
                    <table class="table table-vertical-middle">
                        <thead>
                        <tr>
                            <th>Заказ № </th>
                            <th>Дата</th>
                            <th>Заказчик</th>
                            <th>Сумма</th>
                            <th>Способ оплаты</th>
                            <th>Доставка</th>
                            <th>Статус</th>
                            <th>Действие</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($orders) >0)
                            @foreach($orders as $item)
                                <tr>
                                    <td>#{{ mb_substr($item->order_number, 0, 5 )}}</td>
                                    <td>{{ date_format(new DateTime($item->order_date), 'Y-m-d')}}</td>
                                    <td>{!! mb_substr($item->user->name, 0, 10 )!!}</td>
                                    <td>{{ $item->order_sum }} TJS</td>
                                    <td>{{ 'Оплата при получение' }}</td>
                                    <td>{{ $item->delivery_type }}</td>
                                    <td>
                                        <span data-id="{{ $item->id }}" data-sts="{{ $item->order_status }}" id="change_status_order" class="cursor-pointer order-status-{{ $item->id }}">
                                        @if($item->order_status == 1)
                                        <span class="badge badge-danger">Новый заказ</span>
                                        @elseif($item->order_status == 2)
                                            <span class="badge badge-primary">Обработан</span>
                                        @elseif($item->order_status == 3)
                                            <span class="badge badge-warning">Отказ</span>
                                        @elseif($item->order_status == 4)
                                            <span class="badge badge-success">Доставлен</span>
                                        @endif
                                        </span>
                                    </td>
                                    <td class="action h4">
                                        <div class="table-action-buttons">
                                            <a class="view button button-box button-xs ordr button-primary"
                                               href="{{ url('/admin/order/' . $item->id) }}"><i class="zmdi zmdi-eye zmdi-hc-fw"></i></a>
                                            <span data-id="{{ $item->id }}" data-sts="{{ $item->order_status }}" id="change_status_order"class="edit button ordr button-box button-xs button-info" >
                                                <i class="zmdi zmdi-edit"></i>
                                            </span>
                                            <span data-id="{{ $item->id }}" id="delete_order" class="delete button ordr button-box button-xs button-danger">
                                                <i class="zmdi zmdi-delete"></i>
                                            </span>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="mt-30 d-flex justify-content-center align-items-center w-100">
            {!! $orders->links() !!}
            </div>
            <!--Order List End-->



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
@endsection
