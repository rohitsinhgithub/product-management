@extends('admin.layout.appNew')

@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropify/0.2.2/css/dropify.min.css">
<link rel="stylesheet" href="{{ asset('adminTheme/assetsNew/vendor/jquery-toast-plugin/jquery.toast.min.css') }}">
@endsection

@section('content')
    {{-- @include('admin.layouts.shared/page-title', ['sub_title' => 'Roles', 'page_title' => isset($permission) ? 'Edit Permission' : 'Create Permission']) --}}

    {{-- <h1>{{ isset($permissio) ? 'Edit Permission' : 'Create Permission' }}</h1> --}}
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ isset($permission) ? route('admin.permissions.update', $permission->id) : route('admin.permissions.store') }}" 
                        method="POST" class="ajax-form-new-21">
                        @csrf
                        {{-- <input type="hidden" name="_token" value="{{ csrf_token() }}"> --}}
                        @if(isset($permission))
                            @method('PUT')
                        @endif
                        <div class="row g-2">
                            <div class="mb-3 col-md-6">
                                <label for="name" class="form-label">Permission Name</label>
                                <input type="text" name="name" class="form-control" placeholder="Permission Name" value="{{ old('name', isset($permission) ? $permission->name : '') }}" required>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary submit-btn">{{ isset($permission) ? 'Update' : 'Save' }}</button>
                        <a href="{{ route('admin.permissions.index') }}" class="btn btn-warning submit-btn">Back</a>
                    </form>
                </div> <!-- end card-body -->
            </div> <!-- end card-->
        </div> <!-- end col -->
    </div>

<!-- Toastr Notifications -->

@endsection
@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="{{ asset('adminTheme/assetsNew/vendor/jquery-toast-plugin/jquery.toast.min.js') }}"></script>

    <script>
        $(document).ready(function () {
            $(".ajax-form-new-21").on("submit", function (e) {
                e.preventDefault();
                let form = $(this);
                let formData = new FormData(this);
                let submitButton = form.find(".submit-btn");

                submitButton.prop("disabled", true);

                $.ajax({
                    url: form.attr("action"),
                    method: form.attr("method"),
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        $.toast({
                            heading: 'message',
                             text: response.message, // Show success message
                            showHideTransition: 'slide',
                            icon: 'success',
                            position: 'top-right'
                        });
                        form[0].reset(); // Reset form after success
                        setTimeout(function () {
                            window.location.href = "{{ route('admin.permissions.index') }}"; // Update with your index route
                }, 2000);
                        submitButton.prop("disabled", false);
                    },
                    error: function (xhr) {
                        if (xhr.status === 422) {
                            let errors = xhr.responseJSON.errors;
                            $.each(errors, function (key, value) {
                                $.toast({
                                    heading: 'Error',
                                    text: value[0],
                                    showHideTransition: 'fade',
                                    icon: 'error',
                                    position: 'top-right'
                                });
                            });
                        } else {
                            $.toast({
                                heading: 'Error',
                                text: 'Something went wrong! Please try again.',
                                showHideTransition: 'fade',
                                icon: 'error',
                                position: 'top-right'
                            });
                        }
                        submitButton.prop("disabled", false);
                    }
                });
            });
        });
    </script>
@endsection