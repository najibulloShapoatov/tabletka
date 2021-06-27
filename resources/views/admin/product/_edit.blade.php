<div class="modal-header">
    <h5 class="modal-title">Редактирование продукта</h5>
    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
</div>
<div class="modal-body">

    <div class="box-body">
        <ul class="nav nav-pills mb-15">
            <li class="nav-item"><a class="nav-link active" data-toggle="pill" href="#main-edit">Основные</a></li>
            <li class="nav-item"><a class="nav-link" data-toggle="pill" href="#description-edit">Описание</a></li>
            <li class="nav-item"><a class="nav-link" data-toggle="pill" href="#instruction-edit">Инструкция</a></li>
            <li class="nav-item"><a class="nav-link" data-toggle="pill" href="#galery-edit">Галерея</a></li>
            <li class="nav-item"><a class="nav-link" data-toggle="pill" href="#recomendWithProduct-edit">С этим также покупают</a></li>

        </ul>
        <div class="tab-content">

            <div class="tab-pane fade active show" id="main-edit">
                <form>
                    <div id="error_edit_product" class="alert alert-danger d-none" role="alert">
                    </div>
                    <div class="row mbn-20">

                        <div class="col-12 mb-10">
                            <label for="formLayoutUsername3">Заголовок *</label>
                            <input type="text" id="title_edit" class="form-control form-control-sm" placeholder="" value="{!! $data->title !!}">
                        </div>

                        <div class="col-12 mb-10">
                            <label for="formLayoutEmail3">Слуг *</label>
                            <input readonly type="text" id="slug_edit" class="form-control form-control-sm" placeholder="" value="{!! $data->slug !!}">
                        </div>

                        <div class="col-12 mb-10">
                            <label for="formLayoutPassword3">Артикул *</label>
                            <input type="text" id="articul_edit" class="form-control form-control-sm" placeholder="" value="{!! $data->articul !!}">
                        </div>
                        <div class="col-12 mb-10">
                            <label for="formLayoutPassword3">Фото</label>
                            <div class="d-flex">
                            <input type="file" id="photo_edit" class="form-control form-control-sm" placeholder="">
                                <div class="image-edit-product">
                                    <img src="/public/uploads/products/{{ $data->id . '/' . $data->image }}" alt="">
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mb-10">
                            <label for="formLayoutPassword3">Цена</label>
                            <input type="text" id="price_edit" class="form-control form-control-sm" placeholder="" value="{!! $data->price !!}">
                        </div>
                        <div class="col-12 mb-10">
                            <label for="formLayoutPassword3">Цена со скидкой</label><div class="d-flex">
                                <input type="text" id="price_discount_edit" class="form-control form-control-sm" placeholder="" value="{!! $data->price_discount !!}">
                                <label class="adomx-checkbox d-flex align-items-center ml-30" style="width: 100%"><input {{ ($data->is_sale==1)? 'checked':'' }} id="is_sale_edit" type="checkbox"> <i class="icon"></i> В скидку</label>
                            </div>
                        </div>
                        <div class="col-12 mb-10">
                            <label for="formLayoutPassword3">Количество на складе</label>
                            <input type="text" id="quantity_edit" class="form-control form-control-sm" placeholder="" value="{!! $data->quantity !!}">
                        </div>

                        <div class="col-12 mb-10">
                            <label class="adomx-checkbox"><input {{ ($data->is_new==1)? 'checked':'' }} id="is_new_edit" type="checkbox"> <i class="icon"></i>Новинка</label>
                        </div>
                        <div class="col-12 mb-10">
                            <label class="adomx-checkbox"><input {{ ($data->is_hot==1)? 'checked':'' }} id="is_hot_edit" type="checkbox"> <i class="icon"></i>Hot</label>
                        </div>
                    </div>
                </form>
            </div>


            <div class="tab-pane fade" id="description-edit">
                <form>
                    <div class="row mbn-20">
                        <div class="col-12 mb-20">
                            <label for="formLayoutMessage1">Описание (не обязательно)</label>
                            <textarea id="descr_edit" class="summernote-description-edit form-control form-control-sm">{!! $data->description !!}</textarea>
                        </div>
                    </div>
                </form>
            </div>


            <div class="tab-pane fade" id="instruction-edit">
                <form>
                    <div class="row mbn-20">
                        <div class="col-12 mb-20">
                            <label for="formLayoutMessage1">Инструкция (не обязательно)</label>
                            <textarea id="instruction_edit" class="summernote-instruction-edit form-control form-control-sm">{!! $data->instruction !!}</textarea>
                        </div>
                    </div>
                </form>
            </div>

            <div class="tab-pane fade" id="galery-edit">
                <form>
                    <div class="col-12 mb-20">
                        <label for="formLayoutMessage1">Фото (не обязательно)</label>
                        <div class="d-flex">
                            <input type="file"  id="image_to_edit_temp">
                            <button id="upload_edit_temp_btn" class="button button-box-30 button-success"><i class="ti-upload mr-0"></i></button>
                        </div>
                    </div>
                    <div id="images_product_edit" class="row mbn-20">
                        @if(count($data->galery) > 0)
                            @foreach($data->galery as $g)
                            <div id="galery_item_{{ $g->id }}" class="col-3 mb-15">
                                <img src="/public/uploads/products/{{ $data->id . '/' .$g->image }}" alt="">
                                <p class="delete-galery text-center widht-100 mt-10 mb-10"><span data-id="{{ $g->id }}" id="delete_galery_item" class="ti-trash delete-item"></span></p>
                            </div>
                            @endforeach
                        @endif
                    </div>
                </form>
            </div>

            <div class="tab-pane fade" id="recomendWithProduct-edit">
                <form>
                    <div class="col-12 mb-20">
                        <label for="formLayoutMessage1">Выберите продукт</label>
                        <div class="d-flex">

                            <!--Live Search-->
                            <div class=" col-6 mb-30">
                                <select id="rec_prod_select-edit" class="form-control bSelect" data-live-search="true">
                                    <option value="">Выберите продукту</option>
                                    @if(count($products) >0 )

                                        @php($i=0)
                                        @foreach($products as $item)
                                            @if($i==0)
                                                <optgroup label="">
                                                    @endif
                                                    <option value="{{ $item->id }}">{!!$item->articul .' : '. mb_substr($item->title,0, 100) !!}&nbsp;{{ ($item->is_sale == 1)? $item->price_discount : $item->price   }}&nbsp;TJS</option>
                                                    @php($i+=1)
                                                    @if($i==5)
                                                </optgroup>
                                                @php($i=0)
                                            @endif
                                        @endforeach
                                    @endif
                                </select>
                            </div>

                            <!--Live Search-->
                            <button data-id="{{ $data->id }}" id="r_prod_btn-edit" class="button button-box-30 button-success"><i class="ti-check mr-0"></i></button>
                        </div>
                    </div>
                    <div class="col-12">
                        <div data-id="{{ $data->id }}" id="recomendes_product-edit" class="row mbn-20">
                            @if(count($data->recomend)> 0)
                                @foreach($data->recomend as $r)

                                    <div id="item_r_prod_{{$r->product->id}}" class="col-6 mb-20">
                                        <div class="r_pod_item" style="border: 1px solid #ccc; border-radius: 4px;">
                                            <div style="margin: 10px;">
                                                <div class="d-flex">
                                                    <div class="image-r_prod">
                                                        @if($r->product->image)
                                                            <img src="/public/uploads/products/{{ $r->product->id . '/thumb_'. $r->product->image }}" class="mr-3" alt="">
                                                        @else
                                                            <img src="/public/frontend/src/images/thumb_no-product-image.jpg" class="mr-3" alt="">
                                                        @endif
                                                    </div>
                                                    <div class="media-body ml-10">
                                                        <h4 class="mt-0">{!! mb_substr($r->product->title, 0, 23) !!}</h4>
                                                        <h6>{!! mb_substr($r->product->articul, 0, 20) !!}</h6>
                                                        <p>{{ ($r->product->is_sale == 1)? $r->product->price_discount : $r->product->price }} TJS</p>
                                                    </div>
                                                </div>
                                                <span data-id="{{ $r->product->id }}" id="delete_item_prod_rec_edit" class="ti-close delete-item" style="position: absolute; top: 5%; right: 2%;"></span>
                                            </div>
                                        </div>
                                    </div>

                                @endforeach
                            @endif

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal-footer">
    <button data-id="{{ $data->id }}" id="save_edit_product" class="button button-primary button-my">Сохранить</button>
</div>

<script>

    (function ($) {
        "use strict";

        /*Summernote*/
        if( $('.summernote-description-edit').length ) {
            $('.summernote-description-edit').summernote({
                height: 250,
            });
        }/*Summernote*/
        if( $('.summernote-instruction-edit').length ) {
            $('.summernote-instruction-edit').summernote({
                height: 250,
            });
        }

    })(jQuery);
</script>
<script src="/public/assets/js/bootstrap-select.js"></script>
<script src="/public/assets/js/plugins/bootstrap-select/bootstrapSelect.active.js"></script>
