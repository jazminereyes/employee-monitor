@extends('layouts.main')

@section('content')
<div class="row text-center mt-5 pt-3">
    <div class="col-md-12">
        <h1>Success</h1>
        <img src="{{ asset('img/check-list.jpg') }}" alt="" class="img-fluid">
        <h6 class="normal-text pb-0 mb-0">Please wait while we redirect you...</h6>
    </div>
</div>
@endsection

@section('js')
    <script>
        $(document).ready(function(){
            window.setTimeout(function() {
                window.location.href = "{{ url('/') }}";
            }, 3000);
        });
    </script>
@endsection