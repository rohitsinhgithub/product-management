@extends('admin.layout.appNew')

@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropify/0.2.2/css/dropify.min.css">
<link rel="stylesheet" href="{{ asset('adminTheme/assetsNew/vendor/jquery-toast-plugin/jquery.toast.min.css') }}">
@endsection

@section('content')
    @include('admin.layouts.shared/page-title', ['sub_title' => 'Category', 'page_title' => isset($category) ? 'Edit Category' : 'Create Category'])

    <h1>{{ isset($category) ? 'Edit Category' : 'Create Category' }}</h1>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ isset($category) ? route('categories.update', $category->id) : route('categories.store') }}" 
                        method="POST" class="ajax-form-new-21">
                        @csrf
                        {{-- <input type="hidden" name="_token" value="{{ csrf_token() }}"> --}}
                        @if(isset($category))
                            @method('PUT')
                        @endif
                        <div class="row g-2">
                            <div class="mb-3 col-md-6">
                                <label for="inputCategoryType" class="form-label">Category Type</label>
                                <select id="inputCategoryType" name="category_type" class="form-select" required>
                                    <option value="">Select</option>
                                    <option value="Service" {{ old('category_type', isset($category) ? $category->category_type : '') == 'Service' ? 'selected' : '' }}>Service</option>
                                    <option value="Product" {{ old('category_type', isset($category) ? $category->category_type : '') == 'Product' ? 'selected' : '' }}>Product</option>
                                </select>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="category_name" class="form-label">Category Name</label>
                                <input type="text" name="category_name" class="form-control" placeholder="Category Name" value="{{ old('category_name', isset($category) ? $category->category_name : '') }}" required>
                            </div>
                        </div>
                        <div class="row g-2">
                            <div class="mb-3 col-md-6">
                                <label for="sub_category" class="form-label">Sub Category</label>
                                <input type="text" class="form-control" name="sub_category" placeholder="Sub Category" value="{{ old('sub_category', isset($category) ? $category->sub_category : '') }}">
                            </div>
                            <div class="mb-3 pt-4 col-md-3">
                                <div class="form-check">
                                    <label for="status" class="form-check-label">Active</label>
                                    <input type="checkbox" name="status" value="1" class="form-check-input" {{ old('status', isset($category) && $category->status) ? 'checked' : '' }}>
                                </div>
                            </div>
                            <div class="mb-3 pt-4 col-md-3">
                                <div class="form-check">
                                    <label for="is_main" class="form-check-label">Is Main</label>
                                    <input type="hidden" name="is_main" value="0">
                                    <input type="checkbox" name="is_main" class="form-check-input" value="1" {{ old('is_main', isset($category) && $category->is_main) ? 'checked' : '' }}>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary submit-btn">{{ isset($category) ? 'Update' : 'Save' }}</button>
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
                    window.location.href = "{{ route('categories.index') }}"; // Update with your index route
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