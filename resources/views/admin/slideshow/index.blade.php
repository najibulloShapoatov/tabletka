@extends('layouts.admin')

@section('content')

    <!-- Content Body Start -->
    <div class="content-body">
<h4 class="pull-left">Слайдшоу</h4>
<a href="{{URL::to('admin/slideshow/create')}}" class="button button-dropbox pull-right"><i class="ti-plus"></i> Добавить</a>
<div class="clearfix m-b-20"></div>
@include('includes.alert')
<div class="row">
    <div class="col-sm-12 mt-10">
        @if(count($slides) > 0)
            <div class="table-responsive azimiAdminTable">
                <table class="table table-bordered table-hover m-0">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Дата</th>
                        <th>Заголовок</th>
                        <th>Активность</th>
                        <th class="text-center">Действие</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($slides as $item)
                        <tr>
                            <th scope="row" width="17%" >
                                @if(!empty($item->image))
                                    <img style="border: 1px solid #ccc;" src="/public/uploads/slideshow/{{ $item->image }}" width="150" alt="">
                                @else
                                    <img style="border: 1px solid #ccc;" src="/public/uploads/no_image.jpg" width="150" alt="">
                                @endif
                            </th>
                            <td>{{Carbon\Carbon::parse($item->date_add)->format('d.m.Y')}}</td>
                            <td>{{ $item->title }}</td>
                            <td class="text-center act" style="vertical-align: middle; font-size: 16px;" width="12%">
                                <label  data-id="{{ $item->id }}" id="change_slide_active" class="adomx-switch change-active-center">
                                    <input  id="sts_{{ $item->id }}" type="checkbox" {{ ($item->is_active == 1)? 'checked' : ""}}>
                                    <i class="lever"></i>
                                    <span id="sts_text_{{ $item->id }}" class="text">{{ ($item->is_active == 1)? 'Да' : "Нет"}}</span>
                                </label>
                            </td>
                            <td class="text-center" width="170" style="vertical-align: middle; font-size: 20px;">
                                <a href="{{ url('/admin/slideshow/show/' . $item->id) }}" class="editableIcons edit-item mr-10" title="Просмотр"><i class="ti-eye"></i></a>
                                <a href="{{ url('/admin/slideshow/edit/' . $item->id) }}" class="editableIcons edit-item mr-10" title="Редактировать"><i class="ti-pencil"></i></a>
                                <a href="{{ url('/admin/slideshow/delete/' . $item->id) }}" onclick="return confirm('Вы уверены?');" class="editableIcons delete-item" title="Удалить"><i class="ti-trash"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {!! $slides->render() !!}
                <div class="clearfix m-b-20"></div>
            </div>
        @else
            <p>Нет данных.</p>
        @endif
    </div>
</div>
</div>
@endsection
