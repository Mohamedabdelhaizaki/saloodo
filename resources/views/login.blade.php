<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>@lang('Log In | Saloodo')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="The first online auctioneer for heavy equipments in KSA" name="description" />
    <meta content="Saloodo" name="author" />
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

                        <!-- LOGO -->
                        <a href="index.html" class="topnav-logo">
                            <span class="topnav-logo-lg">
                                <img src="assets/images/logo-light.png" alt="" height="16">
                            </span>
                            <span class="topnav-logo-sm">
                                <img src="assets/images/logo_sm.png" alt="" height="16">
                            </span>
                        </a>

                        <div class="card-body p-4">

                            <div class="text-center w-75 m-auto">
                                <h4 class="text-dark-50 text-center mt-0 fw-bold">Sign In</h4>
                                <p class="text-muted mb-4">Enter your email address and password to access.
                                </p>
                            </div>

                            <form method="post" action="{{ route('loginForm') }}" id="login-form">
                                @csrf

                                <div class="mb-3">
                                    <label for="emailaddress" class="form-label">Email address</label>
                                    <input class="form-control" type="email" name="email" id="emailaddress"
                                        required="" placeholder="Enter your email">
                                </div>

                                <div class="mb-3">

                                    <label for="password" class="form-label">Password</label>
                                    <div class="input-group input-group-merge">
                                        <input type="password" id="password" name="password" class="form-control"
                                            placeholder="Enter your password">
                                        <div class="input-group-text" data-password="false">
                                            <span class="password-eye"></span>
                                        </div>
                                    </div>
                                </div>


                                <div class="mb-3 mb-0 text-center">
                                    <button class="btn btn-primary" type="submit"> Log In </button>
                                </div>

                            </form>
                        </div> <!-- end card-body -->
                    </div>

                </div><!-- end card -->
            </div> <!-- end col -->
        </div><!-- end row -->
    </div><!-- end body -->

    <footer class="footer footer-alt">
        <script>
            document.write(new Date().getFullYear())
        </script> © Saloodo - Saloodo.com
    </footer>

    <!-- bundle -->
    <script src="{{ asset('/js/vendor.min.js') }}"></script>
    <script src="{{ asset('/js/app.min.js') }}"></script>

    <script>
        @if (Session::has('alert-message'))
            $.NotificationApp.send("{{ Session::get('alert-title', '') }}", "{{ Session::get('alert-message') }}",
                "{{ Session::get('alert-position', 'top-right') }}", "rgba(0,0,0,0.2)",
                "{{ Session::get('alert-type') }}")
        @endif
    </script>
</body>

</html>
