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
                    <form action="{{ isset($user) ? route('users.update', $user->id) : route('users.store') }}" 
                        method="POST" class="ajax-form-new-21">
                        @csrf
                        @if(isset($user))
                            @method('PUT')
                        @endif
                        <div class="row g-2">
                            <div class="mb-3 col-md-6">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" name="name" class="form-control" placeholder="User Name" value="{{ old('name', isset($user) ? $user->name : '') }}" required>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" placeholder="User Email" value="{{ old('email', isset($user) ? $user->email : '') }}" required>
                            </div>
                        </div>

                        <div class="row g-2">
                            @if(!isset($user))
                                <div class="mb-3 col-md-6">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" name="password" class="form-control" placeholder="Password" value="{{ old('password') }}" @if(!isset($user)) required @endif>
                                </div>
                            @endif
                            <div class="mb-3 col-md-6">
                                <label for="role" class="form-label">Role</label>
                                <select name="role" class="form-control" required>
                                    <option value="">Select Role</option>
                                    @foreach($roles as $role) 
                                        <option value="{{ $role->name }}"
                                            @if(isset($user) && $user->getRoleNames()[0] == $role->name) selected @endif>
                                            {{ $role->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        @if(!isset($user))
                            <div class="row g-2">
                                <div class="mb-3 col-md-6">
                                    <label for="password_confirmation" class="form-label">Confirm Password</label>
                                    <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password" required>
                                </div>
                            </div>
                        @endif

                        <button type="submit" class="btn btn-primary submit-btn">{{ isset($user) ? 'Update' : 'Save' }}</button>
                        <a href="{{ route('users.index') }}" class="btn btn-warning submit-btn">Back</a>
                    </form>
                </div> <!-- end card-body -->
            </div> <!-- end card-->
        </div> <!-- end col -->
    </div>
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
                        window.location.href = "{{ route('users.index') }}"; // Update with your index route
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
