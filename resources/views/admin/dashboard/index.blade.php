@extends('admin.layout.appNew')

@section('content')

    <div class="row">
        <div class="col-xxl-3 col-sm-6">
            <a href="{{ route('admin.categories.index') }}" class="dashboard-link">
                <div class="card widget-flat text-bg-pink">
                    <div class="card-body">
                        <div class="float-end">
                            <i class="ri-car-line widget-icon"></i>
                        </div>
                        <h6 class="text-uppercase mt-0" title="Categories">Total Categories</h6>
                        <h2 class="my-2">{{ $total_categories }}</h2>
                        <p class="mb-0">
                            <span class="badge bg-white bg-opacity-10 me-1">Categories</span>
                            <span class="text-nowrap">in the system</span>
                        </p>
                    </div>
                </div>
            </a>
        </div> <!-- end col-->

        <div class="col-xxl-3 col-sm-6">
            <a href="{{ route('users.index') }}" class="dashboard-link">
                <div class="card widget-flat text-bg-purple">
                    <div class="card-body">
                        <div class="float-end">
                            <i class="ri-user-line widget-icon"></i>
                        </div>
                        <h6 class="text-uppercase mt-0" title="Users">Total Users</h6>
                        <h2 class="my-2">{{ $total_users }}</h2>
                        <p class="mb-0">
                            <span class="badge bg-white bg-opacity-10 me-1">Users</span>
                            <span class="text-nowrap">registered</span>
                        </p>
                    </div>
                </div>
            </a>
        </div> <!-- end col-->

        <div class="col-xxl-3 col-sm-6">
            <a href="#" class="dashboard-link">
                <div class="card widget-flat text-bg-info">
                    <div class="card-body">
                        <div class="float-end">
                            <i class="ri-mail-line widget-icon"></i>
                        </div>
                        <h6 class="text-uppercase mt-0" title="Enquiries">Total Enquiries</h6>
                        <h2 class="my-2">{{ $total_enquiries }}</h2>
                        <p class="mb-0">
                            <span class="badge bg-white bg-opacity-25 me-1">Enquiries</span>
                            <span class="text-nowrap">received</span>
                        </p>
                    </div>
                </div>
            </a>
        </div> <!-- end col-->

        <div class="col-xxl-3 col-sm-6">
            <a href="{{ route('admin.dashboard') }}" class="dashboard-link">
                <div class="card widget-flat text-bg-primary">
                    <div class="card-body">
                        <div class="float-end">
                            <i class="ri-settings-line widget-icon"></i>
                        </div>
                        <h6 class="text-uppercase mt-0" title="System">System Status</h6>
                        <h2 class="my-2">Active</h2>
                        <p class="mb-0">
                            <span class="badge bg-white bg-opacity-10 me-1">Status</span>
                            <span class="text-nowrap">All systems operational</span>
                        </p>
                    </div>
                </div>
            </a>
        </div> <!-- end col-->
    </div>

    <!-- end row -->

    <div class="row">
        <div class="col-xl-12">
            <!-- Todo-->
            <div class="card">
                <div class="card-body p-0">
                    <div class="p-3">
                        <div class="card-widgets">
                            <a href="javascript:;" data-bs-toggle="reload"><i class="ri-refresh-line"></i></a>
                            <a data-bs-toggle="collapse" href="#yearly-sales-collapse" role="button"
                                aria-expanded="false" aria-controls="yearly-sales-collapse"><i
                                    class="ri-subtract-line"></i></a>
                            <a href="#" data-bs-toggle="remove"><i class="ri-close-line"></i></a>
                        </div>
    
                        <h4>Latest Enquiries</h4>
                    </div>
    
                    <div id="yearly-sales-collapse" class="collapse show">
                        <div class="card-body y-0">
                            @if($total_enquiries > 0)
                                <p>Here's the last 10 enquiries sent from the website. You can search for an enquiry from the
                                toolbar at the bottom of this widget.</p>
                            @else
                                <p>No enquiries have been received yet.</p>
                            @endif
                        </div>                        
                        <table class="table table-responsive" id="myTable">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Subject</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($total_enquiries > 0)
                                    <!-- Enquiry data would go here -->
                                @else
                                    <tr>
                                        <td colspan="7" class="text-center">No enquiries found</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $('#myTable').DataTable({
            "pageLength": 10,
            "ordering": true,
            "info": true,
            "lengthChange": true,
            "searching": true,
            "responsive": true
        });
    });
</script>

<style>
    /* Simple dashboard link styles */
    .dashboard-link {
        display: block;
        text-decoration: none;
        color: inherit;
        transition: all 0.3s ease;
    }
    
    .dashboard-link:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
    }
    
    /* Ensure the card has proper height */
    .col-xxl-3 {
        min-height: 200px;
    }
</style>
@endsection
