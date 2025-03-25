@extends('admin.layout.appNew')

@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropify/0.2.2/css/dropify.min.css">
@endsection

@section('content')

<div class="row">
    <div class="col-xl-9">
        <div class="card">
            <div>
                <form method="{{ $method }}" action="{{ route($action_url, $action_params) }}" enctype="multipart/form-data" id="module-frm" redirect-url="{{ route($back_url) }}">
                    @csrf
                    
                    <div>
                        <label for="service_name">Service Name</label>
                        <input type="text" name="service_name" id="service_name" value="{{ old('service_name', $formObj->service_name ?? '') }}" required>
                    </div>

                    <div>
                        <label for="description">Description</label>
                        <textarea name="description" id="description">{{ old('description', $formObj->description ?? '') }}</textarea>
                    </div>
                    
                    <div>
                        <label for="image">Image</label>
                        <input type="file" name="image" id="image" class="dropify dropzone" required>
                    </div>
                    
                    <div>
                        <button type="submit">{{ $buttonText }}</button>
                    </div>
                    
                    <div>
                        <a href="{{ route($back_url) }}">Back</a>
                    </div>
                </form>                
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
    <!-- Dropzone File Upload js -->
    <script src="{{ asset('adminTheme/assetsNew/vendor/dropzone/min/dropzone.min.js') }} "></script>
    <script src=" {{ asset('adminTheme/assets/modules/moduleForm.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropify/0.2.2/js/dropify.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.dropify').dropify();
        });
    </script>
@endsection