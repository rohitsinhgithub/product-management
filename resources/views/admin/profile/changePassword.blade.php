@extends('admin.layout.appNew')
@section('content')
<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header">
                <h4 class="header-title">{{ $page_title }}</h4>
            </div>
            <div class="card-body">
                {!! Form::model($formObj, ['method' => $method,'files' => true,'url' => $action_url,'class' => '','id' => 'module-frm','redirect-url' => $back_url]) !!}

                <div class="mb-3">
                    {!! Form::label('password', 'Password', ['class' => 'form-label']) !!}
                    {!! Form::password('password', ['class' => 'form-control', 'id' => 'example-password', 'placeholder' => 'Enter Password']) !!}
                </div>

                <div class="mb-3">
                    {!! Form::label('password_confirmation', 'Confirm Password', ['class' => 'form-label']) !!}
                    {!! Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => 'Enter Confirm Password']) !!}
                </div>

                <hr /><br />

                <div class="mb-3">
                    <button type="submit" class="btn btn-primary" id="submit_btn">Save</button>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
    <div class="col-xl-4">
        <div class="card">
            
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script src=" {{ asset('adminTheme/assets/modules/moduleForm.js') }}"></script>
@endsection