@extends('layouts.main-dashboard')

@section('title', 'Dashboard')

@section('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page"><a>Dashboard</a></li>
@endsection

@section('active', 'dashboard')

@section('content')
    <div class="row mt-3">
        <div class="col-md-12">
        <h3>Employees</h3>
        </div>
    </div>
    @include('layouts.alert')
    <div class="row mt-2">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <button class="btn btn-sm btn-action pull-right" data-toggle="modal" data-target="#addEmployeeModal">Add Employee <i class="fa fa-plus ml-2"></i></button>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
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
                                        <button class="btn btn-sm btn-secondary"><i class="fa fa-edit" data-toggle="modal" data-target="#editEmployeeModal"></i></button>
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
 <form action = "{{ route('users.store') }}" method="POST" >
 @csrf
    <div id="addEmployeeModal" class="modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Employee</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email Address <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password <span class="text-danger">*</span></label>
                        <input type="password" class="form-control" name="password" required>
                    </div>
                    <div class="form-group">
                        <label for="break">Break Time <span class="text-danger">*</span></label>
                        <input type="time" class="form-control" name="break_time" required>
                    </div>          
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-action">Submit</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
            </div>
        </div>
    </div>
</form>

 <form method="post" action="#">
 @method('PATCH')
 @csrf
    <div id="editEmployeeModal" class="modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Employee Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email Address <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password <span class="text-danger">*</span></label>
                        <input type="password" class="form-control" name="password" required>
                    </div>
                    <div class="form-group">
                        <label for="break">Break Time <span class="text-danger">*</span></label>
                        <input type="time" class="form-control" name="break_time" required>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-action">Submit</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
            </div>
        </div>
    </div>
</form>
@endsection