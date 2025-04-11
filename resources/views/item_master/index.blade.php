@extends('admin.layout.appNew')

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropify/0.2.2/css/dropify.min.css">
    <!-- Font Awesome CDN for icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
@endsection

@section('content')
    {{-- @include('admin.layouts.shared/page-title', ['sub_title' => 'Master', 'page_title' => 'Item Master']) --}}

    <a href="{{ route('items.create') }}" class="btn btn-primary mb-3">
        <i class="fas fa-plus-circle"></i> Create New Item
    </a>

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
                    <table id="basic-datatable" class="table table-striped dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th>Item ID</th>
                                <th>Name</th>
                                <th>Item Type</th>
                                <th>Category</th>
                                <th>Sub Category</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->item_type }}</td>
                                    <td>{{ $item->category->category_name ?? 'N/A' }}</td> <!-- Assuming you have a relationship -->
                                    <td>{{ $item->sub_category->sub_category ?? 'N/A' }}</td> <!-- Assuming you have a relationship -->
                                    <td>{{ $item->is_available ? 'Active' : 'Inactive' }}</td>
                                    <td>
                                        <a href="{{ route('items.edit', $item->id) }}" class="btn text-warning btn-sm" title="Edit">
                                            <i class="fas fa-pen-alt"></i>
                                        </a>
                                        <form action="{{ route('items.destroy', $item->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn text-danger btn-sm" onclick="return confirm('Are you sure you want to delete this item?');" title="Delete">
                                                <i class="fas fa-trash-alt"></i>
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
@endsection