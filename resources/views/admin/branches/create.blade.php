@extends('admin.layout.appNew')

@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropify/0.2.2/css/dropify.min.css">
<link rel="stylesheet" href="{{ asset('adminTheme/assetsNew/vendor/jquery-toast-plugin/jquery.toast.min.css') }}">
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form action="{{ isset($branch) ? route('admin.branches.update', $branch->id) : route('admin.branches.store') }}" method="POST" class="ajax-form-new-21">
                    @csrf
                    @if(isset($branch))
                        @method('PUT')
                    @endif
                    <div class="row g-2">
                        <div class="mb-3 col-md-6">
                            <label for="company_id" class="form-label">Company</label>
                            <select name="company_id" class="form-select" required>
                                <option value="">Select Company</option>
                                @foreach($companies as $id => $name)
                                    <option value="{{ $id }}" {{ old('company_id', $branch->company_id ?? '') == $id ? 'selected' : '' }}>{{ $name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label">Branch Name</label>
                            <input type="text" name="branch_name" class="form-control" value="{{ old('branch_name', $branch->branch_name ?? '') }}" required>
                        </div>
                    </div>
                    <div class="row g-2">
                        <div class="mb-3 col-md-6">
                            <label class="form-label">Branch Code</label>
                            <input type="text" name="branch_code" class="form-control" value="{{ old('branch_code', $branch->branch_code ?? '') }}">
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label">Phone</label>
                            <input type="text" name="phone" class="form-control" value="{{ old('phone', $branch->phone ?? '') }}" required>
                        </div>
                    </div>
                    <div class="row g-2">
                        <div class="mb-3 col-md-6">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" value="{{ old('email', $branch->email ?? '') }}" required>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label">Address</label>
                            <textarea name="address" class="form-control" rows="2" required>{{ old('address', $branch->address ?? '') }}</textarea>
                        </div>
                    </div>
                    <div class="row g-2">
                        <div class="mb-3 col-md-4">
                            <label class="form-label">City</label>
                            <input type="text" name="city" class="form-control" value="{{ old('city', $branch->city ?? '') }}" required>
                        </div>
                        <div class="mb-3 col-md-4">
                            <label class="form-label">State</label>
                            <input type="text" name="state" class="form-control" value="{{ old('state', $branch->state ?? '') }}" required>
                        </div>
                        <div class="mb-3 col-md-4 pt-4">
                            <div class="form-check">
                                <input type="checkbox" name="status" value="1" class="form-check-input" {{ old('status', $branch->status ?? true) ? 'checked' : '' }}>
                                <label class="form-check-label">Active</label>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary submit-btn">{{ isset($branch) ? 'Update' : 'Save' }}</button>
                    <a href="{{ route('admin.branches.index') }}" class="btn btn-warning submit-btn">Back</a>
                </form>
                
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
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
                        heading: 'Success',
                        text: response.message,
                        showHideTransition: 'slide',
                        icon: 'success',
                        position: 'top-right'
                    });
                    form[0].reset();
                    setTimeout(() => {
                        window.location.href = "{{ route('admin.branches.index') }}";
                    }, 2000);
                    submitButton.prop("disabled", false);
                },
                error: function (xhr) {
                    submitButton.prop("disabled", false);
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
                }
            });
        });
    });
</script>
@endsection
