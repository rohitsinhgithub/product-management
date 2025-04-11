@extends('admin.layout.appNew')

@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropify/0.2.2/css/dropify.min.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">
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
    <div class="row mb-3">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-header-clickable d-flex justify-content-between align-items-center">
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
                                <form id="permissionSearchForm" action="{{ route('admin.permissions.index') }}" method="GET" class="row g-3">
                                    <div class="col-md-4">
                                        <label class="form-label">Permission Name</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-key"></i></span>
                                            <input type="text" class="form-control" name="name" value="{{ request('name') }}" placeholder="Search by name">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Created From</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                            <input type="date" class="form-control" name="created_from" value="{{ request('created_from') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Created To</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                            <input type="date" class="form-control" name="created_to" value="{{ request('created_to') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Sort By</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-sort"></i></span>
                                            <select class="form-select select2" name="sort_by" data-placeholder="Select Sort Field">
                                                <option value="created_at" {{ request('sort_by') == 'created_at' ? 'selected' : '' }}>Created Date</option>
                                                <option value="name" {{ request('sort_by') == 'name' ? 'selected' : '' }}>Name</option>
                                                <option value="id" {{ request('sort_by') == 'id' ? 'selected' : '' }}>ID</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
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
                                        <button type="button" class="btn btn-secondary" data-action="reset-form">
                                            <i class="fas fa-redo me-1"></i> Reset
                                        </button>
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
                        <h4 class="header-title">Permissions Management</h4>
                        <div class="d-flex gap-2">
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="downloadDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-download me-1"></i> Export
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="downloadDropdown">
                                    <li>
                                        <a class="dropdown-item" href="{{ route('admin.permissions.export', array_merge(request()->query(), ['type' => 'excel'])) }}">
                                            <i class="fas fa-file-excel me-2"></i> Export to Excel
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('admin.permissions.export', array_merge(request()->query(), ['type' => 'csv'])) }}">
                                            <i class="fas fa-file-csv me-2"></i> Export to CSV
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <a href="{{ route('admin.permissions.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus-circle"></i> Create New Permission
                            </a>
                        </div>
                    </div>

                    <table id="permissions-datatable" class="table table-striped dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th>
                                    <a href="{{ route('admin.permissions.index', array_merge(request()->query(), ['sort_by' => 'id', 'order' => request('order') == 'asc' ? 'desc' : 'asc'])) }}" class="text-dark">
                                        ID
                                        @if(request('sort_by') == 'id')
                                            <i class="fas fa-sort-{{ request('order') == 'asc' ? 'up' : 'down' }}"></i>
                                        @else
                                            <i class="fas fa-sort text-muted"></i>
                                        @endif
                                    </a>
                                </th>
                                <th>
                                    <a href="{{ route('admin.permissions.index', array_merge(request()->query(), ['sort_by' => 'name', 'order' => request('order') == 'asc' ? 'desc' : 'asc'])) }}" class="text-dark">
                                        Name
                                        @if(request('sort_by') == 'name')
                                            <i class="fas fa-sort-{{ request('order') == 'asc' ? 'up' : 'down' }}"></i>
                                        @else
                                            <i class="fas fa-sort text-muted"></i>
                                        @endif
                                    </a>
                                </th>
                                <th>
                                    <a href="{{ route('admin.permissions.index', array_merge(request()->query(), ['sort_by' => 'created_at', 'order' => request('order') == 'asc' ? 'desc' : 'asc'])) }}" class="text-dark">
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
                            @foreach ($permissions as $permission)
                                <tr>
                                    <td>{{ $permission->id }}</td>
                                    <td>{{ $permission->name }}</td>
                                    <td>{{ $permission->created_at->format('Y-m-d H:i:s') }}</td>
                                    <td>
                                        <a href="{{ route('admin.permissions.edit', $permission->id) }}" class="btn btn-warning btn-sm" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.permissions.destroy', $permission->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this permission?');" title="Delete">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="d-flex justify-content-between align-items-center mt-4">
                        <div class="text-muted">
                            Showing {{ $permissions->firstItem() ?? 0 }} to {{ $permissions->lastItem() ?? 0 }} of {{ $permissions->total() ?? 0 }} entries
                        </div>
                        <div>
                            {{ $permissions->onEachSide(1)->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('adminTheme/assetsNew/vendor/dropzone/min/dropzone.min.js') }}"></script>
    <script src="{{ asset('adminTheme/assets/modules/moduleForm.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropify/0.2.2/js/dropify.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>

    <script>
        $(document).ready(function() {
            // Initialize Select2
            initSelect2();

            // Initialize DataTable
            var table = $('#permissions-datatable').DataTable({
                "paging": false,
                "searching": false,
                "ordering": false,
                responsive: true
            });

            // Initialize Dropify
            $('.dropify').dropify();

            // Show filter card if there are any active filters
            if (window.location.search) {
                $('#filterCard').show();
                $('.card-header-clickable').addClass('active');
                initSelect2();
            }
        });

        // Initialize Select2
        function initSelect2() {
            $('.select2').select2({
                width: '100%',
                dropdownParent: $('#filterCard'),
                minimumResultsForSearch: 10
            });
        }

        // Toggle filter function
        $(document).on('click', '.card-header-clickable', function(e) {
            e.preventDefault();
            const filterCard = $('#filterCard');
            const header = $(this);
            
            filterCard.slideToggle(300, function() {
                if (filterCard.is(':visible')) {
                    header.addClass('active');
                    initSelect2(); // Reinitialize Select2 when filter card becomes visible
                } else {
                    header.removeClass('active');
                }
            });
        });

        // Reset form function
        $(document).on('click', '[data-action="reset-form"]', function(e) {
            e.preventDefault();
            const form = $(this).closest('form');
            form[0].reset();
            $('.select2').val(null).trigger('change');
            form.submit();
        });

        // Handle form submission
        $('#permissionSearchForm').on('submit', function(e) {
            e.preventDefault();
            $(this).submit();
        });

        // Export button click handler
        $('.export-btn').on('click', function(e) {
            e.preventDefault();
            const type = $(this).data('type');
            const currentUrl = new URL(window.location.href);
            currentUrl.searchParams.set('type', type);
            window.location.href = currentUrl.toString();
        });
    </script>
@endsection