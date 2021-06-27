
<div class="modal-header">
    <h5 class="modal-title">Редактирование категории</h5>
    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
</div>
<div class="modal-body">
    <div class="box-body">
        <form>
            <div id="error_edit" class="alert alert-danger d-none" role="alert">
            </div>
            <div class="row mbn-20">

                <div class="col-12 mb-20">
                    <label for="formLayoutUsername3">Заголовок *</label>
                    <input type="text" id="title_edit" class="form-control form-control-sm" placeholder="" value="{!! $data->title !!}">
                </div>

                <div class="col-12 mb-20">
                    <label for="formLayoutEmail3">Слуг *</label>
                    <input readonly type="text" id="slug_edit" class="form-control form-control-sm" placeholder="" value="{!! $data->slug !!}">
                </div>

                <div class="col-12 mb-20">
                    <label for="formLayoutPassword3">Сортировка *</label>
                    <input type="text" id="sort_edit" class="form-control form-control-sm" placeholder="" value="{{ $data->sort_order }}">
                </div>

                <div class="col-12 mb-20">
                    <label for="formLayoutMessage1">Описание (не обязательно)</label>
                    <textarea id="descr_edit" class="summernote-one form-control form-control-sm">{!! $data->description !!}</textarea>
                </div>

                <div class="col-12 mb-20">
                    <label for="formLayoutFile1">Фото (не обязательно)</label>
                    <div class="d-flex">
                        <input  type="file" id="image_edit" class="form-control form-control-sm">
                        <div class="image-edit-cat">
                            <img src="/public/uploads/categories/{{ $data->id . '/' . $data->image }}" alt="">
                        </div>
                    </div>
                </div>

            </div>
            <script>(function ($) {
                    "use strict";
                    if( $('.summernote-one').length ) {
                        $('.summernote-one').summernote({
                            height: 150,
                        });
                    }

                })(jQuery);</script>
        </form>
    </div>
</div>
<div class="modal-footer">
    <button data-id="{{ $data->id }}" id="save_edit_category" class="button button-primary button-my">Сохранить</button>
</div>
