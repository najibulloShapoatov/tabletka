@if(count($errors) > 0)
    <div class="alert alert-icon alert-danger alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true" style="line-height: 1;font-size: 19px;">×</span>
        </button>
        <i class="fa fa-exclamation-triangle"></i>
        @foreach($errors->all() as $error)
            <p>{{$error}}</p>
        @endforeach
    </div>
@endif
