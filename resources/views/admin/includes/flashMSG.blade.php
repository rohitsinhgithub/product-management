@if(Session::has('success_message'))
<div class="row">
	<div class="col-md-12 col-sm-6 col-xs-12">
		<div class="alert alert-primary alert-dismissible text-bg-primary border-0 fade show" role="alert">
		    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
		    <p><i class="icon fa fa-check"></i>
		    	{!! Session::get('success_message')!!}
		    </p>
		</div>
	</div>
</div>
@endif

@if(Session::has('error_message'))
<div class="row">
	<div class="col-md-12 col-sm-6 col-xs-12">
		<div class="alert alert-warning alert-dismissible text-bg-danger border-0 fade show" role="alert">
		    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close" ></button>
		    <p><i class="icon fa fa-check"></i>
		    	{!! Session::get('error_message')!!}
		    </p>
		</div>
	</div>
</div>
@endif

@if(isset($errors) && !empty($errors) && count($errors) > 0)
<div class="row">
	<div class="col-md-12 col-sm-6 col-xs-12">
		<div class="alert alert-danger alert-dismissible text-bg-danger border-0 fade show" role="alert">
		    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
		    @foreach ($errors->all() as $message)
			    <p><i class="icon fa fa-check"></i>
			    	{{ $message }}
			    </p>
			@endforeach
		</div>
	</div>
</div>
@endif