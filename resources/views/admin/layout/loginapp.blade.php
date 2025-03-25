<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Stock Management | Admin Panel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully responsive admin theme which can be used to build CRM, CMS,ERP etc." name="description" />
    <meta content="Techzaa" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('adminTheme/assetsNew/images/favicon.ico') }}">
    <!-- Theme Config Js -->
    <script src="{{ asset('adminTheme/assetsNew/js/config.js') }}"></script>
    <!-- App css -->
    <link href="{{ asset('adminTheme/assetsNew/css/app.min.css') }}" rel="stylesheet" type="text/css" id="app-style" />
    <!-- Icons css -->
    <link href="{{ asset('adminTheme/assetsNew/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
</head>

<body class="authentication-bg position-relative">
    @yield('content')
    <!-- end page -->
    <footer class="footer footer-alt fw-medium">
        <span class="text-dark">
            <script>document.write(new Date().getFullYear())</script> © {{env('APP_NAME')}} All rights reserved.
        </span>
    </footer>
    <!-- Vendor js -->
    <script src="{{ asset('adminTheme/assetsNew/js/vendor.min.js') }}" ></script>
    <!-- App js -->
    <script src="{{ asset('adminTheme/assetsNew/js/app.min.js') }}"></script>
    
</body>

</html>