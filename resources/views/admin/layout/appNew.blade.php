<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>{{env("APP_NAME")}} {{ (isset($page_title))?' | '.$page_title:'' }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully responsive admin theme which can be used to build CRM, CMS,ERP etc." name="description" />
    <meta content="Techzaa" name="author" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('adminTheme/assetsNew/images/favicon.ico') }}">

    <!-- Daterangepicker css -->
    <link rel="stylesheet" href="{{ asset('adminTheme/assetsNew/vendor/daterangepicker/daterangepicker.css') }}">

    <link rel="stylesheet" href="{{ asset('adminTheme/assetsNew/vendor/jquery-toast-plugin/jquery.toast.min.css') }}">

    <!-- Datatables css -->
    <link href="{{ asset('adminTheme/assetsNew/vendor/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('adminTheme/assetsNew/vendor/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('adminTheme/assetsNew/vendor/datatables.net-fixedcolumns-bs5/css/fixedColumns.bootstrap5.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('adminTheme/assetsNew/vendor/datatables.net-fixedheader-bs5/css/fixedHeader.bootstrap5.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('adminTheme/assetsNew/vendor/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('adminTheme/assetsNew/vendor/datatables.net-select-bs5/css/select.bootstrap5.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- Theme Config Js -->
    <script src="{{ asset('adminTheme/assetsNew/js/config.js') }}"></script>

    <!-- App css -->
    <link href="{{ asset('adminTheme/assetsNew/css/app.min.css') }}" rel="stylesheet" type="text/css" id="app-style" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropify/0.2.2/css/dropify.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropify/0.2.2/css/dropify.min.css">
    <!-- Font Awesome CDN for icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <!-- Icons css -->
    <link href="{{ asset('adminTheme/assetsNew/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('adminTheme/assetsNew/vendor/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
    @yield('styles')

</head>

<body>
    <!-- Begin page -->
    <div class="wrapper">

        @include('admin.includes.header')

        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->
        @include('admin.includes.sidebar')


        <div class="content-page">
            <div class="content">
                <div class="container-fluid">
                    @include('admin.includes.breadcrumb')

                    <!-- FLASH MESSAGE -->
                    @include('admin.includes.flashMSG')

                    @yield('content')
                </div>
            </div>
        </div>
        <!-- content -->

        @include('admin.includes.footer')

    </div>

    <!-- ============================================================== -->
    <!-- End Page content -->
    <!-- ============================================================== -->

    </div>
    <!-- END wrapper -->

    <!-- Vendor js -->
    <script src="{{ asset('adminTheme/assetsNew/js/vendor.min.js') }}"></script>

    <!-- Datatables js -->
    <script src="{{ asset('adminTheme/assetsNew/vendor/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('adminTheme/assetsNew/vendor/datatables.net-bs5/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('adminTheme/assetsNew/vendor/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('adminTheme/assetsNew/vendor/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('adminTheme/assetsNew/vendor/datatables.net-fixedcolumns-bs5/js/fixedColumns.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('adminTheme/assetsNew/vendor/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js') }}"></script>
    <script src="{{ asset('adminTheme/assetsNew/vendor/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('adminTheme/assetsNew/vendor/datatables.net-buttons-bs5/js/buttons.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('adminTheme/assetsNew/vendor/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('adminTheme/assetsNew/vendor/datatables.net-buttons/js/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('adminTheme/assetsNew/vendor/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('adminTheme/assetsNew/vendor/datatables.net-keytable/js/dataTables.keyTable.min.js') }}"></script>
    <script src="{{ asset('adminTheme/assetsNew/vendor/datatables.net-select/js/dataTables.select.min.js') }}"></script>
    <script src=" {{ asset('adminTheme/assetsNew/vendor/select2/js/select2.min.js') }}"></script>

    <!-- Toast js -->
    <script src="{{ asset('adminTheme/assetsNew/vendor/jquery-toast-plugin/jquery.toast.min.js') }}"></script>
    <script src="{{ asset('adminTheme/assetsNew/js/pages/toastr.init.js') }}"></script>

    <script src="{{ asset('adminTheme/assetsNew/js/app.min.js') }}"></script>

    @yield('scripts')
</body>

</html>