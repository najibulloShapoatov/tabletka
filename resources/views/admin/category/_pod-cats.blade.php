
    <!-- Page Headings Start -->
    <div class="row justify-content-between align-items-center mb-10">

        <!-- Page Heading Start -->
        <div class="col-12 col-lg-auto mb-20">
            <div class="page-heading">
                <h3 class="title">{!! $cat->title !!}<span>/ Категория</span></h3>
            </div>
        </div><!-- Page Heading End -->

    </div><!-- Page Headings End -->

    <div class="row">
        <div class="col-12 mb-30">
            <button  data-id="{{ $cat->id }}" id="ad_cat_btn" class="button button-my float-right"><span><i class="ti-plus"></i>Добавить</span></button>
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
                        @if(count($cats) > 0)
                            @foreach($cats as $item)
                                <tr id="table_item_adm_{{ $item->id }}">
                                    <th width="15%"  style="vertical-align: middle">
                                        @if($item->image)
                                            <div class="image-cat">
                                                <img src="/public/uploads/categories/{{ $item->id . '/'. $item->image }}" alt="">
                                            </div>
                                        @else
                                        Нет фото
                                        @endif
                                    </th>
                                    <td class="text-center" style="vertical-align: middle"> <strong>{!! $item->sort_order !!}</strong></td>
                                    <td class="text-center"  style="vertical-align: middle">{!! $item->title !!}</td>
                                    <td class="text-center" style="vertical-align: middle">{!! $item->slug !!}</td>
                                    <td width="170" class="text-center act"  style="vertical-align: middle">
                                        <span data-id="{{ $item->id }}" id="edit_category" class="ti-pencil edit-item mr-10"></span>
                                        <span data-id="{{ $item->id }}" id="show_p_category" class="ti-menu edit-item mr-10"></span>
                                        <span  data-id="{{ $item->id }}" id="delete_category" class="ti-trash delete-item"></span>
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
        <div class="modal fade" id="add_category_modal">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Добавление категории</h5>
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="box-body">
                            <form>
                                <div id="error_pole" class="alert alert-danger d-none" role="alert">
                                </div>
                                <div class="row mbn-20">

                                    <div class="col-12 mb-20">
                                        <label for="formLayoutUsername3">Заголовок *</label>
                                        <input type="text" id="title_new" class="form-control form-control-sm" placeholder="">
                                    </div>

                                    <div class="col-12 mb-20">
                                        <label for="formLayoutEmail3">Слуг *</label>
                                        <input readonly type="text" id="slug_new" class="form-control form-control-sm" placeholder="">
                                    </div>

                                    <div class="col-12 mb-20">
                                        <label for="formLayoutPassword3">Сортировка *</label>
                                        <input type="text" id="sort_new" class="form-control form-control-sm" placeholder="">
                                    </div>

                                    <div class="col-12 mb-20">
                                        <label for="formLayoutMessage1">Описание (не обязательно)</label>
                                        <textarea id="descr_new" class="summernote form-control form-control-sm"></textarea>
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
                        <button data-id="{{ $cat->id }}" id="save_category" class="button button-primary button-my">Сохранить</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="edit_category_modal">
            <div class="modal-dialog modal-lg">
                <div id="edit_category_modal_body" class="modal-content">

                </div>
            </div>
        </div>

    </div>

    <script src="/public/assets/js/plugins/summernote/summernote.active.js"></script>
