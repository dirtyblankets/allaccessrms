<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="token" id="token" value="{{ csrf_token() }}">

		<title>All Access RMS</title>

		<link type="text/css" rel="stylesheet" href="{{ URL::to('assets/vendor/bootstrap/dist/css/bootstrap.min.css') }}">
        <link type="text/css" rel="stylesheet" href="{{ URL::to('assets/vendor/bootstrap/dist/css/bootstrap.min.css') }}">
        <link type="text/css" rel="stylesheet" href="{{ URL::to('assets/vendor/font-awesome/css/font-awesome.min.css') }}">
        <link type="text/css" rel="stylesheet" href="{{ URL::to('assets/vendor/bootstrap-datetimepicker/bootstrap-datetimepicker-build.css') }}">
        <link type="text/css" rel="stylesheet" href="{{URL::to('css/app.css')}}">
	</head>
	<body id="app">
		<div class="wrapper">
			@include("layouts.header")
			@include("layouts.sidebar")
			@include("layouts.content")
		</div>
    <script src="/assets/vendor/jquery/jquery.min.js"></script>
    <script src="/assets/vendor/moment/min/moment.min.js"></script>
    <script src="/assets/vendor/bootstrap/js/transition.js"></script>
    <script src="/assets/vendor/bootstrap/js/collapse.js"></script>
    <script src="/assets/vendor/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="/assets/vendor/bootstrap-datetimepicker/bootstrap-datetimepicker.js"></script>
	<!--<script src="/js/app.js"></script>-->
	<script type="text/javascript">
		$('#flash-overlay-modal').modal();

        $(function () {
            $(".datepicker").datetimepicker( {
                pickTime: false
            });
        });

		$(function () {
			$(".timepicker").datetimepicker( {
				format: 'LT',
                pickDate: false
			});
		});
	</script>
	</body>
</html>