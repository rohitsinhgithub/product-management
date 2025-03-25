@extends('admin.layout.appNew')
@section('styles')
<style>
.dropify-wrapper .dropify-message span.file-icon {
    font-size: 30px !important;
    color: #CCC;
    line-height: 42px;
}
.dropify-wrapper{
    max-width: 65% !important;
    margin: 20px auto 0 !important;
}
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css"
    integrity="sha512-EZSUkJWTjzDlspOoPSpUFR0o0Xy7jdzW//6qhUkoZ9c4StFkVsp9fbbd0O06p9ELS3H486m4wmrCELjza4JEog=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection
@section('content')
<div class="row">
    <div class="col-xl-8">
        <div class="card">
            <div class="card-header">
                <h4 class="header-title">{{ $page_title }}</h4>
            </div>
            <div class="card-body">
                {!! Form::model($formObj, ['method' => $method,'files' => true,'url' => $action_url,'class' => '','id' => 'module-frm','redirect-url' => $back_url]) !!}

                <div class="mb-3">
                    <label class="form-label">First Name</label>
                    {!! Form::text('first_name', null, ['class' => 'form-control', 'placeholder' => 'Enter First Name']) !!}
                </div>

                <div class="mb-3">
                    <label class="form-label">Last Name</label>
                    {!! Form::text('last_name', null, ['class' => 'form-control', 'placeholder' => 'Enter Last Name']) !!}
                </div>

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'Enter Email']) !!}
                </div>
                <div class="mb-3">
                    <label for="profile_pic">Profile Picture</label>
                    <input type='file' class='dropify' data-max-file-size='2M' data-allowed-file-extensions='jpg jpeg png gif' id='profile_pic' name='profile_pic' data-default-file="{{ $formObj->image ? asset('uploads/profile_pictures/' . $formObj->image) : null }}" >
                </div>
                <hr /><br />

                <div class="mb-3">
                    <button type="submit" class="btn btn-primary" id="submit_btn">Save</button>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4">
        <div class="card">
            <div class="card-header">
                <h4 class="header-title">Info</h4>
            </div>
            @if ($formObj->id > 0)
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label"> Created: &nbsp;&nbsp;&nbsp;
                        {{ formatByDate($formObj->created_at) }}
                    </label>
                </div>
                <div class="mb-3">
                    <label class="form-label"> Last Edit : &nbsp;&nbsp;&nbsp;
                        {{ formatByDate($formObj->updated_at) }}
                    </label>
                </div>
            </div>
            @else
            
            @endif
        </div>   
    </div>
    {!! Form::close() !!}
</div>
@endsection
@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"
integrity="sha512-8QFTrG0oeOiyWo/VM9Y8kgxdlCryqhIxVeRpWSezdRRAvarxVtwLnGroJgnVW9/XBRduxO/z1GblzPrMQoeuew=="
crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src=" {{ asset('adminTheme/assets/modules/moduleForm.js') }}"></script>
<script>
$(document).ready(function () {
    $('.dropify').dropify();
    
    $('.dropify-clear').on('click', function() {
    if ($('#profile_pic').data('default-file')) {
        $.ajax({
            url: '{{ route("profile_pic_remove") }}',
            type: 'POST',
            data: { 
                _token: '{{ csrf_token() }}',
                action: 'remove_image',
            },
            success: function(response) {
                $.toast({
                    text: response['msg'],
                    icon: 'error',
                    position: 'top-right',
                    hideAfter: 3000 
                });
                    location.reload();
            },
            error: function(xhr, status, error) {
                console.error('Error removing image:', error);
            }
        });
    }
});

})
</script>
@endsection