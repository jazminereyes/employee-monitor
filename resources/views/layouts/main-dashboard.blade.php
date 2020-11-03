<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="_token" content="{{csrf_token()}}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('/css/master.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/dashboard.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
    <title>@yield('title')</title>
</head>

<body>
    <div class="dashboard-main-wrapper">
        <div class="dashboard-header">
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

                                @if(auth()->user()->user_type == 'admin')
                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#editSettingsModal"><i class="fa fa-gear mr-2"></i>Settings</a>
                                @endif
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                    <i class="fa fa-power-off mr-2"></i>{{ __('Sign Out') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>

        <div class="nav-left-sidebar">
            <div class="menu-list">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav flex-column">
                            <li class="nav-item" id="dashboard">
                                <a class="nav-link" href="@if(auth()->user()->user_type == 'admin'){{ route('admin.home') }}@else{{ route('manager.home') }}@endif">
                                    <i class="fa fa-fw fa-dashboard"></i>Dashboard
                                </a>
                            </li>
                            @if(auth()->user()->user_type=='admin')
                            <li class="nav-item" id="company">
                                <a class="nav-link" href="{{ route('company.create') }}"><i class="fa fa-fw fa-building"></i>Company</a>
                            </li>
                            @endif
                        </ul>
                    </div>
                </nav>
            </div>
        </div>

        <div class="dashboard-wrapper">
            <div class="container-fluid dashboard-content ">
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="page-header">
                            <div class="page-breadcrumb">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        @yield('breadcrumb')
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
                @yield('content')
            </div>
        </div>
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
                    <form action="{{ route('profile') }}" method="POST">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label for="name">Name <span class="req text-danger">*</span></label>
                            <input type="text" id="name" class="form-control" name="name" value="{{ auth()->user()->name }}" required readonly>
                        </div>
                        <div class="form-group">
                            <label for="email">Email Address <span class="req text-danger">*</span></label>
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

    <div id="editSettingsModal" class="modal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Monitoring Settings</h5>
                    <button type="button" class="close setting-close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php
                        use App\Company;
                        $company = Company::find(auth()->user()->company_id);
                    ?>
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <button id="edit-setting" class="btn btn-secondary btn-sm pull-right">Edit <i class="fa fa-edit"></i></button>
                        </div>
                    </div>
                    <form action="{{ route('setting') }}" method="POST">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label for="frequency">Frequency <span class="req text-danger">*</span></label>
                            <select name="frequency" id="frequency" class="form-control" disabled>
                                <option value="random">Random</option>
                                <option value="scheduled">Scheduled</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="interval">Interval <span class="req text-danger">*</span></label>
                            <select name="interval" id="interval" class="form-control" disabled>
                                <option value="second">Every second</option>
                                <option value="minute">Every minute</option>
                                <option value="hour">Every hour</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="duration">Duration <span class="req text-danger">*</span></label>
                            <input type="number" class="form-control" name="duration" value="{{ $company->duration }}" readonly>
                        </div>
                    
                </div>
                <div class="modal-footer">
                    <button id="save-setting" type="submit" class="btn btn-action">Save</button>
                    <button type="button" class="btn btn-secondary setting-close" data-dismiss="modal">Close</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
    <script src="https://www.WebRTC-Experiment.com/RecordRTC.js"></script>
    <script src="{{ asset('/js/main.js') }}"></script>
    <script src="{{ asset('/js/RecordLib.js') }}"></script>
    @yield('js')
    <script>
        $(document).ready(function(){
            var active = @yield('active');
            $(active).find('.nav-link').addClass('active');

            $("#password-block").css('display', 'none');
            $("#save-profile").css('display', 'none');
            $("#save-setting").css('display', 'none');
            $('#editSettingsModal #frequency').val("{{$company->frequency}}");
            $('#editSettingsModal #interval').val("{{$company->interval}}");
            $(".req").css('display', 'none');

            $("#edit-profile").click(function(){
                $("#password-block").css('display', 'block');
                $("#editProfileModal input").removeAttr('readonly');
                $("#save-profile").css('display', 'block');
                $(this).attr('disabled', 'disabled');
                $(".req").css('display', 'inline-block');
            });

            $("#editProfileModal button.profile-close").click(function(){
                $("#password-block").css('display', 'none');
                $("#editProfileModal input").attr('readonly', 'readonly');
                $("#save-profile").css('display', 'none');
                $("#edit-profile").removeAttr('disabled');
                $(".req").css('display', 'none');
            });

            $("#edit-setting").click(function(){
                $("#editSettingsModal select").removeAttr('disabled');
                $("#editSettingsModal input").removeAttr('readonly');
                $("#save-setting").css('display', 'block');
                $(this).attr('disabled', 'disabled');
                $(".req").css('display', 'inline-block');
            });

            $("#editSettingsModal button.setting-close").click(function(){
                $("#editSettingsModal select").attr('disabled', 'disabled');
                $("#editSettingsModal input").attr('readonly', 'readonly');
                $("#save-setting").css('display', 'none');
                $("#edit-setting").removeAttr('disabled');
                $(".req").css('display', 'none');
            });
        });
    </script>
</body>
 
</html>