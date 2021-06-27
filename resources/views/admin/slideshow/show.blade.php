@extends('layouts.admin')

@section('content')

    <!-- Content Body Start -->
    <div class="content-body">
    <h4 class="pull-left">{{ $slide->title }}</h4>
    <div class="clearfix m-b-20"></div>
    <div class="row">
        <div class="col-sm-12">
            <div class="table-responsive azimiAdminTable">
                <table class="table table-bordered table-hover m-0">
                    <tr>
                        <td width="200"><strong>ID</strong></td>
                        <td>{{$slide->id}}</td>
                    </tr>
                    <tr>
                        <td><strong>Начало активности</strong></td>
                        <td>{{Carbon\Carbon::parse($slide->date_add)->format('d.m.Y')}}</td>
                    </tr>
                    <tr>
                        <td><strong>Окончание активности</strong></td>
                        <td>{{Carbon\Carbon::parse($slide->date_end)->format('d.m.Y')}}</td>
                    </tr>
                    <tr>
                        <td><strong>Ссылка</strong></td>
                        <td>{{ $slide->link }}</td>
                    </tr>
                    <tr>
                        <td><strong>Заголовок</strong></td>
                        <td>{{ $slide->title }}</td>
                    </tr>
                    <tr>
                        <td><strong>Описание</strong></td>
                        <td>{!! $slide->description !!}</td>
                    </tr>
                    <tr>
                        <td><strong>Картинка</strong></td>
                        <td>
                            @if(!empty($slide->image))
                                <img style="border: 1px solid #ccc;" src="/public/uploads/slideshow/{{ $slide->image }}" width="200" alt="">
                            @else
                                <img style="border: 1px solid #ccc;" src="/public/uploads/no_image.jpg" width="200" alt="">
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Картинка (моб.)</strong></td>
                        <td>
                            @if(!empty($slide->image_mobile))
                                <img style="border: 1px solid #ccc;" src="/public/uploads/slideshow/{{ $slide->image_mobile }}" width="200" alt="">
                            @else
                                <img style="border: 1px solid #ccc;" src="/public/uploads/no_image.jpg" width="200" alt="">
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Активный</strong></td>
                        <td>
                            @if($slide->is_active == 1)
                                Да
                            @else
                                Нет
                            @endif
                        </td>
                    </tr>
                </table>
            </div>
            <br>
            <div class="showSubi">
                <a href="{{ url('admin/slideshow/')}}" class="button button-dropbox mr-20"><i class="ti-align-justify"></i> Все слайды</a>
                <a href="{{ url('/admin/slideshow/edit/' . $slide->id) }}" class="btn btn-primary button button-behance mr-20" title="Редактировать"><i class="ti-pencil"></i> Редактировать</a>
                <a href="{{ url('/admin/slideshow/delete/' . $slide->id) }}" onclick="return confirm('Вы уверены?');" class="button button-google-glass mr-20" title="Удалить"><i class="ti-trash"></i> Удалить</a>
            </div>
        </div>
    </div>
    </div>
@endsection
