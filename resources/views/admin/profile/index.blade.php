@extends('admin.layout.appNew')
@section('styles')
<style>
.dropify-wrapper .dropify-message span.file-icon {
    font-size: 30px !important;
    color: #CCC;
    line-height: 42px;
}
.dropify-wrapper{
    max-width: 100% !important;
    margin: 0 !important;
}
.profile-header {
    background: linear-gradient(135deg, #6B73FF 0%, #000DFF 100%);
    padding: 30px;
    border-radius: 10px 10px 0 0;
    color: white;
    text-align: center;
}
.profile-avatar {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    border: 5px solid rgba(255, 255, 255, 0.3);
    margin: 0 auto 15px;
    overflow: hidden;
}
.profile-avatar img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}
.profile-name {
    font-size: 24px;
    font-weight: 600;
    margin-bottom: 5px;
}
.profile-email {
    font-size: 14px;
    opacity: 0.8;
}
.profile-stats {
    display: flex;
    justify-content: center;
    margin-top: 20px;
}
.profile-stat {
    padding: 0 20px;
    border-right: 1px solid rgba(255, 255, 255, 0.2);
}
.profile-stat:last-child {
    border-right: none;
}
.profile-stat-value {
    font-size: 20px;
    font-weight: 600;
}
.profile-stat-label {
    font-size: 12px;
    opacity: 0.8;
}
.profile-tabs {
    margin-top: 30px;
}
.profile-tab-content {
    padding: 30px;
    background: #fff;
    border-radius: 0 0 10px 10px;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.05);
}
.profile-info-item {
    margin-bottom: 15px;
    padding-bottom: 15px;
    border-bottom: 1px solid #eee;
}
.profile-info-item:last-child {
    border-bottom: none;
}
.profile-info-label {
    font-weight: 600;
    color: #555;
    margin-bottom: 5px;
}
.profile-info-value {
    color: #333;
}
.edit-mode .profile-info-value {
    display: none;
}
.view-mode .profile-form {
    display: none;
}
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css"
    integrity="sha512-EZSUkJWTjzDlspOoPSpUFR0o0Xy7jdzW//6qhUkoZ9c4StFkVsp9fbbd0O06p9ELS3H486m4wmrCELjza4JEog=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body p-0">
                <div class="profile-header">
                    <div class="profile-avatar">
                        <img src="{{ $user->image ? asset('uploads/profile_pictures/' . $user->image) : asset('adminTheme/assetsNew/images/users/avatar-1.jpg') }}" alt="Profile Picture">
                    </div>
                    <h4 class="profile-name">{{ $user->name }}</h4>
                    <p class="profile-email">{{ $user->email }}</p>
                    
                    <div class="profile-stats">
                        <div class="profile-stat">
                            <div class="profile-stat-value">{{ $user->created_at->format('M Y') }}</div>
                            <div class="profile-stat-label">Member Since</div>
                        </div>
                        <div class="profile-stat">
                            <div class="profile-stat-value">{{ $user->last_login_at ? $user->last_login_at->format('d M Y') : 'Never' }}</div>
                            <div class="profile-stat-label">Last Login</div>
                        </div>
                    </div>
                </div>
                
                <div class="profile-tabs">
                    <ul class="nav nav-tabs nav-tabs-custom" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab" href="#profile-info" role="tab">
                                <i class="ri-user-line me-1"></i> Profile Information
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#change-password" role="tab">
                                <i class="ri-lock-line me-1"></i> Change Password
                            </a>
                        </li>
                    </ul>
                    
                    <div class="tab-content profile-tab-content">
                        <div class="tab-pane active" id="profile-info" role="tabpanel">
                            <!-- View Mode -->
                            <div class="view-mode">
                                <div class="d-flex justify-content-end mb-3">
                                    <button type="button" class="btn btn-primary" id="edit-profile-btn">
                                        <i class="ri-edit-line me-1"></i> Edit Profile
                                    </button>
                                </div>
                                
                                <div class="profile-info-item">
                                    <div class="profile-info-label">Full Name</div>
                                    <div class="profile-info-value">{{ $user->name }}</div>
                                </div>
                                
                                <div class="profile-info-item">
                                    <div class="profile-info-label">Email Address</div>
                                    <div class="profile-info-value">{{ $user->email }}</div>
                                </div>
                                
                                <div class="profile-info-item">
                                    <div class="profile-info-label">Profile Picture</div>
                                    <div class="profile-info-value">
                                        <img src="{{ $user->image ? asset('uploads/profile_pictures/' . $user->image) : asset('adminTheme/assetsNew/images/users/avatar-1.jpg') }}" 
                                             alt="Profile Picture" 
                                             class="img-thumbnail" 
                                             style="max-width: 150px;">
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Edit Mode -->
                            <div class="edit-mode" style="display: none;">
                                <form action="{{ route('admin.updateProfile') }}" method="POST" enctype="multipart/form-data" class="profile-form">
                                    @csrf
                                    @method('PUT')
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="name" class="form-label">Full Name</label>
                                                <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" required>
                                                @error('name')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="email" class="form-label">Email Address</label>
                                                <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" required>
                                                @error('email')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="profile_pic" class="form-label">Profile Picture</label>
                                                <input type="file" class="dropify" id="profile_pic" name="profile_pic" data-default-file="{{ $user->image ? asset('uploads/profile_pictures/' . $user->image) : '' }}" data-height="200" />
                                                <small class="text-muted">Upload a new profile picture (Max size: 2MB)</small>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="text-end mt-4">
                                        <button type="button" class="btn btn-secondary me-2" id="cancel-edit-btn">Cancel</button>
                                        <button type="submit" class="btn btn-primary">Update Profile</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        
                        <div class="tab-pane" id="change-password" role="tabpanel">
                            <form action="{{ route('admin.updateProfile') }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="current_password" class="form-label">Current Password</label>
                                            <input type="password" class="form-control" id="current_password" name="current_password">
                                            @error('current_password')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="new_password" class="form-label">New Password</label>
                                            <input type="password" class="form-control" id="new_password" name="new_password">
                                            @error('new_password')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="new_password_confirmation" class="form-label">Confirm New Password</label>
                                            <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation">
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="text-end mt-4">
                                    <button type="submit" class="btn btn-primary">Change Password</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
            url: '{{ route("admin.updateProfile") }}',
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

    // Edit profile toggle
    $('#edit-profile-btn').on('click', function() {
        $('.view-mode').hide();
        $('.edit-mode').show();
    });
    
    $('#cancel-edit-btn').on('click', function() {
        $('.edit-mode').hide();
        $('.view-mode').show();
    });
});
</script>
@endsection