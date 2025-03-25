@extends('admin.layout.app')
@section('content')
@if ($errors->any())
 @foreach ($errors->all() as $error)
		<div class="flex mb-5 items-center rounded bg-danger-light p-3.5 text-danger dark:bg-danger-dark-light">
		    <span class="ltr:pr-2 rtl:pl-2"
		        ><strong class="ltr:mr-1 rtl:ml-1">{{ $error }}</strong></span
		    >
		    <button type="button" class="hover:opacity-80 ltr:ml-auto rtl:mr-auto">
		        <svg
		            xmlns="http://www.w3.org/2000/svg"
		            width="24px"
		            height="24px"
		            viewBox="0 0 24 24"
		            fill="none"
		            stroke="currentColor"
		            stroke-width="1.5"
		            stroke-linecap="round"
		            stroke-linejoin="round"
		            class="h-5 w-5"
		        >
		            <line x1="18" y1="6" x2="6" y2="18"></line>
		            <line x1="6" y1="6" x2="18" y2="18"></line>
		        </svg>
		    </button>
		</div>
		@endforeach
    @endif

    @if(session('success'))
        <div class="flex mb-5 items-center rounded bg-success-light p-3.5 text-success dark:bg-success-dark-light">
	        <span class="ltr:pr-2 rtl:pl-2"
	            ><strong class="ltr:mr-1 rtl:ml-1">Success!</strong>{{ session('success') }}</span
	        >
	        <button type="button" class="hover:opacity-80 ltr:ml-auto rtl:mr-auto">
	            <svg
	                xmlns="http://www.w3.org/2000/svg"
	                width="24px"
	                height="24px"
	                viewBox="0 0 24 24"
	                fill="none"
	                stroke="currentColor"
	                stroke-width="1.5"
	                stroke-linecap="round"
	                stroke-linejoin="round"
	                class="h-5 w-5"
	            >
	                <line x1="18" y1="6" x2="6" y2="18"></line>
	                <line x1="6" y1="6" x2="18" y2="18"></line>
	            </svg>
	        </button>
	    </div>
    @endif

    @if(session('error'))
        <div class="flex mb-5 items-center rounded bg-danger-light p-3.5 text-danger dark:bg-danger-dark-light">
		    <span class="ltr:pr-2 rtl:pl-2"
		        ><strong class="ltr:mr-1 rtl:ml-1"> {{ session('error') }}</strong></span
		    >
		    <button type="button" class="hover:opacity-80 ltr:ml-auto rtl:mr-auto">
		        <svg
		            xmlns="http://www.w3.org/2000/svg"
		            width="24px"
		            height="24px"
		            viewBox="0 0 24 24"
		            fill="none"
		            stroke="currentColor"
		            stroke-width="1.5"
		            stroke-linecap="round"
		            stroke-linejoin="round"
		            class="h-5 w-5"
		        >
		            <line x1="18" y1="6" x2="6" y2="18"></line>
		            <line x1="6" y1="6" x2="18" y2="18"></line>
		        </svg>
		    </button>
		</div>
    @endif
<div class="grid grid-cols-1 gap-6 lg:grid-cols-2" >
<!-- tag -->
<div class="panel">
    <div class="mb-5 flex items-center justify-between">
        <h5 class="text-lg font-semibold dark:text-white-light addtag">Add New Tag</h5>
    </div>
    <div class="mb-5" x-data="{ tab: 'english'}">
    
        <div>
            <ul class="mt-3 mb-5 flex flex-wrap border-b border-white-light dark:border-[#191e3a]">
                <li>
                    <a href="javascript:;" class="-mb-[1px] flex items-center border-transparent p-5 py-3 hover:border-b hover:!border-secondary hover:text-secondary"
                        :class="{'border-b !border-secondary text-secondary' : tab === 'english'}"
                        @click="tab = 'english'">English [en]</a>
                </li>
                <li>
                    <a href="javascript:;" class="-mb-[1px] flex items-center border-transparent p-5 py-3 hover:border-b hover:!border-secondary hover:text-secondary"
                        :class="{'border-b !border-secondary text-secondary' : tab === 'portuguese'}"
                        @click="tab = 'portuguese'">Portuguese [pt]</a>
                </li>
                <li>
                    <a href="javascript:;" class="-mb-[1px] flex items-center border-transparent p-5 py-3 hover:border-b hover:!border-secondary hover:text-secondary"
                        :class="{'border-b !border-secondary text-secondary' : tab === 'french'}"
                        @click="tab = 'french'">French [fr]</a>
                </li>
            </ul>
        </div>
        <div class="flex-1 text-sm">
        <form id="tagForm" class="space-y-5" method="POST" action="{{ route('blog.tag.store') }}">
                @csrf
                <template x-if="tab === 'english'">
                    <div>
                        <label for="tag_title_en">Tag<span class="text-danger">*</span></label>
                        <input id="tag_title_en" name="title_en" x-model="formData.title_en" type="text" placeholder="Enter a Tag [en] " class="form-input" />
                    </div>
                </template>
                <template x-if="tab === 'portuguese'">
                    <div>
                        <label for="tag_title_pt">Tag</label>
                        <input id="tag_title_pt" name="title_pt" x-model="formData.title_pt" type="text" placeholder="Enter a Tag [pt] " class="form-input" />
                    </div>
                </template>
                <template x-if="tab === 'french'">
                    <div>
                        <label for="tag_title_fr">Tag</label>
                        <input id="tag_title_fr" name="title_fr" x-model="formData.title_fr" type="text" placeholder="Enter a Tag [fr] " class="form-input" />
                    </div>
                </template>
                <div>
                    <label for="meta_title">Meta Title</label>
                     <input id="is_edit" name="is_edit"  type="hidden"  />
                     <input id="edit_id" name="edit_id"  type="hidden"  />
                    <input id="meta_title" name="meta_title"  type="text" placeholder="Enter Meta Title " class="form-input" />
                </div>
                <div>
                    <label for="meta_description">Meta Description</label>
                    <textarea id="meta_description" name="meta_description" rows="3" class="form-textarea" placeholder="Enter Meta Description"></textarea>
                </div>
                <div class="mt-8 flex items-center justify-end gap-2">
                    <button type="button" @click="submitForm" class="btn btn-primary">Submit</button>
                    <button type="button" @click="cancelForm" class="btn btn-danger">Cancel</button>
                </div>
    	</form>
        </div>
    </div>
</div>
<!-- tag -->
<!-- tag list -->
<div class="panel">
    <div class="mb-5 flex items-center justify-between">
        <h5 class="text-lg font-semibold dark:text-white-light">Tags</h5>
    </div>
    <div class="table-responsive">
        <table id="tagsTable" class="table table-bordered table-hover dt-responsive">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Post Nº</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
<!-- tag -->
</div>
<script>
   var formData = {
        title_en: '',
        title_pt: '',
        title_fr: '',
        meta_title: '',
        meta_description: ''
    };

    $('#tagsTable').DataTable({
        processing: true,
        serverSide: true, 
        searching: false,
        order: ['1', 'DESC'],
        pageLength: 25,
        ajax: '{{ route("tags.data") }}',
        columns: [
            { data: 'title', name: 'title',orderable: false},
            { data: 'post_n', name: 'post_n',orderable: false},
            { data: 'actions', name: 'actions',orderable: false},
        ]
    });


    function submitForm() {
        // Get form data
        var is_edit = $('#is_edit').val();
        var edit_id = $('#edit_id').val();
        var formData1 = new FormData();
        formData1.append('title_en', formData.title_en);
        formData1.append('title_pt', formData.title_pt);
        formData1.append('title_fr',  formData.title_fr);
        formData1.append('meta_title', $('#meta_title').val());
        formData1.append('meta_description', $('#meta_description').val());

        var url = '{{ route("blog.tag.store") }}';
        if(is_edit){
			url = '{{ route("blog.tag.update", ["id" => ":edit_id"]) }}'.replace(':edit_id', edit_id);
        }
        // Send Ajax request using fetch
       	$('.ajax_loader').removeClass('hidden');
        fetch(url, {
            method: 'POST',
            body: formData1,
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(response => response.json())
        .then(data => {
        	$('.ajax_loader').addClass('hidden');
        	const statusCode = data.status;
		    if (statusCode === 200) {
		        
        	 	showMessage(data.message, 'success');
        	 	// Reload the page when document is ready
        		$('#tagsTable').DataTable().ajax.reload();
            	cancelForm();
            	// Optionally, redirect or show a success message
		    } else {
		        showMessage(data.message, 'error');
		    }
        })
        .catch(error => {
        	$('.ajax_loader').addClass('hidden');
        	showMessage(error.message, 'error');
            // Optionally, show an error message
        });
    }
    function deleteTag(id) {
		if (confirm('Are you sure want to delete selected row ?')) {
            if (id) {
            $('.ajax_loader').removeClass('hidden');
                // Send Ajax request using fetch
		        fetch(`/admin/blog/deleteTag/${id}`, {
		            method: 'DELETE',
		            headers: {
		                'Content-Type': 'application/json',
		                'X-CSRF-TOKEN': '{{ csrf_token() }}'
		                // Add any other headers you might need, such as authentication tokens
		            },
		        })
		        .then(response => response.json())
		        .then(data => {
		        	$('.ajax_loader').addClass('hidden');
		        	const statusCode = data.status;
				    if (statusCode === 200) {
				        
		        	 	showMessage(data.message, 'success');
		            	// Optionally, redirect or show a success message
		            	// Reload the page when document is ready
    					$('#tagsTable').DataTable().ajax.reload();
				    } else {
				        showMessage(data.message, 'error');
				    }
		        })
		        .catch(error => {
		        	$('.ajax_loader').addClass('hidden');
		        	showMessage(error.message, 'error');
		            // Optionally, show an error message
		        });
            }
        }
    }
     function cancelForm() {
     	$('#tag_title_en').val('');
	 	$('#tag_title_pt').val('');
	 	$('#tag_title_fr').val('');
	 	$('#meta_title').val('');
	 	$('#meta_description').val('');
	 	$('#is_edit').val('');
	 	$('#edit_id').val('');
	 	$('.addtag').html("Add New Tag");
	 	formData.title_en = '';
        formData.title_pt = '';
        formData.title_fr = '';
     }
    function editTag(id) {
    	// Add form data from all tabs
        // Get the form element by its ID
            if (id) {
            	$('.ajax_loader').removeClass('hidden');
            	$('#tag_title_en').val('');
			 	$('#tag_title_pt').val('');
			 	$('#tag_title_fr').val('');
			 	$('#meta_title').val('');
			 	$('#meta_description').val('');
			 	formData.title_en = '';
                formData.title_pt = '';
                formData.title_fr = '';

                // Send Ajax request using fetch
		        fetch(`/admin/blog/gettag/${id}`, {
		            method: 'GET',
		            headers: {
		                'Content-Type': 'application/json'
		                // Add any other headers you might need, such as authentication tokens
		            },
		        })
		        .then(response => response.json())
		        .then(data => {
		        	$('.ajax_loader').addClass('hidden');
		        	const statusCode = data.status;
				    if (statusCode === 200) {
				    	formData.title_en = data.data.title_en;
		                formData.title_pt = data.data.title_pt;
		                formData.title_fr = data.data.title_fr;
		        	 	$('#tag_title_en').val(data.data.title_en);
		        	 	$('#tag_title_pt').val(data.data.title_pt);
		        	 	$('#tag_title_fr').val(data.data.title_fr);
		        	 	$('#meta_title').val(data.data.meta_title);
		        	 	$('#meta_description').val(data.data.meta_description);
		        	 	$('#is_edit').val(1);
		        	 	$('#edit_id').val(id);
		        	 	$('.addtag').html("Edit Tag");
		            	// Optionally, redirect or show a success message
				    } else {
				        showMessage(data.message, 'error');
				    }
		        })
		        .catch(error => {
		        	$('.ajax_loader').addClass('hidden');
		        	showMessage(error.message, 'error');
		            // Optionally, show an error message
		        });
            }
    }
    function showMessage(msg = '', type = 'success') {
        const toast = window.Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 30000,
        });
        toast.fire({
        icon: type, // Change icon type as needed ('success', 'error', 'warning', 'info')
        title: msg, // Your success message
        padding: '10px 20px',
        customClass: {
            background: '#4CAF50', // Custom background color for the toast
            color: '#fff', // Custom text color for the toast
            borderRadius: '8px', // Custom border radius
        }
    });
    }
  

</script>
@endsection
