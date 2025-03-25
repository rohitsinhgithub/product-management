@extends('admin.layout.appNew')

@section('content')

    <div class="row">
        <div class="col-xxl-3 col-sm-6">
            <div class="card widget-flat text-bg-pink">
                <div class="card-body">
                    <div class="float-end">
                       
                    </div>
                    <h6 class="text-uppercase mt-0" title="Customers">Total Vehicles</h6>
                    <h2 class="my-2"></h2>
                    <p class="mb-0">
                        <span class="badge bg-white bg-opacity-10 me-1"></span>
                        <span class="text-nowrap"></span>
                    </p>
                </div>
            </div>
        </div> <!-- end col-->

        <div class="col-xxl-3 col-sm-6">
            <div class="card widget-flat text-bg-purple">
                <div class="card-body">
                    <div class="float-end">
                       
                    </div>
                    <h6 class="text-uppercase mt-0" title="Customers">Manufacturers</h6>
                    <h2 class="my-2"></h2>
                    <p class="mb-0">
                        <span class="badge bg-white bg-opacity-10 me-1"></span>
                        <span class="text-nowrap"></span>
                    </p>
                </div>
            </div>
        </div> <!-- end col-->

        <div class="col-xxl-3 col-sm-6">
            <div class="card widget-flat text-bg-info">
                <div class="card-body">
                    <div class="float-end">
                       
                    </div>
                    <h6 class="text-uppercase mt-0" title="Customers">Total Enquiries</h6>
                    <h2 class="my-2"></h2>
                    <p class="mb-0">
                        <span class="badge bg-white bg-opacity-25 me-1"></span>
                        <span class="text-nowrap"></span>
                    </p>
                </div>
            </div>
        </div> <!-- end col-->

        {{-- <div class="col-xxl-3 col-sm-6">
            <div class="card widget-flat text-bg-primary">
                <div class="card-body">
                    <div class="float-end">
                       
                    </div>
                    <h6 class="text-uppercase mt-0" title="Customers">Users</h6>
                    <h2 class="my-2">12</h2>
                    <p class="mb-0">
                        <span class="badge bg-white bg-opacity-10 me-1"></span>
                        <span class="text-nowrap"></span>
                    </p>
                </div>
            </div>
        </div> <!-- end col--> --}}
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
                                  <div class="card-body y-0 ">
    
                                    <h4>  Here's the last 10 enquiries sent from the website. You can search for an enquiry from the
                                            toolbar at the bottom of this widget.</h4>                                          
                                </div>                        
                                <table class="table table-responsive" id="myTable">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Vehicle</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                                <div class="card">
                                    <button type="button" class="btn btn-succsess"> <a
                                    href=""> View all Enquiries </a> 
                                </button>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
    
                </div> <!-- end card-->
            </div>
        </div>
    @endsection
    @section('scripts')
    <script defer src="{{ asset('adminTheme/assets/js/sweetalert.min.js') }}"></script> <script defer src="{{ asset('adminTheme/assets/js/alpine.min.js') }}"></script>
        
    <script src="{{ asset('adminTheme/assets/js/file-upload-with-preview.iife.js') }}"></script>

@endsection
