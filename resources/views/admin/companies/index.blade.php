@extends('admin.layout.appNew')

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropify/0.2.2/css/dropify.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        #filterCard { display: none; }
        .card-header-clickable .arrow { transition: transform 0.3s ease; }
        .card-header-clickable.active .arrow { transform: rotate(180deg); }
        .select2-container { width: 100% !important; }
        .select2-selection--single { height: 38px !important; border: 1px solid #dee2e6; }
        .select2-selection__rendered { line-height: 36px; }
        .select2-selection__arrow { height: 36px; }
        .input-group > .select2-container { flex: 1 1 auto; width: 1% !important; }
        .input-group > .select2-container .select2-selection--single {
            height: 38px !important; border-top-left-radius: 0; border-bottom-left-radius: 0;
        }
    </style>
@endsection

@section('content')
    <!-- Advanced Search Form -->
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
                                <form id="companySearchForm" action="{{ route('admin.companies.index') }}" method="GET" class="row g-3">
                                    <div class="col-md-4">
                                        <label class="form-label">Company Name</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-building"></i></span>
                                            <input type="text" name="company_name" class="form-control" value="{{ request('company_name') }}" placeholder="Search by name">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">GSTIN</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-file-invoice"></i></span>
                                            <input type="text" name="gstin" class="form-control" value="{{ request('gstin') }}" placeholder="Search by GSTIN">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Status</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-toggle-on"></i></span>
                                            <select name="status" class="form-select select2">
                                                <option value="">All Status</option>
                                                <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>Active</option>
                                                <option value="0" {{ request('status') == '0' ? 'selected' : '' }}>Inactive</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary"><i class="fas fa-search me-1"></i> Search</button>
                                        <button type="button" class="btn btn-secondary" data-action="reset-form"><i class="fas fa-redo me-1"></i> Reset</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Company Table -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-3">
                        <h4 class="header-title">Company List</h4>
                        <div class="d-flex gap-2">
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                    <i class="fas fa-download me-1"></i> Export
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="{{ route('admin.companies.export', array_merge(request()->query(), ['type' => 'excel'])) }}"><i class="fas fa-file-excel me-2"></i>Export to Excel</a></li>
                                    <li><a class="dropdown-item" href="{{ route('admin.companies.export', array_merge(request()->query(), ['type' => 'csv'])) }}"><i class="fas fa-file-csv me-2"></i>Export to CSV</a></li>
                                </ul>
                            </div>
                            <a href="{{ route('admin.companies.create') }}" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Add New Company</a>
                        </div>
                    </div>

                    <table id="companies-datatable" class="table table-bordered table-striped nowrap w-100">
                        <thead>
                            <tr>
                                <th>Company Name</th>
                                <th>GSTIN</th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th>City</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($companies as $company)
                                <tr>
                                    <td>{{ $company->company_name }}</td>
                                    <td>{{ $company->gstin }}</td>
                                    <td>{{ $company->phone }}</td>
                                    <td>{{ $company->email }}</td>
                                    <td>{{ $company->city }}</td>
                                    <td>
                                        <span class="badge bg-{{ $company->status ? 'success' : 'danger' }}">
                                            {{ $company->status ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.companies.edit', $company->id) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                                        <form action="{{ route('admin.companies.destroy', $company->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm delete-btn">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="d-flex justify-content-between align-items-center mt-4">
                        <div class="text-muted">
                            Showing {{ $companies->firstItem() }} to {{ $companies->lastItem() }} of {{ $companies->total() }} entries
                        </div>
                        <div>
                            {{ $companies->onEachSide(1)->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('adminTheme/assetsNew/vendor/dropzone/min/dropzone.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropify/0.2.2/js/dropify.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function () {
            initSelect2();
            $('#companies-datatable').DataTable({ paging: false, searching: false, ordering: false, responsive: true });

            if (window.location.search) {
                $('#filterCard').show();
                $('.card-header-clickable').addClass('active');
            }

            $('.dropify').dropify();
        });

        function initSelect2() {
            $('.select2').select2({
                width: '100%',
                dropdownParent: $('#filterCard'),
                minimumResultsForSearch: 10
            });
        }

        $('.card-header-clickable').on('click', function (e) {
            e.preventDefault();
            const filterCard = $('#filterCard');
            filterCard.slideToggle(300, function () {
                $(this).closest('.card-header-clickable').toggleClass('active', filterCard.is(':visible'));
                if (filterCard.is(':visible')) initSelect2();
            });
        });

        $('[data-action="reset-form"]').on('click', function () {
            const form = $(this).closest('form');
            form[0].reset();
            $('.select2').val(null).trigger('change');
            form.submit();
        });

        $(document).on('click', '.delete-btn', function () {
            alert("sadas0");
            let button = $(this);
            let url = button.data('url');

            if (!confirm('Are you sure you want to delete this item?')) {
                return;
            }

            $.ajax({
                url: url,
                type: 'POST',
                data: {
                    _method: 'DELETE',
                    _token: '{{ csrf_token() }}'
                },
                success: function (response) {
                    $.toast({
                        heading: 'Deleted',
                        text: response.message || 'Item deleted successfully.',
                        showHideTransition: 'slide',
                        icon: 'success',
                        position: 'top-right'
                    });

                    // Optional: reload DataTable or remove the row
                    setTimeout(() => {
                        location.reload();
                    }, 1000);
                },
                error: function (xhr) {
                    $.toast({
                        heading: 'Error',
                        text: 'Something went wrong while deleting.',
                        showHideTransition: 'fade',
                        icon: 'error',
                        position: 'top-right'
                    });
                }
            });
        });
    </script>
@endsection
