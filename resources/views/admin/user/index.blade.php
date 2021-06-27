@extends('layouts.admin')



@section('content')


    <!-- Content Body Start -->
    <div class="content-body">

        <!-- Page Headings Start -->
        <div class="row justify-content-between align-items-center mb-10">

            <!-- Page Heading Start -->
            <div class="col-12 col-lg-auto mb-20">
                <div class="page-heading">
                    <h3 class="title">Пользователи</h3>
                </div>
            </div><!-- Page Heading End -->

        </div><!-- Page Headings End -->

        <div class="row">
            <div class="col-12 mb-30">
                <button data-id="0" id="ad_usr_btn" class="button button-my float-right"><span><i class="ti-plus"></i>Добавить</span></button>
            </div>
            <!--Default Data Table Start-->
            <div class="col-12 mb-30">
                <div class="box">

                    <div class="box-body" style="padding: 0;">
                        <table class="table">
                           {{-- <thead>
                             <tr>
                                 <th>#</th>
                                 <th>First</th>
                                 <th>Last</th>
                                 <th>Handle</th>
                             </tr>
                             </thead>--}}
                            <tbody id="table-adm">
                            @if(count($users) > 0)
                                @foreach($users as $item)
                                    <tr id="table_item_adm_{!!$item->id!!}">
                                        <th  width="170" class="text-center act" style="vertical-align: middle; font-size: 16px;" width="15%"  style="vertical-align: middle">
                                            @if($item->image)
                                                <div class="image-cat">
                                                    <img src="/public/uploads/users/{{ $item->id . '/'. $item->image }}" alt="">
                                                </div>
                                            @else
                                                Нет фото
                                            @endif
                                        </th>
                                        <td class="text-center" style="vertical-align: middle"> <strong>{!! $item->name !!}</strong></td>
                                        <td class="text-center" style="vertical-align: middle"> <strong>{!! $item->roles->title !!}</strong></td>
                                        <td class="text-center"  style="vertical-align: middle">{!! $item->phone !!}</td>
                                        <td class="text-center" style="vertical-align: middle">{!! $item->email !!}</td>
                                        <td width="170" class="text-center act" style="vertical-align: middle; font-size: 16px;">
                                            <label  data-id="{{ $item->id }}" id="change_user_active" class="adomx-switch">
                                                <input  id="sts_{{ $item->id }}" type="checkbox" {{ ($item->is_active == 1)? 'checked' : ""}}>
                                                <i class="lever"></i>
                                                <span id="sts_text_{{ $item->id }}" class="text">{{ ($item->is_active == 1)? 'Да' : "Нет"}}</span>
                                            </label>
                                        </td>
                                        <td width="170" class="text-center act"  style="vertical-align: middle">
                                            <span data-id="{{ $item->id }}" id="edit_user" class="ti-pencil edit-item mr-10"></span>
                                            <span  data-id="{{ $item->id }}" id="delete_user" class="ti-trash delete-item"></span>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


            <!--Default Data Table End-->

            <!-- Modal -->
            <div class="modal fade" id="add_user_modal">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Добавление нового пользователья</h5>
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body">
                            <div class="box-body">
                                <form>
                                    <div id="error_pole" class="alert alert-danger d-none" role="alert">
                                    </div>
                                    <div class="row mbn-20">

                                        <!--Single Select-->
                                        <div class="col-12 mb-20">
                                            <h5 class="sub-title">Рол *</h5>
                                            <select id="role_new" class="form-control form-control-sm bSelect">
                                                @if(count($roles) > 0)
                                                    @foreach($roles as $r)
                                                        <option value="{{ $r->id }}">{{ $r->title }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                        <!--Single Select-->

                                        <div class="col-12 mb-20">
                                            <label for="formLayoutUsername3">Имя *</label>
                                            <input type="text" id="name_new" class="form-control form-control-sm" placeholder="">
                                        </div>

                                        <div class="col-12 mb-20">
                                            <label for="formLayoutEmail3">Фамилия</label>
                                            <input type="text" id="surname_new" class="form-control form-control-sm" placeholder="">
                                        </div>

                                        <div class="col-12 mb-20">
                                            <label for="formLayoutPassword3">Телефон *</label>
                                            <input type="text" id="phone_new" class="form-control form-control-sm" placeholder="">
                                        </div>
                                        <div class="col-12 mb-20">
                                            <label for="formLayoutPassword3">Е-mail</label>
                                            <input type="text" id="email_new" class="form-control form-control-sm" placeholder="">
                                        </div>
                                        <div class="col-12 mb-20">
                                            <label for="formLayoutPassword3">Парол *</label>
                                            <input type="text" id="password_new" class="form-control form-control-sm" placeholder="">
                                        </div>

                                        <div class="col-12 mb-20">
                                            <label for="formLayoutPassword3">Город</label>
                                            <input type="text" id="city_new" class="form-control form-control-sm" placeholder="">
                                        </div>

                                        <div class="col-12 mb-20">
                                            <label for="formLayoutPassword3">Адрес</label>
                                            <input type="text" id="address_new" class="form-control form-control-sm" placeholder="">
                                        </div>
                                        <div class="col-12 mb-20">
                                            <label for="formLayoutFile1">Фото (не обязательно)</label>
                                            <input  type="file" id="image_new" class="form-control form-control-sm">
                                        </div>

                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button id="save_user" class="button button-primary button-my">Сохранить</button>
                        </div>
                    </div>
                </div>
            </div>
{{--

            <!-- Modal -->
            <div class="modal fade" id="edit_user_modal">
                <div class="modal-dialog modal-lg">
                    <div id="edit_user_modal_body" class="modal-content">

                    </div>
                </div>
            </div>
--}}

        </div>
    </div><!-- Content Body End -->
@endsection
@section('scripts')
    <script src="/public/assets/js/plugins/bootstrap-select/bootstrap-select.min.js"></script>
    <script src="/public/assets/js/plugins/bootstrap-select/bootstrapSelect.active.js"></script>
@endsection
