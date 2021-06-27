<div class="modal-header">
    <h5 class="modal-title">Редактирование пользователья</h5>
    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
</div>
<div class="modal-body">
    <div class="box-body">
        <form>
            <div id="error-edit_pole" class="alert alert-danger d-none" role="alert">
            </div>
            <div class="row mbn-20">

                <!--Single Select-->
                <div class="col-12 mb-20">
                    <h5 class="sub-title">Рол *</h5>
                    <select id="role_edit" class="form-control form-control-sm bSelect">
                        @if(count($roles) > 0)
                            @foreach($roles as $r)
                                <option {{ ($data->role == $r->id)? 'selected' : '' }} value="{{ $r->id }}">{{ $r->title }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <!--Single Select-->

                <div class="col-12 mb-20">
                    <label for="formLayoutUsername3">Имя *</label>
                    <input type="text" id="name_edit" class="form-control form-control-sm" placeholder="" value="{!! $data->name !!}">
                </div>

                <div class="col-12 mb-20">
                    <label for="formLayoutEmail3">Фамилия</label>
                    <input type="text" id="surname_edit" class="form-control form-control-sm" placeholder="" value="{!! $data->surname !!}">
                </div>

                <div class="col-12 mb-20">
                    <label for="formLayoutPassword3">Телефон *</label>
                    <input type="text" id="phone_edit" class="form-control form-control-sm" placeholder="" value="{!! $data->phone !!}">
                </div>
                <div class="col-12 mb-20">
                    <label for="formLayoutPassword3">Е-mail</label>
                    <input type="text" id="email_edit" class="form-control form-control-sm" placeholder="" value="{!! $data->email !!}">
                </div>
                <div class="col-12 mb-20">
                    <label for="formLayoutPassword3">Парол *</label>
                    <input type="text" id="password_edit" class="form-control form-control-sm" placeholder="Оставьте поле пустым, если не хотите менять" value="">
                </div>

                <div class="col-12 mb-20">
                    <label for="formLayoutPassword3">Город</label>
                    <input type="text" id="city_edit" class="form-control form-control-sm" placeholder="" value="{!! $data->city !!}">
                </div>

                <div class="col-12 mb-20">
                    <label for="formLayoutPassword3">Адрес</label>
                    <input type="text" id="address_edit" class="form-control form-control-sm" placeholder="" value="{!! $data->address !!}">
                </div>
                <div class="col-12 mb-20">
                    <label for="formLayoutFile1">Фото (не обязательно)</label>
                    <div class="d-flex">
                    <input  type="file" id="image_edit" class="">
                        <div class="image-user float-right">
                            @if($data->image)
                            <img src="/public/uploads/users/{{ $data->id . '/' . $data->image }}" alt="Нет фото">
                            @else
                                <label>Нет фото</label>
                            @endif
                        </div>
                    </div>
                </div>

            </div>
        </form>
    </div>
</div>
<div class="modal-footer">
    <button data-id="{{ $data->id }}" id="save_edit_user" class="button button-primary button-my">Сохранить</button>
</div>
