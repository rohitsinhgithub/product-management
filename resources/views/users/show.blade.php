@extends('admin.layout.appNew')

@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropify/0.2.2/css/dropify.min.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
@endsection

@section('content')
    @include('admin.layouts.shared.page-title', ['sub_title' => 'User Details', 'page_title' => 'User Management'])

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-3">
                        <h4 class="header-title">User Details</h4>
                        <div>
                            @can('user.edit')
                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning">
                                <i class="fas fa-edit"></i> Edit User
                            </a>
                            @endcan
                            
                            @can('user.permissions')
                            <a href="{{ route('users.permissions', $user->id) }}" class="btn btn-success">
                                <i class="fas fa-key"></i> Manage Permissions
                            </a>
                            @endcan
                            
                            <a href="{{ route('users.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Back to List
                            </a>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <h5>Basic Information</h5>
                                <table class="table table-bordered">
                                    <tr>
                                        <th style="width: 30%">ID</th>
                                        <td>{{ $user->id }}</td>
                                    </tr>
                                    <tr>
                                        <th>Name</th>
                                        <td>{{ $user->name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Email</th>
                                        <td>{{ $user->email }}</td>
                                    </tr>
                                    <tr>
                                        <th>Created At</th>
                                        <td>{{ $user->created_at }}</td>
                                    </tr>
                                    <tr>
                                        <th>Updated At</th>
                                        <td>{{ $user->updated_at }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="mb-3">
                                <h5>Roles</h5>
                                @if($user->roles->count() > 0)
                                    <div class="d-flex flex-wrap">
                                        @foreach($user->roles as $role)
                                            <span class="badge bg-primary me-2 mb-2 p-2">{{ $role->name }}</span>
                                        @endforeach
                                    </div>
                                @else
                                    <p>No roles assigned</p>
                                @endif
                            </div>
                            
                            <div class="mb-3">
                                <h5>Permissions</h5>
                                @if($user->permissions->count() > 0)
                                    <div class="d-flex flex-wrap">
                                        @foreach($user->permissions as $permission)
                                            <span class="badge bg-info me-2 mb-2 p-2">{{ $permission->name }}</span>
                                        @endforeach
                                    </div>
                                @else
                                    <p>No direct permissions assigned</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
@endsection 