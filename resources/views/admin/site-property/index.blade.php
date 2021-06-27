@extends('layouts.admin')



@section('content')


    <!-- Content Body Start -->
    <div class="content-body">

        <!-- Page Headings Start -->
        <div class="row justify-content-between align-items-center mb-10">

            <!-- Page Heading Start -->
            <div class="col-12 col-lg-auto mb-20">
                <div class="page-heading">
                    <h3 class="title">Настройки сайта</h3>
                </div>
            </div><!-- Page Heading End -->

        </div><!-- Page Headings End -->

        <div class="row">
            <!--Default Data Table Start-->
            <div class="col-8 mb-30">
                <div class="box">

                    <div class="box-body" style="padding: 0;">
                        @if(count($props) > 0)
                            <form>
                                <div class="row mbn-20">
                            @foreach($props as $item)

                                @if($item->prop_key == 'SITE_NAME')
                                    <div class="col-12 mb-20">
                                        <label>Заголовок сайта</label>
                                        <input id="site_name" type="text" readonly class="form-control form-control-sm" placeholder="" value="{!! $item->prop_value !!}">
                                    </div>
                                @endif

                                @if($item->prop_key == 'ADDRESS')
                                    <div class="col-12 mb-20">
                                        <label>Адресс</label>
                                        <input id="address" type="text" readonly class="form-control form-control-sm" placeholder="" value="{!! $item->prop_value !!}">
                                    </div>
                                @endif

                                @if($item->prop_key == 'PHONE_ONE')
                                    <div class="col-12 mb-20">
                                        <label>Телефон 1</label>
                                        <input id="phone_one" type="text" readonly class="form-control form-control-sm" placeholder="" value="{!! $item->prop_value !!}">
                                    </div>
                                @endif

                                @if($item->prop_key == 'PHONE_TWO')
                                    <div class="col-12 mb-20">
                                        <label>Телефон 2</label>
                                        <input id="phone_two" type="text" readonly class="form-control form-control-sm" placeholder="" value="{!! $item->prop_value !!}">
                                    </div>
                                @endif

                                @if($item->prop_key == 'EMAIL')
                                    <div class="col-12 mb-20">
                                        <label>E-mail</label>
                                        <input id="email" type="text" readonly class="form-control form-control-sm" placeholder="" value="{!! $item->prop_value !!}">
                                    </div>
                                @endif

                                @if($item->prop_key == 'FB_LINK')
                                    <div class="col-12 mb-20">
                                        <label>Facebook</label>
                                        <input id="fb_link" type="text" readonly class="form-control form-control-sm" placeholder="" value="{!! $item->prop_value !!}">
                                    </div>
                                @endif

                                @if($item->prop_key == 'INSTAGRAM_LINK')
                                    <div class="col-12 mb-20">
                                        <label>Instagram</label>
                                        <input id="instagram_link" type="text" readonly class="form-control form-control-sm" placeholder="" value="{!! $item->prop_value !!}">
                                    </div>
                                @endif
                                @if($item->prop_key == 'YOUTUBE_LINK')
                                    <div class="col-12 mb-20">
                                        <label>You tube</label>
                                        <input id="youtube_link" type="text" readonly class="form-control form-control-sm" placeholder="" value="{!! $item->prop_value !!}">
                                    </div>
                                @endif
                                @if($item->prop_key == 'TELEGRAM_LINK')
                                    <div class="col-12 mb-20">
                                        <label>Telegram</label>
                                        <input id="telegram_link" type="text" readonly class="form-control form-control-sm" placeholder="" value="{!! $item->prop_value !!}">
                                    </div>
                                @endif
                            @endforeach
                                <div class="col-12 mb-20">
                                    <button id="save_site_property" class="button button-primary button-round button-success d-none float-right ml-20"><span class="ti-save"></span>&nbsp;&nbsp;Сохранить</button>
                                    <button id="edit_site_property" class="button button-primary button-round float-right"><span class="ti-pencil-alt"></span>&nbsp;&nbsp;Редактировать</button>
                                </div>
                                </div>
                            </form>
                        @else
                            <h5> Нет данных.</h5>
                        @endif
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
