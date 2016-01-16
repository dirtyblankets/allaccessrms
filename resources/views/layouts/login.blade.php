<!doctype html>
<html>
    <meta http-equiv="cache-control" content="private, max-age=0, no-cache">
    <meta http-equiv="pragma" content="no-cache">
    <meta http-equiv="expires" content="0">

    <link type="text/css" rel="stylesheet" href="{{URL::to('css/app.css')}}">
</head>
<body>
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class='col-md-6 col-md-offset-3'>
                <!--@include('errors.errors')-->
            </div>
            @yield("content")
        </div>
    </div><!-- Page Wrapper -->
<!--container-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script type="text/javascript" src="{{ URL::to("js/bootstrap.js") }}"></script>
</body>
</html>