


<main id="content">
    <script src="/public/frontend/src/js/html2canvas.js"></script>

    <div class="bg-gray-200 space-bottom-3">
        <div class="container">
            <div class="py-5 py-lg-7">
                <h6 class="font-weight-medium font-size-7 text-center mt-lg-1">Заказ оформлен</h6>
            </div>
            <div class="max-width-890 mx-auto">
                <div  id="to-img" class="bg-white pt-6 border">
                    <h6 class="font-size-3 font-weight-medium text-center mb-4 pb-xl-1" id="msg">Спасибо! Ваш заказ оформлен. Наш менеджер с Вами свяжется в кратчайшие сроки.</h6>
                    <div class="border-bottom mb-5 pb-5 overflow-auto overflow-md-visible">
                        <div class="pl-3">
                            <table class="table table-borderless mb-0 ml-1">
                                <thead>
                                <tr>
                                    <th scope="col" class="font-size-2 font-weight-normal py-0">Заказ номер:</th>
                                    <th scope="col" class="font-size-2 font-weight-normal py-0">Дата:</th>
                                    <th scope="col" class="font-size-2 font-weight-normal py-0 text-md-center">Всего: </th>
                                    <th scope="col" class="font-size-2 font-weight-normal py-0 text-md-right pr-md-9">Способ оплаты:</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <th scope="row" class="pr-0 py-0 font-weight-medium">{{ $order->order_number }}</th>
                                    <td class="pr-0 py-0 font-weight-medium">{{ $order->order_date }}</td>
                                    <td class="pr-0 py-0 font-weight-medium text-md-center">{{ $order->order_sum }}</td>
                                    <td class="pr-md-4 py-0 font-weight-medium text-md-right">{{ 'Оплата при получение' }}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="border-bottom mb-5 pb-6">
                        <div class="px-3 px-md-4">
                            <div class="ml-md-2">
                                <h6 class="font-size-3 on-weight-medium mb-4 pb-1">Подробности заказа</h6>
                                @foreach($order->items as $item)
                                    <div class="d-flex justify-content-between mb-4 " >
                                        <div class="col-9">
                                            <div class="d-flex align-items-baseline">
                                                <div>
                                                    <h6 class="font-size-2 font-weight-normal mb-1">{!! $item->product->title !!}</h6>
                                                    <span class="font-size-2 text-gray-600">{!! $item->product->category->title !!}</span>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="col-1 pl-0 pr-0">
                                            <span class="font-size-2 ml-2 ml-md-8">x{{ $item->quantity }}</span>
                                        </div>
                                        <div class="col-2">
                                            <div class="d-flex">
                                                <span class="font-weight-medium font-size-2 ml-1">
                                                    {{ number_format((float)($item->quantity * $item->price), 2, '.', '' ) . '  TJS' }}

                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="border-bottom mb-5 pb-5">
                        <ul class="list-unstyled px-3 pl-md-5 pr-md-4 mb-0">
                            {{--<li class="d-flex justify-content-between py-2">
                                <span class="font-weight-medium font-size-2">Subtotal:</span>
                                <span class="font-weight-medium font-size-2">$951</span>
                            </li>--}}
                            <li class="d-flex justify-content-between py-2">
                                <span class="font-weight-medium font-size-2">Доставка:</span>
                                <span class="font-weight-medium font-size-2">{{ $order->delivery_type }}</span>
                            </li>
                            <li class="d-flex justify-content-between pt-2">
                                <span class="font-weight-medium font-size-2">Способ оплаты:</span>
                                <span class="font-weight-medium font-size-2">{{ 'Оплата при получение' }}</span>
                            </li>
                        </ul>
                    </div>
                    <div class="border-bottom mb-5 pb-4">
                        <div class="px-3 pl-md-5 pr-md-4">
                            <div class="d-flex justify-content-between">
                                <span class="font-size-2 font-weight-medium">Всего</span>
                                <span class="font-weight-medium fon-size-2">{{ $order->order_sum }} TJS</span>
                            </div>
                        </div>
                    </div>
                    <div class="px-3 pl-md-5 pr-md-4 mb-6 pb-xl-1">
                        <div class="row row-cols-1 row-cols-md-2">
                           {{-- <div class="col">
                                <div class="mb-6 mb-md-0">
                                    <h6 class="font-weight-medium font-size-22 mb-3">Платежный адрес
                                    </h6>
                                    <address class="d-flex flex-column mb-0">
                                        <span class="text-gray-600 font-size-2">Ali Tufan</span>
                                        <span class="text-gray-600 font-size-2">Bedford St,</span>
                                        <span class="text-gray-600 font-size-2">Covent Garden, </span>
                                        <span class="text-gray-600 font-size-2">London WC2E 9ED</span>
                                        <span class="text-gray-600 font-size-2">United Kingdom</span>
                                    </address>
                                </div>
                            </div>--}}
                            <div class="col">
                                <h6 class="font-weight-medium font-size-22 mb-3">Адрес доставки
                                </h6>
                                <address class="d-flex flex-column mb-0">
                                    <div class="d-flex">
                                    <span class="text-gray-600 font-size-2 mr-3"> Получатель: </span>
                                        <span class="text-gray-600 font-size-2 ml-2">{{ $userInfo->surname }}</span>
                                        &nbsp;&nbsp;
                                        <span class="text-gray-600 font-size-2">{{ $userInfo->name }}</span>
                                    </div>
                                    <div class="d-flex">
                                        <span class="text-gray-600 font-size-2 mr-3"> Адрес: </span>
                                        <span class="text-gray-600 font-size-2">{!!   $userInfo->address !!}</span>
                                    </div>
                                    <div class="d-flex">
                                        <span class="text-gray-600 font-size-2 mr-3"> Город: </span>
                                        <span class="text-gray-600 font-size-2">{!!   $userInfo->city !!}</span>
                                    </div>
                                    <div class="d-flex">
                                        <span class="text-gray-600 font-size-2 mr-3"> Почта: </span>
                                        <span class="text-gray-600 font-size-2">{{ $userInfo->email }}</span>
                                    </div>
                                </address>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>









<script>
    (async function ($) {
        "use strict";
        var el = $('#to-img');
        async function saveCheckout(element) {
            await html2canvas(element, {
                onrendered: function (canvas) {
                    let img = canvas.toDataURL("image/png");
                    saveIMAGE(img);
                }
            });
        }
         function saveIMAGE(uri) {
            var link = document.createElement('a');
            link.download = "tabletka_{{ $order->order_number }}_{{ $order->order_sum }}_TJS.png";
            link.href = uri;
            link.click();
        }
        await saveCheckout(el);
    })(jQuery);
</script>
