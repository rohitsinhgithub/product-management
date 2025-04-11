@extends('admin.layout.appNew')

@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropify/0.2.2/css/dropify.min.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
<style>
    .permissions-table th, .permissions-table td {
        padding: 10px;
        text-align: left;
    }
    .permissions-table th {
        background-color: #f8f9fa;
    }
    .select-all-checkbox {
        margin-bottom: 20px;
    }
</style>
@endsection

@section('content')
    @include('admin.layouts.shared.page-title', ['sub_title' => 'User Permissions', 'page_title' => 'Manage User Permissions'])

    <h1>Assign Permissions to <strong>{{ $user->name }}</strong></h1>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <!-- Form to assign permissions -->
                    <form method="POST" action="{{ route('users.updatePermissions', $user->id) }}">
                        @csrf
                        @method('PUT')
                        <h5>Permissions for this User</h5>

                        <div class="select-all-checkbox">
                            <label>
                                <input type="checkbox" id="selectAll" /> Select All Permissions
                            </label>
                        </div>

                        <table class="permissions-table w-100">
                            <thead>
                                <tr>
                                    <th>Select</th>
                                    <th>Permission Name</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($permissions as $permission)
                                    <tr>
                                        <td>
                                            <input type="checkbox" name="permissions[]" value="{{ $permission->name }}" 
                                            @if(in_array($permission->name, $userPermissions)) checked @endif>
                                        </td>
                                        <td>{{ $permission->name }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <button type="submit" class="btn btn-primary mt-4">Save Permissions</button>
                        <a href="{{ route('users.index') }}" class="btn btn-warning mt-4">Back</a>
                    </form>
                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div><!-- end col-->
    </div> <!-- end row-->
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <script>
        $(document).ready(function() {
            // Toggle all checkboxes when the "Select All" checkbox is checked
            $('#selectAll').on('change', function() {
                $('input[name="permissions[]"]').prop('checked', this.checked);
            });
        });
    </script>
@endsection 