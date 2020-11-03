@extends('layouts.main')

@section('js')
  <script>
    
    $(document).ready(function(){
        
        videoSS = document.getElementById("camShot");
        screenSS = document.getElementById("screenShot");
        myRecorder = new RecorderLib(videoSS, screenSS);
        myRecorder.setFrequencySettings({{$frequency}}, {{$interval}}, {{$duration}});
        myRecorder.setAjaxPath("{{ url('/record') }}");
        myRecorder.startRecording();
    });
  </script>
@endsection

@section('content')
<div class="row">
  <main role="main" class="col-md-12 ml-sm-auto col-lg-12 px-md-4">
    <nav class="navbar navbar-expand-lg bg-white fixed-top">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse " id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto navbar-right-top">
          <li class="nav-item dropdown nav-user">
            <a class="nav-link" href="#" id="navbarDropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-size: 14px;">{{ auth()->user()->name }}<i class="fa fa-chevron-down ml-2"></i></a>
            <div class="dropdown-menu dropdown-menu-right nav-user-dropdown" aria-labelledby="navbarDropdownMenuLink2">
              <a class="dropdown-item" href="#" data-toggle="modal" data-target="#editProfileModal"><i class="fa fa-user mr-2"></i>Profile</a>
              <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                <i class="fa fa-power-off mr-2"></i>{{ __('Sign Out') }}
              </a>

              <form id="logout-form" onclick="myRecorder.stopRecording();" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
              </form>
            </div>
          </li>
        </ul>
      </div>
    </nav>

    <div class="row mt-5 pt-5 text-center"> 
      <div class="col-md-12">
        <h3>Hi, {{ Auth::user()->name }}</h3>
        <p class="p-text">Please do not close this browser</p>
        <img src="{{ asset('img/employee-img.jpg') }}" alt="" class="img-fluid">
      </div>
    </div>
  </main>
</div>


<div class="row d-none">
  <div class="col-sm-1"></div>
  <canvas class="justify-content-center col-sm-4" id="camShot"></canvas>
  <div class="col-sm-2"></div>
  <canvas class="justify-content-center col-sm-4" id="screenShot"></canvas>
  <div class="col-sm-1"></div>
</div>

<div id="editProfileModal" class="modal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Profile</h5>
        <button type="button" class="close profile-close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row mb-3">
          <div class="col-md-12">
            <button id="edit-profile" class="btn btn-secondary btn-sm pull-right">Edit <i class="fa fa-edit"></i></button>
          </div>
        </div>
        <form id="profile-form" action="{{ route('profile') }}" method="POST">
          @method('PUT')
          @csrf
          <div class="form-group">
            <label for="name">Name</label>
            <input type="text" id="name" class="form-control" name="name" value="{{ auth()->user()->name }}" required readonly>
          </div>
          <div class="form-group">
            <label for="email">Email Address</label>
            <input type="text" id="email" class="form-control" name="email" value="{{ auth()->user()->email }}" required readonly>
          </div>
          <div id="password-block" class="form-group">
            <label for="password">New Password</label>
            <input type="password" id="password" class="form-control" name="password" readonly>
          </div>
                    
      </div>
      <div class="modal-footer">
        <button id="save-profile" type="submit" class="btn btn-action">Save</button>
        <button type="button" class="btn btn-secondary profile-close" data-dismiss="modal">Close</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection