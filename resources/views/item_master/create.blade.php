@extends('admin.layout.appNew')

@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropify/0.2.2/css/dropify.min.css">
<link rel="stylesheet" href="{{ asset('adminTheme/assetsNew/vendor/jquery-toast-plugin/jquery.toast.min.css') }}">
@endsection

@section('content')
    {{-- @include('admin.layouts.shared/page-title', ['sub_title' => 'Category', 'page_title' => isset($category) ? 'Edit Item' : 'Create Item']) --}}

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ isset($item) ? route('items.update', $item) : route('items.store') }}" method="POST" class="ajax-form-new-21">
                        @csrf
                        @if(isset($item))
                            @method('PUT') <!-- This will send a PUT request if the item is being updated -->
                        @endif
                        <div class="row g-2">
                            <div class="mb-3 col-md-6">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" name="name" class="form-control" value="{{ old('name', isset($item) ? $item->name : '') }}" required>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="item_type" class="form-label">Item Type</label>
                                <select name="item_type" class="form-select" required>
                                    <option value="">Select</option>
                                    <option value="Service" {{ old('item_type', isset($item) ? $item->item_type : '') == 'Service' ? 'selected' : '' }}>Service</option>
                                    <option value="Product" {{ old('item_type', isset($item) ? $item->item_type : '') == 'Product' ? 'selected' : '' }}>Product</option>
                                </select>
                            </div>
                        </div>
                        <div class="row g-2">
                            <div class="mb-3 col-md-6">
                                <label for="hsn_sac_code" class="form-label">HSN/SAC Code</label>
                                <input type="text" name="hsn_sac_code" class="form-control" value="{{ old('hsn_sac_code', isset($item) ? $item->hsn_sac_code : '') }}">
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="category_id" class="form-label">Category</label>
                                <select name="category_id" class="form-select" required>
                                    <option value="">Select</option>
                                    @foreach($maincategories as $maincategory)
                                        <option value="{{ $maincategory->id }}" {{ old('category_id', isset($item) ? $item->category_id : '') == $maincategory->id ? 'selected' : '' }}>{{ $maincategory->category_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row g-2">
                            <div class="mb-3 col-md-6">
                                <label for="sub_category_id" class="form-label">Sub Category</label>
                                <select name="sub_category_id" class="form-select" required>
                                    <option value="">Select</option>
                                    @foreach($subcategories as $subcategory)
                                        <option value="{{ $subcategory->id }}" {{ old('sub_category_id', isset($item) ? $item->sub_category_id : '') == $subcategory->id ? 'selected' : '' }}>{{ $subcategory->sub_category }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="mrp" class="form-label">MRP</label>
                                <input type="number" name="mrp" class="form-control" value="{{ old('mrp', isset($item) ? $item->mrp : '') }}" required>
                            </div>
                        </div>
                        <div class="row g-2">
                            <div class="mb-3 col-md-6">
                                <label for="barcode" class="form-label">Barcode</label>
                                <input type="text" name="barcode" class="form-control" value="{{ old('barcode', isset($item) ? $item->barcode : '') }}" required>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="purchase_price" class="form-label">Purchase Price</label>
                                <input type="number" name="purchase_price" class="form-control" value="{{ old('purchase_price', isset($item) ? $item->purchase_price : '') }}" required>
                            </div>
                        </div>
                        <div class="row g-2">
                            <div class="mb-3 col-md-6">
                                <label for="unit_of_measure" class="form-label">Unit of Measure</label>
                                <select name="unit_of_measure" class="form-select" required>
                                    <option value="">Select</option>
                                    <option value="liter" {{ old('unit_of_measure', isset($item) ? $item->unit_of_measure : '') == 'liter' ? 'selected' : '' }}>Liter</option>
                                    <option value="KG" {{ old('unit_of_measure', isset($item) ? $item->unit_of_measure : '') == 'KG' ? 'selected' : '' }}>KG</option>
                                    <option value="meter" {{ old('unit_of_measure', isset($item) ? $item->unit_of_measure : '') == 'meter' ? 'selected' : '' }}>Meter</option>
                                    <option value="piece" {{ old('unit_of_measure', isset($item) ? $item->unit_of_measure : '') == 'piece' ? 'selected' : '' }}>Piece</option>
                                    <option value="dozen" {{ old('unit_of_measure', isset($item) ? $item->unit_of_measure : '') == 'dozen' ? 'selected' : '' }}>Dozen</option>
                                    <option value="gallon" {{ old('unit_of_measure', isset($item) ? $item->unit_of_measure : '') == 'gallon' ? 'selected' : '' }}>Gallon</option>
                                    <option value="pound" {{ old('unit_of_measure', isset($item) ? $item->unit_of_measure : '') == 'pound' ? 'selected' : '' }}>Pound</option>
                                    <option value="ounce" {{ old('unit_of_measure', isset($item) ? $item->unit_of_measure : '') == 'ounce' ? 'selected' : '' }}>Ounce</option>
                                    <option value="cm" {{ old('unit_of_measure', isset($item) ? $item->unit_of_measure : '') == 'cm' ? 'selected' : '' }}>Centimeter</option>
                                    <option value="mm" {{ old('unit_of_measure', isset($item) ? $item->unit_of_measure : '') == 'mm' ? 'selected' : '' }}>Millimeter</option>
                                </select>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="sku" class="form-label">SKU</label>
                                <input type="text" name="sku" class="form-control" value="{{ old('sku', isset($item) ? $item->sku : '') }}">
                            </div>
                        </div>
                        <div class="row g-2">
                            <div class="mb-3 col-md-6">
                                <label for="sales_cost" class="form-label">Sales Cost</label>
                                <input type="number" name="sales_cost" class="form-control" value="{{ old('sales_cost', isset($item) ? $item->sales_cost : '') }}">
                            </div>
                            <div class="mb-3 col-md-6">
                                <input type="checkbox" name="is_tax_included" value="1" {{ old('is_tax_included', isset($item) && $item->is_tax_included) ? 'checked' : '' }}> Tax Included
                            </div>
                        </div>
                        <div class="row g-2">
                            <div class="mb-3 col-md-6">
                                <label for="cgst" class="form-label">CGST Percentage</label>
                                <input type="number" name="cgst" class="form-control" value="{{ old('cgst', isset($item) ? $item->cgst : '') }}">
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="sgst" class="form-label">SGST Percentage</label>
                                <input type="number" name="sgst" class="form-control" value="{{ old('sgst', isset($item) ? $item->sgst : '') }}">
                            </div>
                        </div>
                        <div class="row g-2">
                            <div class="mb-3 col-md-6">
                                <label for="igst" class="form-label">IGST Percentage</label>
                                <input type="number" name="igst" class="form-control" value="{{ old('igst', isset($item) ? $item->igst : '') }}">
                            </div>
                            <div class="mb-3 col-md-6">
                                <input type="checkbox" name="is_available" value="1" {{ old('is_available', isset($item) && $item->is_available) ? 'checked' : '' }}> Is Available
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary submit-btn">{{ isset($item) ? 'Update' : 'Save' }}</button>
                        <a href="{{ route('items.index') }}" class="btn btn-warning">Back</a>
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
                    window.location.href = "{{ route('items.index') }}"; // Update with your index route
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