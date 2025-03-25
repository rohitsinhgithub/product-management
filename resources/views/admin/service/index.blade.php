@extends('admin.layout.appNew')
@section('styles')
<style type="text/css">
	.searchvehicle, .searchvehiclestatus{
        display: inline-block;
        font-weight: 400;
        text-align: center;
        white-space: nowrap;
        vertical-align: middle;
        user-select: none;
        border: 1px solid transparent;
        padding: 0.375rem 0.75rem;
        font-size: 1rem;
        line-height: 1.5;
        border-radius: 25px;
        transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
	}
    .live{
        background-color: #dcdcdc;
        color: #99ca00;
    }
    .offline{
        background-color: #dcdcdc;
        color: #bd2d45;
    }
    .comingsoon{
        background-color: #08c;
        color: #ffffff;
    }
    .forsale{
        background-color: #99ca00;
        color: #ffffff;
    }
    .reserved{
        background-color: #ffaf00;
        color: #ffffff;
    }
    .sold{
        background-color: #BD2D45;
        color: #ffffff;
    }
    .reset{
        background-color: #dcdcdc;
        color: #bcbcbc;
    }
    .flex-row{
        display:flex;
    }
    .ml-5{
        margin-left: 5px;
    }
    .searchable{
        display:flex;
        width: 100%;
        justify-content: space-between;
    }
    .border-right-space {
        padding-right: 5px;
        border-right: 1px solid #000;
    }
</style>
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="searchable">
                        <a href="{{$add_url}}" class="btn btn-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5">
                                <line x1="12" y1="5" x2="12" y2="19"></line>
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                            </svg>
                            Add New
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <table id="server-side-datatables" class="table table-striped dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Image</th>
                                <th>Service Name</th>
                                <th>Description</th>
                            </tr>
                        </thead>
                        <tbody> </tbody>
                    </table>

                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div><!-- end col-->
    </div> <!-- end row-->
@endsection

@section('scripts')
<script type="text/javascript">
    // var dataColumns = [{
    //         data: 'id',
    //         name: 'id'
    //     },
    //     {
    //         data: 'name',
    //         name: 'name'
    //     },
    //     {
    //         data: 'created_date',
    //         name: 'created_date'
    //     },
    //     {
    //         data: 'price',
    //         name: 'price'
    //     },
    //     {
    //         data: 'view_cnt',
    //         name: 'view_cnt'
    //     },
    //     {
    //         data: 'enq_cnt',
    //         name: 'enq_cnt'
    //     },
    //     {
    //         data: 'updated_date',
    //         name: 'vehicles.updated_date'
    //     },
    //     {
    //         data: 'status',
    //         name: 'vehicles.status'
    //     },
    //     {
    //         data: 'action',
    //         orderable: false,
    //         searchable: false
    //     }
    // ];
</script>
<script src="{{ asset('adminTheme/assets/modules/vehicleList.js?123') }}"></script>
@endsection