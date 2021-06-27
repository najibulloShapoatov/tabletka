@if(Session::has('success_message'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true"  style="line-height: 1;font-size: 19px;">×</span>
        </button>
        {{session('success_message')}}
    </div>
@endif

@if(Session::has('error_message'))
    <div class="alert alert-danger alert-dismissible fade in" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
        {{session('error_message')}}
    </div>
@endif
