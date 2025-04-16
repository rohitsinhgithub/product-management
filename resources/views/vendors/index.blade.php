@extends('admin.layout.appNew')

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropify/0.2.2/css/dropify.min.css">
    <!-- Font Awesome CDN for icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
@endsection

@section('content')
    {{-- @include('admin.layouts.shared/page-title', ['sub_title' => 'Master', 'page_title' => 'Item Master']) --}}
    <div class="row">
        <div class="col-12">
            <div class="card">
                {{-- <div class="card-header">
                    <h4 class="header-title">Item Master Data Table</h4>
                    <p class="text-muted mb-0">
                        Below is the list of items.
                    </p>
                </div> --}}
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-3">
                        <h4 class="header-title">Vendors List</h4>
                        <div class="d-flex gap-2">
                            <a href="{{ route('vendors.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus-circle"></i> Add New Vendors
                            </a>
                        </div>
                    </div>
                    <table id="Vendors-datatable" class="table table-striped dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th>Company Name</th>
                                <th>Contact Person</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($vendors as $vendor)
                            <tr>
                                <td>{{ $vendor->company_name }}</td>
                                <td>{{ $vendor->contact_person }}</td>
                                <td>{{ $vendor->email }}</td>
                                <td>{{ $vendor->phone_number }}</td>
                                <td>
                                    <span class="badge bg-{{ $vendor->status ? 'success' : 'danger' }}">
                                        {{ $vendor->status ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('vendors.edit', $vendor->id) }}" class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('vendors.destroy', $vendor->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div><!-- end col-->
    </div> <!-- end row-->
@endsection

@section('scripts')
    <!-- Dropzone File Upload js -->
    <script src="{{ asset('adminTheme/assetsNew/vendor/dropzone/min/dropzone.min.js') }} "></script>
    <script src=" {{ asset('adminTheme/assets/modules/moduleForm.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropify/0.2.2/js/dropify.min.js"></script>

    <!-- DataTables Buttons -->
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endsection