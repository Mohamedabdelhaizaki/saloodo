<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>@lang('Log In | Saloodo')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="The first online auctioneer for heavy equipments in KSA" name="description" />
    <meta content="saloodo" name="author" />
    <meta http-equiv="cache-control" content="private, max-age=0, no-cache">
    <meta http-equiv="pragma" content="no-cache">
    <meta http-equiv="expires" content="0">
    <meta http-equiv="Refresh" content="300">
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('images/favicon.ico') }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('images/favicon.ico') }}">


    <!-- App css -->
    <link href="{{ asset('css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/app.min.css') }}" rel="stylesheet" type="text/css" id="light-style" />
    <link href="{{ asset('css/app-dark.min.css') }}" rel="stylesheet" type="text/css" id="dark-style" />
    <!-- third party css end -->
</head>

<body class="loading authentication-bg"
    data-layout-config='{"leftSideBarTheme":"dark","layoutBoxed":false, "leftSidebarCondensed":false, "leftSidebarScrollable":false,"darkMode":false, "showRightSidebarOnStart": true}'>
    <div class="account-pages mt-5 mb-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-5">
                    <div class="card">

                        <!-- Logo -->
                        <div class="card-header pt-4 pb-4 text-center bg-primary">
                            <span><img src="{{ asset('images/favicon.ico') }}" alt="" height="40"></span>
                        </div>

                        <div class="card-body p-4">

                            <div class="text-center w-75 m-auto">
                                <h4 class="text-dark-50 text-center mt-0 fw-bold">@yield('code')</h4>
                                <p class="text-muted mb-4">
                                    <b>@yield('title')</b>
                                </p>
                            </div>

                            <div class="text-center w-75 m-auto">
                                <p class="text-muted mb-4" style="font-size: medium">
                                    @yield('body')
                                </p>
                            </div>

                            <div class="text-center w-75 m-auto">
                                <div class="form-group d-none d-lg-block mt-2">
                                    <a class="btn btn-danger btn-sm" href="{{ route('home') }}">
                                        <span>{{ __('Back To Home') }}</span>
                                    </a>

                                </div>
                            </div>

                        </div> <!-- end card-body -->
                    </div>

                </div>


                <!-- end card -->

                <!-- end row -->

            </div> <!-- end col -->
        </div>
        <!-- end row -->
    </div>
    <!-- end container -->
    </div>
    <!-- end page -->

    <footer class="footer footer-alt">
        <script>
            document.write(new Date().getFullYear())
        </script> © Saloodo - Saloodo.com
    </footer>

    <!-- bundle -->
    <script src="{{ asset('/js/vendor.min.js') }}"></script>
    <script src="{{ asset('/js/app.min.js') }}"></script>

</body>

</html>
