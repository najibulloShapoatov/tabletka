@extends('layouts.admin')



@section('content')


    <!-- Content Body Start -->
    <div class="content-body">

        <!-- Page Headings Start -->
        <div class="row justify-content-between align-items-center mb-10">

            <!-- Page Heading Start -->
            <div class="col-12 col-lg-auto mb-20">
                <div class="page-heading">
                    <h3 class="title">Категории на главной</h3>
                </div>
            </div><!-- Page Heading End -->

        </div><!-- Page Headings End -->

        <div class="row">
            <!--Default Data Table Start-->
            <div class="col-8 mb-30">
                <div class="box">

                    <div class="box-body" >
                            <form>

                                <div id="error" class="alert alert-danger d-none" role="alert"></div>
                                <div id="succes" class="alert alert-success d-none" role="alert"></div>
                                <div class="row mbn-20">
                                    <div class="col-12 mb-20">
                                        <label>Первый категория на главной </label>
                                            <select id="one" class="form-control bSelect" data-live-search="true">
                                                @if(count($cats) >0)
                                                    @foreach($cats as $cat)
                                                        <optgroup label="{!! $cat->title !!}">
                                                            @php
                                                            $catlvl3 = \App\Model\Category::getCatlvl3ByIDlvl1($cat->id);
                                                            @endphp
                                                            @if(count($catlvl3) > 0)
                                                                @foreach($catlvl3 as $item)
                                                                    <option {{ ($item->id == $catOneID)? 'selected': '' }} value="{{ $item->id }}">{!! $item->title !!}</option>
                                                                @endforeach
                                                            @endif
                                                        </optgroup>
                                                    @endforeach
                                                @endif
                                            </select>
                                    </div>
                                    <div class="col-12 mb-20">
                                        <label>Второй категория на главной </label>
                                            <select id="two" class="form-control bSelect" data-live-search="true">
                                                @if(count($cats) >0)
                                                    @foreach($cats as $cat)
                                                        <optgroup label="{!! $cat->title !!}">
                                                            @php
                                                                $catlvl3 = \App\Model\Category::getCatlvl3ByIDlvl1($cat->id);
                                                            @endphp
                                                            @if(count($catlvl3) > 0)
                                                                @foreach($catlvl3 as $item)
                                                                    <option {{ ($item->id == $catTwoID)? 'selected': '' }} value="{{ $item->id }}">{!! $item->title !!}</option>
                                                                @endforeach
                                                            @endif
                                                        </optgroup>
                                                    @endforeach
                                                @endif
                                            </select>
                                    </div>
                                <div class="col-12 mb-20">
                                    <button id="save_catHome" class="button button-primary button-round button-success float-right ml-20"><span class="ti-save"></span>&nbsp;&nbsp;Сохранить</button>
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
