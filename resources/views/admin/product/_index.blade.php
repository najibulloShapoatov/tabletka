
    <!-- Page Headings Start -->
    <div class="row justify-content-between align-items-center mb-10">

        <!-- Page Heading Start -->
        <div class="col-12 col-lg-auto mb-20">
            <div class="page-heading">
                <h3 class="title">{{$cat->title}} <span>/ Продукция</span></h3>
            </div>
        </div><!-- Page Heading End -->

    </div><!-- Page Headings End -->

    <div class="row">
        <div class="col-12 mb-30">
            <button data-id="0" id="ad_product_btn" class="button button-my float-right"><span><i class="ti-plus"></i>Добавить</span></button>
        </div>
        <!--Default Data Table Start-->
        <div class="col-12 mb-30">
            <div class="box">

                <div class="box-body" style="padding: 0;">
                    <table class="table">
                        <thead>
                        <tr>
                            <th width="15%"  class="text-center" style="vertical-align: middle">#</th>
                            <th width="20%"  class="text-center" style="vertical-align: middle">Заголовок</th>
                            <th  class="text-center" style="vertical-align: middle">Артикул</th>
{{--                            <th>Слуг</th>--}}
                            <th  class="text-center" style="vertical-align: middle">Цена</th>
                            <th  class="text-center" style="vertical-align: middle">Цена со скидкой</th>
                            <th  class="text-center" style="vertical-align: middle">Количество на складе</th>
                            <th width="170"   class="text-center" style="vertical-align: middle">Действие</th>
                        </tr>
                        </thead>
                        <tbody id="table-adm">
                        @if(count($prds['items']) > 0)
                            @foreach($prds['items'] as $item)
                                    <tr  class="text-center" style="vertical-align: middle" id="table_item_adm_{{ $item->id }}">
                                        <th width="15%"  style="vertical-align: middle">
                                            @if($item->image)
                                                <div class="image-cat">
                                                    <img src="/public/uploads/products/{{ $item->id . '/'. $item->image }}" alt="">
                                                </div>
                                            @else
                                                Нет фото
                                            @endif
                                        </th>
                                        <td width="20%" class="text-center" style="vertical-align: middle"> <strong>{!! mb_substr($item->title, 0, 15) !!}</strong></td>
                                        <td class="text-center"  style="vertical-align: middle">{!! $item->articul !!}</td>
{{--                                        <td class="text-center" style="vertical-align: middle">{!! $item->slug !!}</td>--}}
                                        <td class="text-center" style="vertical-align: middle">{!! $item->price !!}</td>
                                        <td class="text-center" style="vertical-align: middle">{!! $item->price_discount !!}</td>
                                        <td class="text-center" style="vertical-align: middle">{!! $item->quantity !!}</td>
                                        <td width="170" class="text-center act"  style="vertical-align: middle">
                                            <span data-id="{{ $item->id }}" id="edit_product" class="ti-pencil edit-item mr-10"></span>
                                            <span  data-id="{{ $item->id }}" id="delete_product" class="ti-trash delete-item"></span>
                                        </td>
                                    </tr>
                            @endforeach
                        @else
                            <h3> Нет данных.</h3>
                        @endif
                        </tbody>

                    </table>
                    @if($prds['qnt'] > 10)
                        <div class="d-flex justify-content-center pb-20 load-more-products">
                            <button data-page="1" data-id="{{ $cat->id }}" id="load_more_products" class="button button-primary button-round button-outline">Загрузить ещё</button>
                        </div>
                    @endif
                </div>
            </div>
        </div>


        <!--Default Data Table End-->

        <!-- Modal -->
        <div class="modal fade" id="add_product_modal">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Добавление продукта</h5>
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">

                        <div class="box-body">
                            <ul class="nav nav-pills mb-15">
                                <li class="nav-item"><a class="nav-link active" data-toggle="pill" href="#main">Основные</a></li>
                                <li class="nav-item"><a class="nav-link" data-toggle="pill" href="#description">Описание</a></li>
                                <li class="nav-item"><a class="nav-link" data-toggle="pill" href="#instruction">Инструкция</a></li>
                                <li class="nav-item"><a class="nav-link" data-toggle="pill" href="#galery">Галерея</a></li>
                                <li class="nav-item"><a class="nav-link" data-toggle="pill" href="#recomendWithProduct">С этим также покупают</a></li>
                            </ul>
                            <div class="tab-content">

                                <div class="tab-pane fade active show" id="main">
                                    <form>
                                        <div id="error_add_product" class="alert alert-danger d-none" role="alert">
                                        </div>
                                        <div class="row mbn-20">

                                            <div class="col-12 mb-10">
                                                <label for="formLayoutUsername3">Заголовок *</label>
                                                <input type="text" id="title_new" class="form-control form-control-sm" placeholder="">
                                            </div>

                                            <div class="col-12 mb-10">
                                                <label for="formLayoutEmail3">Слуг *</label>
                                                <input readonly type="text" id="slug_new" class="form-control form-control-sm" placeholder="">
                                            </div>

                                            <div class="col-12 mb-10">
                                                <label for="formLayoutPassword3">Артикул *</label>
                                                <input type="text" id="articul_new" class="form-control form-control-sm" placeholder="">
                                            </div>
                                            <div class="col-12 mb-10">
                                                <label for="formLayoutPassword3">Фото <span> (размер изображение должет быть  900х1352 пикс. )</span></label>
                                                <input type="file" id="photo_new" class="form-control form-control-sm" placeholder="">
                                            </div>
                                            <div class="col-12 mb-10">
                                                <label for="formLayoutPassword3">Цена</label>
                                                <input type="text" id="price_new" class="form-control form-control-sm" placeholder="">
                                            </div>
                                            <div class="col-12 mb-10">
                                                <label for="formLayoutPassword3">Цена со скидкой</label>
                                                <div class="d-flex">
                                                    <input type="text" id="price_discount_new" class="form-control form-control-sm" placeholder="">
                                                    <label class="adomx-checkbox d-flex align-items-center ml-30" style="width: 100%"><input id="is_sale_new" type="checkbox"> <i class="icon"></i> В скидку</label>
                                                </div>
                                            </div>
                                            <div class="col-12 mb-10">
                                                <label for="formLayoutPassword3">Количество на складе</label>
                                                <input type="text" id="quantity_new" class="form-control form-control-sm" placeholder="">
                                            </div>
                                            <div class="col-12 mb-10">
                                                <label class="adomx-checkbox"><input id="is_new_new" type="checkbox"> <i class="icon"></i>Новинка</label>
                                            </div>
                                            <div class="col-12 mb-10">
                                                <label class="adomx-checkbox"><input id="is_hot_new" type="checkbox"> <i class="icon"></i>Hot</label>
                                            </div>
                                        </div>
                                    </form>
                                </div>


                                <div class="tab-pane fade" id="description">
                                    <form>
                                        <div class="row mbn-20">
                                            <div class="col-12 mb-20">
                                                <label for="formLayoutMessage1">Описание (не обязательно)</label>
                                                <textarea id="descr_new" class="summernote-description form-control form-control-sm"></textarea>
                                            </div>
                                        </div>
                                    </form>
                                </div>


                                <div class="tab-pane fade" id="instruction">
                                    <form>
                                        <div class="row mbn-20">
                                            <div class="col-12 mb-20">
                                                <label for="formLayoutMessage1">Инструкция (не обязательно)</label>
                                                <textarea id="instruction_new" class="summernote-instruction form-control form-control-sm"></textarea>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <div class="tab-pane fade" id="galery">
                                    <form>
                                        <div class="col-12 mb-20">
                                            <label for="formLayoutMessage1">Фото (не обязательно)</label>
                                            <span> (размер изображение должет быть  900х1352 пикс. )</span>
                                            <div class="d-flex">
                                                <input type="file"  id="image_to_temp">
                                                <button id="upload_temp_btn" class="button button-box-30 button-success"><i class="ti-upload mr-0"></i></button>
                                            </div>
                                        </div>
                                        <div id="images_product" class="row mbn-20">

                                        </div>
                                    </form>
                                </div>



                                <div class="tab-pane fade" id="recomendWithProduct">
                                    <form>
                                        <div class="col-12 mb-20">
                                            <label for="formLayoutMessage1">Выберите продукт</label>
                                            <div class="d-flex">

                                                <!--Live Search-->
                                                <div class=" col-6 mb-30">
                                                    <select id="rec_prod_select" class="form-control bSelect" data-live-search="true">
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
                                                <button id="r_prod_btn" class="button button-box-30 button-success"><i class="ti-check mr-0"></i></button>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div id="recomendes_product" class="row mbn-20">


                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer" style="border-top: none;">
                        <button data-id="{{ $cat->id }}" id="save_product" class="button button-primary button-my">Сохранить</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="edit_product_modal">
            <div class="modal-dialog modal-lg">
                <div id="edit_product_modal_body" class="modal-content">

                </div>
            </div>
        </div>

    </div>

    <script>

        (function ($) {
            "use strict";

            /*Summernote*/
            if( $('.summernote-description').length ) {
                $('.summernote-description').summernote({
                    height: 250,
                });
            }/*Summernote*/
            if( $('.summernote-instruction').length ) {
                $('.summernote-instruction').summernote({
                    height: 250,
                });
            }

        })(jQuery);
    </script>

    <script src="/public/assets/js/bootstrap-select.js"></script>
    <script src="/public/assets/js/plugins/bootstrap-select/bootstrapSelect.active.js"></script>
