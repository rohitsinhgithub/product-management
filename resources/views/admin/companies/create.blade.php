@extends('admin.layout.appNew')

@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropify/0.2.2/css/dropify.min.css">
<link rel="stylesheet" href="{{ asset('adminTheme/assetsNew/vendor/jquery-toast-plugin/jquery.toast.min.css') }}">
@endsection

@section('content')
    {{-- @include('admin.layouts.shared/page-title', ['sub_title' => 'Category', 'page_title' => isset($category) ? 'Edit Category' : 'Create Category']) --}}

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ isset($company) ? route('admin.companies.update', $company->id) : route('admin.companies.store') }}" method="POST" class="ajax-form-new-21">
                        @csrf
                        @if(isset($company))
                            @method('PUT')
                        @endif
                        <div class="row g-2">
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Company Owner</label>
                                <select name="owner_id" class="form-select" required>
                                    <option value="">Select</option>
                                    @foreach($owners as $owner)
                                        <option value="{{ $owner->id }}" {{ old('owner_id', $company->owner_id ?? '') == $owner->id ? 'selected' : '' }}>{{ $owner->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Company Name</label>
                                <input type="text" name="company_name" class="form-control" value="{{ old('company_name', $company->company_name ?? '') }}" required>
                            </div>
                        </div>
                        <div class="row g-2">
                            <div class="mb-3 col-md-6">
                                <label class="form-label">GSTIN</label>
                                <input type="text" name="gstin" class="form-control" value="{{ old('gstin', $company->gstin ?? '') }}">
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Phone</label>
                                <input type="text" name="phone" class="form-control" value="{{ old('phone', $company->phone ?? '') }}" required>
                            </div>
                        </div>
                        <div class="row g-2">
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" value="{{ old('email', $company->email ?? '') }}">
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Pincode</label>
                                <input type="text" name="pincode" class="form-control" value="{{ old('pincode', $company->pincode ?? '') }}" required>
                            </div>
                        </div>
                        <div class="row g-2">
                            <div class="mb-3 col-md-4">
                                <label class="form-label">City</label>
                                <input type="text" name="city" class="form-control" value="{{ old('city', $company->city ?? '') }}" required>
                            </div>
                            <div class="mb-3 col-md-4">
                                <label class="form-label">State</label>
                                <input type="text" name="state" class="form-control" value="{{ old('state', $company->state ?? '') }}" required>
                            </div>
                            <div class="mb-3 col-md-4 pt-4">
                                <div class="form-check">
                                    <label class="form-check-label">Active</label>
                                    <input type="checkbox" name="status" value="1" class="form-check-input" {{ old('status', $company->status ?? true) ? 'checked' : '' }}>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Address</label>
                            <textarea name="address" class="form-control" required>{{ old('address', $company->address ?? '') }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary submit-btn">{{ isset($company) ? 'Update' : 'Save' }}</button>
                        <a href="{{ route('admin.companies.index') }}">Back</a>
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
                    window.location.href = "{{ route('admin.companies.index') }}"; // Update with your index route
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