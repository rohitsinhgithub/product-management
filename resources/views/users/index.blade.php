@extends('admin.layout.appNew')

@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropify/0.2.2/css/dropify.min.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
    #filterCard {
        display: none;
    }
    
    .card-header-clickable .arrow {
        transition: transform 0.3s ease;
    }
    .card-header-clickable.active .arrow {
        transform: rotate(180deg);
    }
    .select2-container {
        width: 100% !important;
    }
    .select2-container .select2-selection--single {
        height: 38px !important;
        border: 1px solid #dee2e6;
    }
    .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: 36px;
    }
    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 36px;
    }
    .input-group > .select2-container {
        flex: 1 1 auto;
        width: 1% !important;
    }
    .input-group > .select2-container .select2-selection--single {
        height: 38px !important;
        border-top-left-radius: 0;
        border-bottom-left-radius: 0;
    }
</style>
@endsection

@section('content')
    {{-- @include('admin.layouts.shared.page-title', ['sub_title' => 'Users', 'page_title' => 'User Management']) --}}

    <div class="row mb-3">
        <div class="col-12">
            <div class="card">
                 <div class="card-body">
                    <div class="card-header-clickable d-flex justify-content-between align-items-center" onclick="toggleFilter()">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-filter me-2"></i>
                            <h5 class="mb-0">Advanced Search & Filters</h5>
                        </div>
                        <div>
                            <i class="fas fa-chevron-down arrow"></i>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div id="filterCard">
                            <div class="p-3">
                                <form action="{{ route('users.index') }}" method="GET" class="row g-3">
                                    <div class="col-md-3">
                                        <label class="form-label">Name</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                                            <input type="text" class="form-control" name="name" value="{{ request('name') }}" placeholder="Search by name">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Email</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                            <input type="email" class="form-control" name="email" value="{{ request('email') }}" placeholder="Search by email">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Role</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-user-tag"></i></span>
                                            <select class="form-select select2" name="role" data-placeholder="Select Role">
                                                <option value="">All Roles</option>
                                                @foreach($roles as $role)
                                                    <option value="{{ $role->id }}" {{ request('role') == $role->id ? 'selected' : '' }}>
                                                        {{ $role->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Date Range</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                            <input type="date" class="form-control" name="date_from" value="{{ request('date_from') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">To Date</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                            <input type="date" class="form-control" name="date_to" value="{{ request('date_to') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Sort By</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-sort"></i></span>
                                            <select class="form-select select2" name="sort_by" data-placeholder="Select Sort Field">
                                                <option value="created_at" {{ request('sort_by') == 'created_at' ? 'selected' : '' }}>Created Date</option>
                                                <option value="name" {{ request('sort_by') == 'name' ? 'selected' : '' }}>Name</option>
                                                <option value="email" {{ request('sort_by') == 'email' ? 'selected' : '' }}>Email</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Order</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-sort-amount-down"></i></span>
                                            <select class="form-select select2" name="order" data-placeholder="Select Order">
                                                <option value="desc" {{ request('order') == 'desc' ? 'selected' : '' }}>Descending</option>
                                                <option value="asc" {{ request('order') == 'asc' ? 'selected' : '' }}>Ascending</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-search me-1"></i> Search
                                        </button>
                                        <a href="{{ route('users.index') }}" class="btn btn-secondary">
                                            <i class="fas fa-redo me-1"></i> Reset
                                        </a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-3">
                        <h4 class="header-title">Users List</h4>
                        <div class="d-flex gap-2">
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="downloadDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-download me-1"></i> Export
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="downloadDropdown">
                                    <li>
                                        <a class="dropdown-item" href="{{ route('users.export', array_merge(request()->query(), ['type' => 'excel'])) }}">
                                            <i class="fas fa-file-excel me-2"></i> Export to Excel
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('users.export', array_merge(request()->query(), ['type' => 'csv'])) }}">
                                            <i class="fas fa-file-csv me-2"></i> Export to CSV
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            @can('user.create')
                            <a href="{{ route('users.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus-circle"></i> Add New User
                            </a>
                            @endcan
                        </div>
                    </div>

                    <table id="basic-datatable" class="table table-striped dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th>
                                    <a href="{{ route('users.index', array_merge(request()->query(), ['sort_by' => 'id', 'order' => request('order') == 'asc' ? 'desc' : 'asc'])) }}" class="text-dark">
                                        ID
                                        @if(request('sort_by') == 'id')
                                            <i class="fas fa-sort-{{ request('order') == 'asc' ? 'up' : 'down' }}"></i>
                                        @else
                                            <i class="fas fa-sort text-muted"></i>
                                        @endif
                                    </a>
                                </th>
                                <th>
                                    <a href="{{ route('users.index', array_merge(request()->query(), ['sort_by' => 'name', 'order' => request('order') == 'asc' ? 'desc' : 'asc'])) }}" class="text-dark">
                                        Name
                                        @if(request('sort_by') == 'name')
                                            <i class="fas fa-sort-{{ request('order') == 'asc' ? 'up' : 'down' }}"></i>
                                        @else
                                            <i class="fas fa-sort text-muted"></i>
                                        @endif
                                    </a>
                                </th>
                                <th>
                                    <a href="{{ route('users.index', array_merge(request()->query(), ['sort_by' => 'email', 'order' => request('order') == 'asc' ? 'desc' : 'asc'])) }}" class="text-dark">
                                        Email
                                        @if(request('sort_by') == 'email')
                                            <i class="fas fa-sort-{{ request('order') == 'asc' ? 'up' : 'down' }}"></i>
                                        @else
                                            <i class="fas fa-sort text-muted"></i>
                                        @endif
                                    </a>
                                </th>
                                <th>Roles</th>
                                <th>
                                    <a href="{{ route('users.index', array_merge(request()->query(), ['sort_by' => 'created_at', 'order' => request('order') == 'asc' ? 'desc' : 'asc'])) }}" class="text-dark">
                                        Created At
                                        @if(request('sort_by') == 'created_at')
                                            <i class="fas fa-sort-{{ request('order') == 'asc' ? 'up' : 'down' }}"></i>
                                        @else
                                            <i class="fas fa-sort text-muted"></i>
                                        @endif
                                    </a>
                                </th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        @foreach($user->roles as $role)
                                            <span class="badge bg-primary">{{ $role->name }}</span>
                                        @endforeach
                                    </td>
                                    <td>{{ $user->created_at }}</td>
                                    <td>
                                        @can('user.view')
                                        <a href="{{ route('users.show', $user->id) }}" class="btn btn-info btn-sm">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        @endcan
                                        
                                        @can('user.edit')
                                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning btn-sm">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        @endcan
                                        
                                        @can('user.permissions')
                                        <a href="{{ route('users.permissions', $user->id) }}" class="btn btn-success btn-sm">
                                            <i class="fas fa-key"></i>
                                        </a>
                                        @endcan
                                        @if(!collect($user->roles)->pluck('name')->contains('super admin') && $user->id != auth()->id())
                                            @can('user.delete')
                                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this user?');">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                            @endcan
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="d-flex justify-content-between align-items-center mt-4">
                        <div class="text-muted">
                            Showing {{ $users->firstItem() }} to {{ $users->lastItem() }} of {{ $users->total() }} entries
                        </div>
                        <div>
                            {{ $users->onEachSide(1)->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        // Initialize Select2
        function initSelect2() {
            $('.select2').select2({
                width: '100%',
                dropdownParent: $('#filterCard'),
                minimumResultsForSearch: 10
            });
        }

        // Toggle filter function
        function toggleFilter() {
            const filterCard = document.getElementById('filterCard');
            const header = document.querySelector('.card-header-clickable');
            
            if (filterCard.style.display === 'none' || !filterCard.style.display) {
                filterCard.style.display = 'block';
                header.classList.add('active');
                initSelect2();
            } else {
                filterCard.style.display = 'none';
                header.classList.remove('active');
            }
        }

        $(document).ready(function() {
            initSelect2();

            $('#basic-datatable').DataTable({
                "paging": false,
                "searching": false,
                "ordering": false
            });

            // Show filter card if there are any active filters
            if (window.location.search) {
                document.getElementById('filterCard').style.display = 'block';
                document.querySelector('.card-header-clickable').classList.add('active');
                initSelect2();
            }
        });
    </script>
@endsection 