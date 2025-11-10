<!DOCTYPE html>
<html lang="en">
<!-- data-bs-theme="light" data-layout-mode="fluid" data-menu-color="dark" data-topbar-color="light" data-layout-position="fixed" data-sidenav-size="default" class="menuitem-active" -->

<head>
    <meta charset="utf-8" />
    <title> {{ config('app.name') }} </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully responsive admin theme which can be used to build CRM, CMS,ERP etc." name="description" />
    <meta content="Techzaa" name="author" />

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('backend/images/favicon.ico') }}">

    <!-- jQuery -->
    <!-- <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script> -->

    <!-- Select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <!-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> -->


    <!-- Theme Config Js -->
    <script src="{{ asset('backend/js/config.js') }}"></script>

    <!-- App css -->
    <link href="{{ asset('backend/css/app.min.css') }}" rel="stylesheet" type="text/css" id="app-style" />

    <!-- Icons css -->
    <link href="{{ asset('backend/css/icons.min.css') }}" rel="stylesheet" type="text/css" />



    @vite([
        'resources/css/app.css',
    ])

    @yield('styles')
</head>

<body>
    <!-- Begin page -->
    <div class="wrapper">


        <!-- ========== Topbar Start ========== -->
        @include('backend.includes.topbar')
        <!-- ========== Topbar End ========== -->


        <!-- ========== Left Sidebar Start ========== -->
        @include('backend.includes.sidebar')
        <!-- ========== Left Sidebar End ========== -->

        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->

        <div class="content-page">
            <div class="content">

                <!-- Start Content-->
                <div class="container-fluid">

                    <!-- start page title -->
                    @yield('content')
                    <!-- end page title -->

                </div> <!-- container -->

            </div> <!-- content -->

            <!-- Footer Start -->
            @include('backend.includes.footer')
            <!-- end Footer -->

        </div>

        <!-- ============================================================== -->
        <!-- End Page content -->
        <!-- ============================================================== -->

    </div>
    <!-- END wrapper -->

    @include('backend.includes.right-sidebar')

    <x-backend.confirmation-popup />


    <!-- Vendor js -->
    <script src="{{ asset('backend/js/vendor.min.js') }}"></script>
        
    <!-- App js -->
    <script src="{{ asset('backend/js/app.min.js') }}"></script>
    <script src="{{ asset('vendor/jsvalidation/js/jsvalidation.js') }}"></script>
    @vite([
        'resources/js/app.js',
    ])  

    <!-- <script src="{{ asset('vendor/jsvalidation/js/jsvalidation.js') }}"></script> -->
    @yield('scripts')
</body>

</html>