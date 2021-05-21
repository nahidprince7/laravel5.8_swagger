@section("flushError")
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert"
                    aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{!! $error !!}</li>
                @endforeach
            </ul>
        </div>
    @endif
@endsection
@section("flushSuccess")
    @if(Session::has('message'))
        <div class="alert alert-success alert-dismissible in"
             role="alert">
            <button type="button" class="close" data-dismiss="alert"
                    aria-label="Close"><span aria-hidden="true">×</span>
            </button>
            {{ Session::get('message') }}
        </div>
    @endif
@endsection
