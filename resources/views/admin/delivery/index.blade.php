@extends('layouts.admin')



@section('content')


    <!-- Content Body Start -->
    <div class="content-body">

        <!-- Page Headings Start -->
        <div class="row justify-content-between align-items-center mb-10">

            <!-- Page Heading Start -->
            <div class="col-12 col-lg-auto mb-20">
                <div class="page-heading">
                    <h3 class="title">Доставка</h3>
                </div>
            </div><!-- Page Heading End -->

        </div><!-- Page Headings End -->

        <div class="row">
            <!--Default Data Table Start-->
            <div class="col-8 mb-30">
                <div class="box">

                    <div class="box-body" style="padding: 0;">
                            <form>
                                <div id="succes" class="alert alert-success d-none" role="alert">

                                </div>
                                <div class="row mbn-20">
                                    <div class="col-12 mb-20">
                                        <label>Стоимость доставки внутри города</label>
                                        <input id="city" type="text"  class="form-control form-control-sm" placeholder="" value="{!! $cityCost!!}">
                                    </div>
                                    <div class="col-12 mb-20">
                                        <label>Стоимость доставки за городом</label>
                                        <input id="nocity" type="text"  class="form-control form-control-sm" placeholder="" value="{!! $nocityCost !!}">
                                    </div>
                                <div class="col-12 mb-20">
                                    <button id="save_delivery_property" class="button button-primary button-round button-success float-right ml-20"><span class="ti-save"></span>&nbsp;&nbsp;Сохранить</button>
                                </div>
                                </div>
                            </form>
                    </div>
                </div>
            </div>

        </div>
    </div><!-- Content Body End -->
@endsection
@section('scripts')
    <script src="/public/assets/js/plugins/bootstrap-select/bootstrap-select.min.js"></script>
    <script src="/public/assets/js/plugins/bootstrap-select/bootstrapSelect.active.js"></script>
@endsection
