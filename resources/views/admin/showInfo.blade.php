@extends('admin.layout.appNew')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <h4 class="header-title">Information List</h4>
                    </div>
                    <div class="col-md-6 text-end">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addInfoModal">
                            <i class="ri-add-line me-1"></i> Add New Information
                        </button>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-centered table-nowrap mb-0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Created At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($infos as $info)
                                <tr>
                                    <td>{{ $info->id }}</td>
                                    <td>{{ $info->title }}</td>
                                    <td>{{ Str::limit($info->description, 50) }}</td>
                                    <td>{{ $info->created_at->format('d M Y, h:i A') }}</td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-info view-info" data-id="{{ $info->id }}" data-title="{{ $info->title }}" data-description="{{ $info->description }}">
                                            <i class="ri-eye-line"></i>
                                        </button>
                                        <button type="button" class="btn btn-sm btn-primary edit-info" data-id="{{ $info->id }}" data-title="{{ $info->title }}" data-description="{{ $info->description }}">
                                            <i class="ri-edit-line"></i>
                                        </button>
                                        <button type="button" class="btn btn-sm btn-danger delete-info" data-id="{{ $info->id }}">
                                            <i class="ri-delete-bin-line"></i>
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">No information found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add Info Modal -->
<div class="modal fade" id="addInfoModal" tabindex="-1" aria-labelledby="addInfoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('admin.storeInfo') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addInfoModalLabel">Add New Information</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" id="title" name="title" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="4" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- View Info Modal -->
<div class="modal fade" id="viewInfoModal" tabindex="-1" aria-labelledby="viewInfoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewInfoModalLabel">View Information</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h5 id="view-title"></h5>
                <p id="view-description"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        // View Info
        $('.view-info').click(function() {
            var title = $(this).data('title');
            var description = $(this).data('description');
            
            $('#view-title').text(title);
            $('#view-description').text(description);
            
            $('#viewInfoModal').modal('show');
        });
        
        // Delete Info
        $('.delete-info').click(function() {
            var id = $(this).data('id');
            
            if (confirm('Are you sure you want to delete this information?')) {
                // You would need to implement a delete route and controller method
                // window.location.href = '/admin/info/' + id + '/delete';
            }
        });
    });
</script>
@endsection 