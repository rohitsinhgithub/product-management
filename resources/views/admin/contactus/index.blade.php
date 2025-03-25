@extends('admin.layout.appNew')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <!-- <div class="card-header">
                    <div>
                        <a href="#" class="btn btn-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5">
                                <line x1="12" y1="5" x2="12" y2="19"></line>
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                            </svg>
                            Add New
                        </a>
                    </div>
                </div> -->
                <div class="card-body">
                    <table id="server-side-datatables" class="table table-striped dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Vehicle</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody> </tbody>
                    </table>

                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div><!-- end col-->
    </div> <!-- end row-->

    <!-- view modal content -->
    <div id="viewModel" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="topModalLabel">View Details</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- // Model body append here -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal">Close</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@endsection

@section('scripts')
<script type="text/javascript">
    var MODULE_URL  = "{!! route($moduleRouteText.'.data') !!}";
    var dataColumns = [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'vehicle',
                        name: 'vehicle'
                    },
                    {
                        data: 'first_name',
                        name: 'first_name'
                    },
                    {
                        data: 'email',
                        name: 'Email'
                    },
                    {
                        data: 'phone',
                        name: 'Phone'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    },
                    {
                        data: 'action',
                        orderable: false,
                        searchable: false
                    }
                ];
    $(document).on("click", "#viewModelBtn", function () {          
        $('#AjaxLoaderDiv').fadeIn('slow');
        $.ajax({
            type: "GET",
            url: $(this).attr("href"),
            data: {
                "_token"     : "{{ csrf_token() }}",
            },
            success: function(result) {
                $('#AjaxLoaderDiv').fadeOut('slow');
                if (result.status == 1)
                {
                    $("#viewModel .modal-body").html(result.html);
                    $('#viewModel').modal('show');
                }
                else
                {
                    $.NotificationApp.send("Error!", result.msg, 'top-right', 'rgba(0,0,0,0.2)', 'error');
                }
            }, 
        });
        return false;
    });
</script>
<script src="{{ asset('adminTheme/assets/modules/moduleList.js?123') }}"></script>
@endsection

