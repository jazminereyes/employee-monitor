@extends('layouts.main-dashboard')

@section('title', 'Company')

@section('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page"><a>Company</a></li>
@endsection

@section('active', 'company')

@section('content')
    @include('layouts.alert')
    <div class="row mt-3">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <button id="update-btn" class="btn btn-action pull-right">Update<i class="fa fa-edit ml-2"></i></button>
                </div>
                <div class="card-body">
                    <form action="{{ route('company.update', $company->id) }}" method="POST">
                        @method('PATCH')
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <label for="">Name <span class="req text-danger">*</span></label>
                                <input name="name" type="text" class="form-control" value="{{ $company->name }}" readonly>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <label for="">Address</label>
                                <textarea name="address" id="address" cols="30" rows="3" class="form-control" readonly>{{ $company->address }}</textarea>
                            </div>
                        </div>
                </div>
                <div class="card-footer">
                    <button id="submit-btn" class="btn btn-secondary" type="submit" disabled>Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $('document').ready(function(){
            $('.req').css('display', 'none');
            $('#update-btn').click(function(){
                $(this).attr('disabled', 'disabled');
                $('form input, form textarea').removeAttr('readonly');
                $('#submit-btn').removeAttr('disabled');
                $('.req').css('display', 'inline-block');
            });
        });
    </script>
@endsection