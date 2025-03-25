@extends('layouts.vertical', ['title' => 'Category', 'mode' => $mode ?? '', 'demo' => $demo ?? ''])

@section('content')
@include('layouts.shared/page-title', ['sub_title' => 'Category', 'page_title' => 'Create Category'])
    <h1>Create Category</h1>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('categories.store') }}" method="POST">
                        @csrf
                        <div class="row g-2">
                            <div class="mb-3 col-md-6">
                                <label for="inputCategoryType" class="form-label">Category Type</label>
                                <select id="inputCategoryType" name="category_type" class="form-select" required>
                                    <option value="">Select</option>
                                    <option value="Service">Service</option>
                                    <option value="Product">Product</option>
                                </select>
                            </div>
                            <div class="mb-3 col-md-6">
                                    <label for="category_name" class="form-label">Category Name</label>
                                    <input type="text" name="category_name" class="form-control" placeholder="Category Name" required>
                            </div>
                        </div>
                        <div class="row g-2">
                            <div class="mb-3 col-md-6">
                                    <label for="sub_category" class="form-label">Sub Category</label>
                                    <input type="text" class="form-control" name="sub_category" placeholder="Sub Category">
                            </div>
                            <div class="mb-3 pt-4 col-md-3">
                                <div class="form-check">
                                    <label for="status" class="form-check-label">Active</label>
                                    <input type="checkbox" name="status" value="1" class="form-check-input" checked>
                                </div>
                            </div>
                            <div class="mb-3 pt-4 col-md-3">
                                <div class="form-check">
                                    <label for="is_main" class="form-check-label">Is Main</label>
                                    <!-- Hidden input for is_main -->
                                    <input type="hidden" name="is_main" value="0">
                                    <!-- Checkbox for is_main -->
                                    <input type="checkbox" name="is_main" class="form-check-input" value="1" {{ old('is_main') ? 'checked' : '' }}>
                                    <label for="is_main">Is Main</label>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>

                </div> <!-- end card-body -->
            </div> <!-- end card-->
        </div> <!-- end col -->
    </div>
@endsection