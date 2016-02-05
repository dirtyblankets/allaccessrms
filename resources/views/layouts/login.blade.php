<!doctype html>
<html>
    <meta http-equiv="cache-control" content="private, max-age=0, no-cache">
    <meta http-equiv="pragma" content="no-cache">
    <meta http-equiv="expires" content="0">

    <link type="text/css" rel="stylesheet" href="{{ URL::to('assets/vendor/bootstrap/dist/css/bootstrap.min.css') }}" >
    <link type="text/css" rel="stylesheet" href="{{ URL::to('assets/vendor/font-awesome/css/font-awesome.min.css') }}" >
    <link type="text/css" rel="stylesheet" href="{{URL::to('css/app.css')}}">
</head>
<body>
    <div id="page-wrapper" style="margin-top: 30px;">
        <div class="container-fluid">
            <div class='col-md-6 col-md-offset-3'>
                <!--@include('errors.errors')-->
            </div>
            @yield("content")
        </div>
    </div><!-- Page Wrapper -->
<!--container-->
    <script src="/assets/vendor/jquery/jquery.min.js"></script>
    <script src="/assets/vendor/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="/js/app.js"></script>
</body>
</html>