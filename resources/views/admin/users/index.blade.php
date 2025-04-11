@extends('admin.layout.appNew')

@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropify/0.2.2/css/dropify.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropify/0.2.2/css/dropify.min.css">
<!-- Font Awesome CDN for icons -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
@endsection
@section('css')
<link href="{{ asset('adminTheme/assetsNew/vendor/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet">
<link href="{{ asset('adminTheme/assetsNew/vendor/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css') }}" rel="stylesheet">
<link href="{{ asset('adminTheme/assetsNew/vendor/datatables.net-fixedcolumns-bs5/css/fixedColumns.bootstrap5.min.css') }}" rel="stylesheet">
<link href="{{ asset('adminTheme/assetsNew/vendor/datatables.net-fixedheader-bs5/css/fixedHeader.bootstrap5.min.css') }}" rel="stylesheet">
<link href="{{ asset('adminTheme/assetsNew/vendor/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css') }}" rel="stylesheet">
<link href="{{ asset('adminTheme/assetsNew/vendor/datatables.net-select-bs5/css/select.bootstrap5.min.css') }}" rel="stylesheet">
@endsection
@section('content')
    {{-- @include('admin.layouts.shared/page-title', ['sub_title' => 'Permission', 'page_title' => 'permissions']) --}}

    <a href="{{ route('users.create') }}" class="btn btn-primary mb-3">
        <i class="fas fa-plus-circle"></i> Create New User
    </a>

    <div class="row">
        <div class="col-12">
            <div class="card">
                {{-- <div class="card-header">
                    <h4 class="header-title">Categories Data Table</h4>
                    <p class="text-muted mb-0">
                        Below is the list of categories.
                    </p>
                </div> --}}
                <div class="card-body">
                    <table id="basic-datatable" class="table table-striped dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Role</th>
                                <th>Email</th>
                                <th>Created At</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->getRoleNames() }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->created_at }}</td>
                                    <td>
                                        <a href="{{ route('users.edit', $user->id) }}" class="btn text-warning btn-sm"><i class="fas fa-pen-alt"></i></a>
                                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn text-danger btn-sm" onclick="return confirm('Are you sure you want to delete this permission?');"><i class="fas fa-trash-alt"></i></button>
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
    <script src="{{ asset('adminTheme/assetsNew/js/pages/datatable.init.js') }} "></script>
    <script src=" {{ asset('adminTheme/assets/modules/moduleForm.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropify/0.2.2/js/dropify.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.dropify').dropify();
        });
    </script>
@endsection