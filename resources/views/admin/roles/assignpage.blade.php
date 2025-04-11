@extends('admin.layout.appNew')

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropify/0.2.2/css/dropify.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        /* .permissions-wrapper {
            padding: 1rem;
            background: #fff;
            border-radius: 0.5rem;
            box-shadow: 0 0 10px rgba(0,0,0,0.05);
        } */
        .permission-group {
            border: 1px solid #e9ecef;
            border-radius: 0.5rem;
            margin-bottom: 1rem;
            overflow: hidden;
        }
        .permission-group-header {
            /* background: #f8f9fa; */
            padding: 1rem;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 1px solid #e9ecef;
        }
        .permission-group-header:hover {
            /* background: #e9ecef; */
        }
        .permission-group-title {
            font-weight: 600;
            /* color: #495057; */
            margin: 0;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        .permission-group-content {
            padding: 1rem;
            /* background: #fff; */
        }
        .permission-item {
            display: flex;
            align-items: center;
            padding: 0.5rem;
            border-radius: 0.25rem;
            margin-bottom: 0.5rem;
        }
        .permission-item:hover {
            /* background: #f8f9fa; */
        }
        .permission-checkbox {
            margin-right: 1rem;
        }
        .permission-details {
            flex-grow: 1;
        }
        .permission-name {
            font-weight: 500;
            /* color: #495057; */
            margin-bottom: 0.25rem;
        }
        .permission-description {
            /* color: #6c757d; */
            font-size: 0.875rem;
        }
        .group-checkbox {
            width: 1.2rem;
            height: 1.2rem;
            margin-right: 0.5rem;
        }
        .permission-checkbox {
            width: 1.2rem;
            height: 1.2rem;
        }
        .btn {
            padding: 0.5rem 1.5rem;
            font-weight: 500;
            border-radius: 0.25rem;
        }
        /* .btn-primary {
            background-color: #3b7ddd;
            border-color: #3b7ddd;
        }
        .btn-warning {
            background-color: #f7b84b;
            border-color: #f7b84b;
            color: #fff;
        } */
        .btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        .collapse-icon {
            transition: transform 0.2s;
        }
        .collapsed .collapse-icon {
            transform: rotate(-90deg);
        }
    </style>
@endsection

@section('content')
    @include('admin.layouts.shared.page-title', ['sub_title' => 'Assign Permissions', 'page_title' => 'Role Permissions'])

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h4 class="header-title">Assign Permissions to <span class="text-primary">{{ $role->name }}</span></h4>
                    </div>

                    <form method="POST" action="{{ route('admin.roles.storeAssignedPermissions', $role->id) }}">
                        @csrf
                        
                        <div class="permissions-wrapper">
                            @php
                                $permissionGroups = $permissions->groupBy(function ($permission) {
                                    return explode('.', $permission->name)[0];
                                });
                            @endphp

                            @foreach($permissionGroups as $groupName => $groupPermissions)
                            <div class="permission-group">
                                <div class="permission-group-header" data-bs-toggle="collapse" data-bs-target="#group-{{ $groupName }}">
                                    <div class="permission-group-title">
                                        <input type="checkbox" 
                                               class="group-checkbox form-check-input"
                                               data-group="{{ $groupName }}"
                                               @if($groupPermissions->every(function($p) use ($assignedPermissions) { return in_array($p->id, $assignedPermissions); })) checked @endif>
                                        <span class="text-capitalize">{{ $groupName }}</span>
                                    </div>
                                    <i class="fas fa-chevron-down collapse-icon"></i>
                                </div>
                                <div class="permission-group-content collapse show" id="group-{{ $groupName }}">
                                    @foreach($groupPermissions as $permission)
                                    <div class="permission-item">
                                        <input type="checkbox" 
                                               name="permissions[]" 
                                               value="{{ $permission->id }}" 
                                               class="permission-checkbox form-check-input"
                                               data-group="{{ $groupName }}"
                                               @if(in_array($permission->id, $assignedPermissions)) checked @endif>
                                        <div class="permission-details">
                                            <div class="permission-name">{{ $permission->name }}</div>
                                            @if($permission->description)
                                            <div class="permission-description">{{ $permission->description }}</div>
                                            @endif
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            @endforeach
                        </div>

                        <div class="mt-4 d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-1"></i> Save Permissions
                            </button>
                            <a href="{{ route('admin.roles.index') }}" class="btn btn-warning">
                                <i class="fas fa-arrow-left me-1"></i> Back
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            // Handle group checkbox changes
            $('.group-checkbox').on('change', function() {
                const group = $(this).data('group');
                const isChecked = $(this).prop('checked');
                $(`.permission-checkbox[data-group="${group}"]`).prop('checked', isChecked);
            });

            // Handle individual permission checkbox changes
            $('.permission-checkbox').on('change', function() {
                const group = $(this).data('group');
                const groupCheckbox = $(`.group-checkbox[data-group="${group}"]`);
                const totalPermissions = $(`.permission-checkbox[data-group="${group}"]`).length;
                const checkedPermissions = $(`.permission-checkbox[data-group="${group}"]:checked`).length;
                
                groupCheckbox.prop('checked', totalPermissions === checkedPermissions);
            });

            // Toggle collapse icon rotation
            $('.permission-group-header').on('click', function() {
                $(this).toggleClass('collapsed');
            });
        });
    </script>
@endsection
