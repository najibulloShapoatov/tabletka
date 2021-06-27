@extends('frontend.layouts.app')

@section('title', 'Личный кабинет')

@section('styles')
@endsection

@section('content')

    <div class="content-body">


        <div>
            <div class="container">
                <div class="row">
                    <div class="col-md-3 border-right">
                        <h6 class="font-weight-medium font-size-7 pt-5 pt-lg-8  mb-5 mb-lg-7">Личный кабинет</h6>
                        <div class="tab-wrapper">
                            <ul class="my__account-nav nav flex-column mb-0" role="tablist" id="pills-tab">
                                <li class="nav-item mx-0">
                                    <a class="nav-link d-flex align-items-center px-0 active"
                                       id="pills-one-example1-tab" data-toggle="pill"
                                       href="#pills-one-example1" role="tab"
                                       aria-controls="pills-one-example1" aria-selected="false">
                                        <span class="font-weight-normal text-gray-600"> Панель управления</span>
                                    </a>
                                </li>
                                <li class="nav-item mx-0">
                                    <a class="nav-link d-flex align-items-center px-0" id="pills-two-example1-tab"
                                       data-toggle="pill" href="#pills-two-example1" role="tab"
                                       aria-controls="pills-two-example1" aria-selected="false">
                                        <span class="font-weight-normal text-gray-600">Мои заказы</span>
                                    </a>
                                </li>
                                <li class="nav-item mx-0">
                                    <a class="nav-link d-flex align-items-center px-0" id="pills-five-example1-tab"
                                       data-toggle="pill" href="#pills-five-example1" role="tab"
                                       aria-controls="pills-five-example1" aria-selected="false">
                                        <span class="font-weight-normal text-gray-600">Мой профиль</span>
                                    </a>
                                </li>
                                <li class="nav-item mx-0">
                                    <a class="nav-link d-flex align-items-center px-0" id="pills-six-example1-tab"
                                       data-toggle="pill" href="#pills-six-example1" role="tab"
                                       aria-controls="pills-six-example1" aria-selected="false">
                                        <span class="font-weight-normal text-gray-600">Мои желания</span>
                                    </a>
                                </li>
                                <li class="nav-item mx-0">
                                    <a class="nav-link d-flex align-items-center px-0" href="{{ url('/logout') }}">
                                        <span class="font-weight-normal text-gray-600">Выйти</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-one-example1" role="tabpanel"
                                 aria-labelledby="pills-one-example1-tab">
                                <div class="pt-5 pt-lg-8 pl-md-5 pl-lg-9 space-bottom-2 space-bottom-lg-3 mb-xl-1">
                                    <h6 class="font-weight-medium font-size-7 ml-lg-1 mb-lg-8 pb-xl-1">Панель управления</h6>
                                    <div class="ml-lg-1 mb-4">
                                        <span class="font-size-22">Привет  {!! $userInfo->name !!}</span>
                                        <span class="font-size-2"> (Вы не {!! $userInfo->name !!}? <a class="link-black-100"
                                                                                     href="{{ url('/logout') }}">Выход</a>)</span>
                                    </div>
                                    <div class="mb-4">
                                        <p class="mb-0 font-size-2 ml-lg-1 text-gray-600">На панели инструментов своей учетной записи вы можете просматривать свои заказы, управлять адресами доставки, а также редактировать свой пароль и данные учетной записи.</p>
                                    </div>
                                    <div class="row no-gutters row-cols-1 row-cols-md-2 row-cols-lg-3">
                                        <div class="col">
                                            <div class="border py-6 text-center">
                                                <a
                                                   id="pills-two-example1-tab"
                                                   data-toggle="pill" href="#pills-two-example1" role="tab"
                                                   aria-controls="pills-two-example1" aria-selected="false"
                                                   class="btn bg-gray-200 rounded-circle px-4 mb-2">
                                                    <span class="flaticon-order font-size-10 btn-icon__inner text-primary"></span>
                                                </a>
                                                <div class="font-size-3 mb-xl-1">Мои заказы</div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="border py-6 text-center">
                                                <a id="pills-five-example1-tab"
                                                   data-toggle="pill" href="#pills-five-example1" role="tab"
                                                   aria-controls="pills-five-example1" aria-selected="false"
                                                   class="btn bg-gray-200 rounded-circle px-4 mb-2">
                                                    <span
                                                        class="flaticon-user-1 font-size-10 btn-icon__inner text-primary"></span>
                                                </a>
                                                <div class="font-size-3 mb-xl-1">Мой профиль</div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="border border-left-0 py-6 text-center">
                                                <a id="pills-six-example1-tab"
                                                   data-toggle="pill" href="#pills-six-example1" role="tab"
                                                   aria-controls="pills-six-example1" aria-selected="false"
                                                   class="btn bg-gray-200  rounded-circle px-4 mb-2">
                                                    <span
                                                        class="flaticon-heart font-size-10 btn-icon__inner text-primary"></span>
                                                </a>
                                                <div class="font-size-3 mb-xl-1">Мои желания</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="pills-two-example1" role="tabpanel"
                                 aria-labelledby="pills-two-example1-tab">
                                <div class="pt-5 pl-md-5 pt-lg-8 pl-lg-9 space-bottom-lg-2 mb-lg-4">
                                    <h6 class="font-weight-medium font-size-7 ml-lg-1 mb-lg-8 pb-xl-1">Мои заказы</h6>
                                    <div id="order_data">
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
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="pills-five-example1" role="tabpanel"
                                 aria-labelledby="pills-five-example1-tab">
                                <div class="border-bottom mb-6 pb-6 mb-lg-8 pb-lg-9">
                                    <div class="pt-5 pl-md-5 pt-lg-8 pl-lg-9">
                                        <h6 class="font-weight-medium font-size-7 ml-lg-1 mb-lg-8 pb-xl-1">Мой профиль</h6>
                                        <div class="font-weight-medium font-size-22 mb-4 pb-xl-1">Редактировать</div>
                                        <div class="row">

                                            <div id="error_change_userInfo" class="alert alert-primary d-none" role="alert">
                                            </div>
                                            <div id="succes_change_userInfo" class="alert alert-success d-none" role="alert">
                                            </div>

                                            <div class="col-md-12 mb-4">
                                                <div class="js-form-message">
                                                    <label for="phone">Телефон</label>
                                                    <input readonly type="text" class="form-control rounded-0"
                                                            data-error-class="u-has-error" data-success-class="u-has-success" value="{{ $userInfo->phone }}">
                                                </div>
                                            </div>

                                            <div class="col-md-6 mb-4">
                                                <div class="js-form-message">
                                                    <label for="exampleFormControlInput1">Имя *</label>
                                                    <input type="text"
                                                           class="form-control rounded-0 pl-3 placeholder-color-3"
                                                           id="name_user"
                                                           aria-label="" placeholder="" required=""
                                                           data-error-class="u-has-error"
                                                           data-msg="Введите ваше имя"
                                                           data-success-class="u-has-success" value="{!! $userInfo->name !!}">
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-4">
                                                <div class="js-form-message">
                                                    <label for="exampleFormControlInput2">Фамилия</label>
                                                    <input type="text"
                                                           class="form-control rounded-0 pl-3 placeholder-color-3"
                                                           id="surname_user"
                                                           aria-label="Jack Wayley" placeholder=""
                                                           data-success-class="u-has-success" value="{!! $userInfo->surname !!}">
                                                </div>
                                            </div>
                                            <div class="col-md-12 mb-4">
                                                <div class="js-form-message">
                                                    <label for="exampleFormControlInput3">Город</label>
                                                    <input type="text" class="form-control rounded-0"
                                                           aria-label="" id="city_user"
                                                           data-success-class="u-has-success" value="{!! $userInfo->city !!}">
                                                </div>
                                            </div>
                                            <div class="col-md-12 mb-4 mb-md-0">
                                                <div class="js-form-message">
                                                    <label for="exampleFormControlInput4">Email</label>
                                                    <input type="email" class="form-control rounded-0"
                                                           id="email_user"
                                                           data-success-class="u-has-success" value="{!! $userInfo->email !!}">
                                                </div>
                                            </div>
                                            <div class="col-md-12 mb-4 mb-md-0 mt-2">
                                                <div class="js-form-message">
                                                    <label for="exampleFormControlInput4">Адрес</label>
                                                    <textarea class="input-text form-control" id="address_user" placeholder="" rows="8" cols="5">{!! $userInfo->address !!}</textarea>
                                                </div>
                                            </div>
                                            <div class="ml-3 mt-5">
                                                <button id="save_user_info" class="btn btn-wide btn-dark text-white rounded-0 transition-3d-hover height-60 width-390">Сохранить</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="pl-md-5 pl-lg-9 space-bottom-2 space-bottom-lg-3">
                                    <div class="font-weight-medium font-size-22 mb-4 pb-xl-1">Изменить пароль</div>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <div id="error_change_userPass" class="alert alert-primary d-none" role="alert">
                                            </div>
                                            <div id="succes_change_userPass" class="alert alert-success d-none" role="alert">
                                            </div>
                                            <div class="js-form-message">
                                                <label for="exampleFormControlInput5">Старый пароль</label>
                                                <input type="password" class="form-control rounded-0"
                                                       id="old_password" aria-label="" required
                                                       data-error-class="u-has-error" data-msg=""
                                                       data-success-class="u-has-success">
                                            </div>
                                        </div>
                                        <div class="col-md-12 mb-4">
                                            <div class="js-form-message">
                                                <label for="exampleFormControlInput6">Новый пароль</label>
                                                <input type="password" class="form-control rounded-0"
                                                       id="new_password"  required=""
                                                       data-error-class="u-has-error" data-msg=""
                                                       data-success-class="u-has-success">
                                            </div>
                                        </div>
                                        <div class="col-md-12 mb-5">
                                            <div class="js-form-message">
                                                <label for="exampleFormControlInput7">Потверждения нового пароля</label>
                                                <input type="password" class="form-control rounded-0"
                                                       id="confirmpassword_new"  required
                                                       data-error-class="u-has-error" data-msg=""
                                                       data-success-class="u-has-success">
                                            </div>
                                        </div>
                                        <div class="ml-3">
                                            <button id="save_change_password"
                                                    class="btn btn-wide btn-dark text-white rounded-0 transition-3d-hover height-60 width-390">Сохранить изменения</button>
                                        </div>
                                    </div>
                                </div>
                            </div>




                            <!--//wishlist-->
                            <div class="tab-pane fade" id="pills-six-example1" role="tabpanel"
                                 aria-labelledby="pills-six-example1-tab">
                                <div class="pt-5 pl-md-5 pt-lg-8 pl-lg-9 space-bottom-lg-3">
                                    <h6 class="font-weight-medium font-size-7 ml-lg-1 mb-lg-8 pb-xl-1">Мои желания</h6>
                                    <table class="table mb-0">
                                        <thead>
                                        <tr class="border">
                                            <th scope="col"
                                                class="py-3 border-bottom-0 font-weight-medium pl-3 pl-md-5">Продукт
                                            </th>
                                            <th scope="col" class="py-3 border-bottom-0 font-weight-medium">Цена
                                            </th>
                                            <th scope="col" class="py-3 border-bottom-0 font-weight-medium">В наличии</th>
                                            <th scope="col" class="py-3 border-bottom-0 font-weight-medium">Действия
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if(count($wishlist) >0)
                                            @foreach($wishlist as $item)
                                                <tr class="border">
                                                    <th class="pl-3 pl-md-5 font-weight-normal align-middle py-6">
                                                        <div class="d-flex align-items-center">
                                                            <a data-id="{{$item->id}}" class="d-block p-img-thumb">
                                                                @if($item->image)
                                                                    <img src="/public/uploads/products/{{ $item->id . '/thumb_' . $item->image }}" class="img-fluid"alt="image-description">
                                                                @else
                                                                    <img src="/public/frontend/src/images/no-product-image.jpg" class="img-fluid"alt="image-description">
                                                                @endif
                                                            </a>
                                                            <div class="ml-xl-4">
                                                                <div class="font-weight-normal">
                                                                    <a href="{{ url('/product/' . $item->id) }}" class="text-dark">{!! mb_substr($item->title, 0, 30) !!}</a>
                                                                </div>
                                                                <div class="font-size-2"> {!! $item->category->title !!}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </th>
                                                    <td class="align-middle py-5">{{ ($item->is_sale == 1)?$item->price_discount: $item->price }}
                                                        <span class="woocommerce-Price-currencySymbol">TJS</span></td>
                                                    <td class="align-middle py-5">{{ ($item->in_stock == 1)? 'В наличии':'Нет в наличии' }}</td>
                                                    <td class="align-middle py-5">
                                                        <span data-id="{{ $item->id }}" class="addOneToCart  product__add-to-cart cursor-pointer">Добавить в корзину</span>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>

@endsection


@section('scripts')
@endsection
