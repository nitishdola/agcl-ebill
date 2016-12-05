<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
    <meta name="author" content="Coderthemes">

    <link rel="shortcut icon" href="assets/images/favicon_1.ico">

    <title>AGCL Bill @yield('pageTitle')</title>



    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/core.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/components.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/icons.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/pages.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/menu.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/responsive.css') }}" rel="stylesheet" type="text/css" />

    <!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->

    <script src="{{ asset('assets/js/modernizr.min.js') }}"></script>
    @yield('pageCss')
</head>

<body>
<img src="{{ asset('assets/images/agcl-duliajan-bill.jpg') }}" id="banner_image">
    <div class="col-md-4 col-md-offset-4" style="margin-top:20px;">
        <img src="{{ asset('assets/images/assam-gas-company-logo.jpg') }}" id="logo">
    </div>

    <div class="wrapper">
        
        @yield('content')
        <!-- Footer -->
        @include('layouts.common.footer')
        <!-- End Footer -->
    </div>
    <!-- End wrapper -->



    <!-- jQuery  -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="{{ asset('assets/js/detect.js') }}"></script>
    <script src="{{ asset('assets/js/fastclick.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.70/jquery.blockUI.min.js"></script>
    <script src="{{ asset('assets/js/waves.js') }}"></script>
    <script src="{{ asset('assets/js/wow.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.nicescroll.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.scrollTo.min.js') }}"></script>


 
    <!-- Page js  -->
    <script src="{{ asset('assets/pages/jquery.dashboard.js') }}"></script>

    <!-- Custom main Js -->
    <script src="{{ asset('assets/js/jquery.core.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.app.js') }}"></script>


    <script type="text/javascript">
        
    </script>

    @yield('pageScript')
</body>
</html>