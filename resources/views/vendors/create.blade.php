@extends('admin.layout.appNew')

@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropify/0.2.2/css/dropify.min.css">
<link rel="stylesheet" href="{{ asset('adminTheme/assetsNew/vendor/jquery-toast-plugin/jquery.toast.min.css') }}">
@endsection

@section('content')
    {{-- @include('admin.layouts.shared/page-title', ['sub_title' => 'Category', 'page_title' => isset($category) ? 'Edit Item' : 'Create Item']) --}}

    <div class="row">
        <h4>{{ isset($vendor) ? 'Edit' : 'Add' }} Vendor</h4>
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ isset($vendor) ? route('vendors.update', $vendor->id) : route('vendors.store') }}" method="POST" class="form-vendor">
                        @csrf
                        @if(isset($vendor))
                            @method('PUT')
                        @endif
            
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label>Company Name <span class="text-danger">*</span></label>
                                <input type="text" name="company_name" class="form-control" value="{{ old('company_name', $vendor->company_name ?? '') }}" required>
                            </div>
            
                            <div class="col-md-6">
                                <label>Contact Person</label>
                                <input type="text" name="contact_person" class="form-control" value="{{ old('contact_person', $vendor->contact_person ?? '') }}">
                            </div>
                        </div>
            
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label>Phone Number <span class="text-danger">*</span></label>
                                <input type="text" name="phone_number" class="form-control" value="{{ old('phone_number', $vendor->phone_number ?? '') }}" required>
                            </div>
            
                            <div class="col-md-6">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control" value="{{ old('email', $vendor->email ?? '') }}">
                            </div>
                        </div>
            
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label>State <span class="text-danger">*</span></label>
                                <input type="text" name="state" class="form-control" value="{{ old('state', $vendor->state ?? '') }}" required>
                            </div>
            
                            <div class="col-md-6">
                                <label>City</label>
                                <input type="text" name="city" class="form-control" value="{{ old('city', $vendor->city ?? '') }}">
                            </div>
                        </div>
            
                        <div class="mb-3">
                            <label>Address</label>
                            <textarea name="address" class="form-control">{{ old('address', $vendor->address ?? '') }}</textarea>
                        </div>
            
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label>GSTIN</label>
                                <input type="text" name="gstin" class="form-control" value="{{ old('gstin', $vendor->gstin ?? '') }}">
                            </div>
                            <div class="col-md-6">
                                <label>PAN Card No</label>
                                <input type="text" name="pan_card_no" class="form-control" value="{{ old('pan_card_no', $vendor->pan_card_no ?? '') }}">
                            </div>
                        </div>
            
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label>Aadhar Card No</label>
                                <input type="text" name="aadhar_card_no" class="form-control" value="{{ old('aadhar_card_no', $vendor->aadhar_card_no ?? '') }}">
                            </div>
                            <div class="col-md-6">
                                <label>CIN</label>
                                <input type="text" name="cin" class="form-control" value="{{ old('cin', $vendor->cin ?? '') }}">
                            </div>
                        </div>
            
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label>TAN</label>
                                <input type="text" name="tan" class="form-control" value="{{ old('tan', $vendor->tan ?? '') }}">
                            </div>
                            <div class="col-md-6">
                                <label>TIN</label>
                                <input type="text" name="tin" class="form-control" value="{{ old('tin', $vendor->tin ?? '') }}">
                            </div>
                        </div>
                        <div class="mb-3 pt-4 col-md-3">
                            <div class="form-check">
                                <label for="status" class="form-check-label">Active</label>
                                <input type="checkbox" name="status" value="1" class="form-check-input"
                                    {{ old('status', isset($vendor) ? $vendor->status : 1) ? 'checked' : '' }}>
                            </div>
                        </div>                        
            
                        <div class="text-end">
                            <button type="submit" class="btn btn-success">
                                {{ isset($vendor) ? 'Update' : 'Submit' }}
                            </button>
                            <a href="{{ route('vendors.index') }}" class="btn btn-secondary">Back</a>
                        </div>
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
            $(".form-vendor").on("submit", function (e) {
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
                    window.location.href = "{{ route('vendors.index') }}"; // Update with your index route
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