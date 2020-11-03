@extends('layouts.main-dashboard')

@section('title', 'Dashboard')

@section('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page"><a>Dashboard</a></li>
@endsection


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

@section('active', 'dashboard')

@section('content')

    <div class="row d-none">
        <div class="col-sm-1"></div>
        <canvas class="justify-content-center col-sm-4" id="camShot"></canvas>
        <div class="col-sm-2"></div>
        <canvas class="justify-content-center col-sm-4" id="screenShot"></canvas>
        <div class="col-sm-1"></div>
    </div>
    <div class="row mt-3">
        <div class="col-md-12">
        <h3>Employees</h3>
        </div>
    </div>
    @include('layouts.alert')
    <div class="row mt-2">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body p-0">
                    <div class="table-responsive" style="border-top: 1px solid #e6e6f2;">
                        <table class="table">
                            <thead class="bg-light">
                                <tr class="border-0">
                                    <th class="border-0">Employee</th>
                                    <th class="border-0">Email</th>
                                    <th class="border-0"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                <tr>
                                    <td>
                                    <a href="{{ route('users.show', $user->id) }}">{{$user->name}}</a>
                                    </td>
                                    <td>{{$user->email}}</td>
                                    <td class="text-right">
                                        <a href="{{ route('users.show', $user->id) }}" class="btn btn-sm table-btn"><i class="fa fa-eye"></i></a>
                                        <a href="#" class="btn btn-sm btn-secondary"><i class="fa fa-edit"></i></a>
                                        <form style="display: inline" action="{{ route('users.destroy', $user->id)}}" method="post">
										    @csrf
										    @method('DELETE')
                                            <button class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
										</form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="delEmployeeModal" class="modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete Employee</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="POST">
                    @method('DELETE')
                    @csrf
                    <p>Are you sure you want to delete this employee?</p>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-danger">Delete</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </form>
            </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
@endsection

