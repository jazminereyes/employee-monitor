@extends('layouts.main-dashboard')

@section('title', 'Dashboard | ' . $user[0]->name)

@section('breadcrumb')
    <li class="breadcrumb-item" aria-current="page">
        <a href="@if(auth()->user()->user_type == 'admin'){{ route('admin.home') }}@else{{ route('manager.home') }}@endif">Dashboard</a>
    </li>
    <li class="breadcrumb-item active" aria-current="page"><a>{{$user[0]->name}}</a></li>
@endsection

@section('active', 'dashboard')

@section('content')
    <div class="row mt-3 text-center">
        <div class="col-md-12">
            <h3>{{$user[0]->name}}</h3>
            <hr>
        </div>
    </div>
    <div class="row mt-3">
        @foreach ($records as $record)
        <div class="col-md-3">
            <a href="{{route('users.record', [$user[0]->id, date_format(date_create($record->datetaken),"Y"), date_format(date_create($record->datetaken),"m"), date_format(date_create($record->datetaken),"d")]) }}" class="hvr-grow">
                <div class="card card-top">
                    <div class="card-body text-center">
                        <h6>{{date_format(date_create($record->datetaken),"F d, Y")}}<br/><b>({{$record->record_count}})</b></h6>
                    </div>
                </div>
            </a>
        </div>
        @endforeach
    </div>
@endsection
