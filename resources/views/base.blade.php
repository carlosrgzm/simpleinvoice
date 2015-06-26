<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>
        @section('title') | SimpleInvoice @show
    </title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    <!-- global css -->

    <!-- App styles -->
    <link rel="stylesheet" href="">
    <!-- Styles -->
    <!-- Bootstrap CSS -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Animate css -->
    <link href="{{ asset('assets/css/animate.min.css') }}" rel="stylesheet">
    <!-- Gritter -->
    <link href="{{ asset('assets/css/jquery.gritter.css') }}" rel="stylesheet">
    <!-- Calendar -->
    <link href="{{ asset('assets/css/fullcalendar.css') }}" rel="stylesheet">
    <!-- Bootstrap toggable -->
    <link href="{{ asset('assets/css/bootstrap-switch.css') }}" rel="stylesheet">
    <!-- Date and Time picker -->
    <link href="{{ asset('assets/css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet">
    <!-- Star rating -->
    <link href="{{ asset('assets/css/rateit.css') }}" rel="stylesheet">
    <!-- Star rating -->
    <link href="{{ asset('assets/css/jquery.cleditor.css') }}" rel="stylesheet">
    <!-- jQuery UI -->
    <link href="{{ asset('assets/css/jquery-ui.css') }}" rel="stylesheet">
    <!-- prettyPhoto -->
    <link href="{{ asset('assets/css/prettyPhoto.css') }}" rel="stylesheet">
    <!-- Font awesome CSS -->
    <link href="{{ asset('assets/css/font-awesome.min.css') }}" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">


    <!-- end of global css -->
    <!--page level css-->
    @yield('header_styles')
    <!--end of page level css-->
</head>
<body>

@yield('content')

<div class="row">
    <div class="col-md-12 text-center">
    </div>
</div>

<!-- Footer starts -->
<footer>
    <div class="container">
        <div class="copy text-center">
            Copyright {{ date("Y",time())}} &copy; SimpleInvoice | {{ $simpleInvoiceVersion or "" }}
        </div>
    </div>
</footer>
<!-- Footer ends -->


<!-- Vendor scripts -->
<script src="{{asset('assets/vendor/jquery/dist/jquery.min.js') }}"></script>


<!-- Javascript files -->
<!-- jQuery -->
<script src="{{ asset('assets/js/jquery.js') }}"></script>
<!-- Bootstrap JS -->
<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
<!-- jQuery UI -->
<script src="{{ asset('assets/js/jquery-ui-1.10.2.custom.min.js"') }}"></script>
<!-- jQuery Peity -->
<script src="{{ asset('assets/js/peity.js') }}"></script>
<!-- Calendar -->
<script src="{{ asset('assets/js/fullcalendar.min.js') }}"></script>
<!-- jQuery Star rating -->
<script src="{{ asset('assets/js/jquery.rateit.min.js"') }}"></script>
<!-- prettyPhoto -->
<script src="{{ asset('assets/js/jquery.prettyPhoto.js') }}"></script>

<!-- jQuery flot -->
<!--[if lte IE 8]>
<script language="javascript" type="text/javascript" src="{{ asset('assets/js/excanvas.min.js') }}"></script>
<![endif]-->
<script src="{{ asset('assets/js/jquery.flot.js') }}"></script>
<script src="{{ asset('assets/js/jquery.flot.pie.js"') }}"></script>
<script src="{{ asset('assets/js/jquery.flot.stack.js"') }}"></script>
<script src="{{ asset('assets/js/jquery.flot.resize.js"') }}"></script>

<!-- Gritter plugin -->
<script src="{{ asset('assets/js/jquery.gritter.min.js"') }}"></script>
<!-- CLEditor -->
<script src="{{ asset('assets/js/jquery.cleditor.min.js"') }}"></script>
<!-- Date and Time picker -->
<script src="{{ asset('assets/js/bootstrap-datetimepicker.min.js"') }}"></script>
<!-- jQuery Toggable -->
<script src="{{ asset('assets/js/bootstrap-switch.min.js"') }}"></script>
<!-- Respond JS for IE8 -->
<script src="{{ asset('assets/js/respond.min.js') }}"></script>
<!-- HTML5 Support for IE -->
<script src="{{ asset('assets/js/html5shiv.js') }}"></script>
<!-- Custom JS -->
<script src="{{ asset('assets/js/custom.js') }}"></script>

<!-- App scripts -->

</body>
</html>