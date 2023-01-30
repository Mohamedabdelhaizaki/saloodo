<!DOCTYPE html>
{{-- <html lang="{{ app()->getLocale() }}"> --}}

<head>
    <meta charset="utf-8" />
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />
    <meta content="{{ csrf_token() }}" name="_token" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('images/favicon.ico') }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('images/favicon.ico') }}">

    @yield('hearder-scripts')

    {{-- App css --}}

    <link href="{{ asset('css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/app.min.css') }}" rel="stylesheet" type="text/css" id="light-style" />
    <link href="{{ asset('css/app-dark.css') }}" rel="stylesheet" type="text/css" id="dark-style" />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

</head>

<body class="loading {{ session()->get('sidebarCondensed') == 1 ? '' : 'sidebar-enable' }}"
    data-layout-config='{"leftSideBarTheme":"dark","layoutBoxed":false, "leftSidebarCondensed":{{ session()->get('sidebarCondensed') == 1 ? 'true' : 'false' }}, "leftSidebarScrollable":true,"darkMode":false}'>
    <!-- Begin page -->
    <!-- Pre-loader -->
    <div id="preloader">
        <div id="status">
            <div class="bouncing-loader">
                <div></div>
                <div></div>
                <div></div>
            </div>
        </div>
    </div>
    <!-- End Preloader-->

    <div class="wrapper">

        <!-- ========== Left Sidebar Start ========== -->
        @include('biker.partial.sidebar')
        <!-- Left Sidebar End -->

        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->

        <div class="content-page">
            <div class="content">
                <!-- Topbar Start -->
                @include('biker.partial.header')
                <!-- end Topbar -->

                <!-- Start Content-->
                @yield('content')
                <!-- container -->

            </div> <!-- content -->

            <!-- Footer Start -->
            @include('biker.partial.footer')
            <!-- end Footer -->

        </div>

        <!-- ============================================================== -->
        <!-- End Page content -->
        <!-- ============================================================== -->


    </div>
    <!-- END wrapper -->


    <div class="rightbar-overlay"></div>
    <!-- /Right-bar -->

    <!-- bundle -->
    <script src="{{ asset('js/vendor.min.js') }}"></script>
    <script src="{{ asset('js/app.min.js') }}"></script>

    <div id="sidebar-enable-call" class="d-none"></div>

    @yield('scripts')

    @if (Session::has('alert-message'))
        <script>
            $.NotificationApp.send("{{ Session::get('alert-title', '') }}", "{{ Session::get('alert-message') }}",
                "{{ Session::get('alert-position', 'top-right') }}", "rgba(0,0,0,0.2)",
                "{{ Session::get('alert-type') }}")

            @php
                session()->forget('alert-message');
            @endphp
        </script>
    @endif
</body>

</html>
