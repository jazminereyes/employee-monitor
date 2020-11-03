@extends('layouts.main-dashboard')

@section('title', 'Dashboard | ' . $user[0]->name)

@section('breadcrumb')
    <li class="breadcrumb-item" aria-current="page">
        <a href="@if(auth()->user()->user_type == 'admin'){{ route('admin.home') }}@else{{ route('manager.home') }}@endif">Dashboard</a>
    </li>
    <li class="breadcrumb-item active" aria-current="page">
        <a href="{{ route('users.show', $user[0]->id) }}">{{$user[0]->name}}</a>
    </li>
    <li class="breadcrumb-item active" aria-current="page"><a>{{date_format(date_create("$year/$month/$day"),"F d, Y")}}</a></li>
@endsection

@section('active', 'dashboard')

@section('content')

    <div class="row mt-3 text-center">
        <div class="col-md-12">
            <h3 class="mb-0">{{$user[0]->name}}</h3>
            <p>{{date_format(date_create("$year/$month/$day"),"F d, Y")}}</p>
            <hr>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-12">
                    <h4>Screen</h4>
                </div>
            </div>
            <div class="row mt-1">
                
                @foreach ($screenrecords as $record)
                <div class="row mt-1">
                    <div class="hovereffect">
                        <img class="img-fluid" src="{{ asset("storage/") . "/" . $record->photo_url }}" height="300px" width="300px" alt="">
                        <div class="overlay">
                            <div class="info">
                                <h6 class="pb-0 mb-0">Screenshot {{$loop->index+1}}</h6>
                                <p class="pt-0">{{date_format(date_create($record->created_at),"h:i A")}}</p>
                                <a href="{{ asset("storage/") . "/" . $record->photo_url }}" data-fancybox data-caption="&lt;b&gt;Screenshot {{$loop->index+1}}&lt;/b&gt;&lt;br>{{date_format(date_create($record->created_at),"h:i A")}}"><i class="fa fa-search text-white"></a></i>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-12">
                    <h4>Camera</h4>
                </div>
            </div>
            <div class="row mt-1">
                
                @foreach ($camerarecords as $record)
                <div class="row mt-1">
                    <div class="hovereffect">
                        <img class="img-fluid" src="{{ asset("storage/") . "/" . $record->photo_url }}" height="300px" width="300px" alt="">
                        <div class="overlay">
                            <div class="info">
                                <h6 class="pb-0 mb-0">Screenshot {{$loop->index+1}}</h6>
                                <p class="pt-0">{{date_format(date_create($record->created_at),"h:i A")}}</p>
                                <a href="{{ asset("storage/") . "/" . $record->photo_url }}" data-fancybox data-caption="&lt;b&gt;Screenshot {{$loop->index+1}}&lt;/b&gt;&lt;br>{{date_format(date_create($record->created_at),"h:i A")}}"><i class="fa fa-search text-white"></a></i>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
