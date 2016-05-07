<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="token" id="token" value="{{ csrf_token() }}">

		<title>All Access RMS</title>

		<link type="text/css" rel="stylesheet" href="{{ URL::to('assets/vendor/bootstrap/dist/css/bootstrap.min.css') }}">
		<link type="text/css" rel="stylesheet" href="{{ URL::to('assets/vendor/font-awesome/css/font-awesome.min.css') }}">	
		<link type="text/css" rel="stylesheet" href="{{ URL::to('assets/vendor/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css') }}">
		<link type="text/css" rel="stylesheet" href="{{ URL::to('assets/vendor/bootstrap-select/dist/css/bootstrap-select.min.css') }}">
		<link type="text/css" rel="stylesheet" href="{{URL::to('css/public/app.css')}}">	

	 <style>

		.alert.parsley {
			margin-top: 5px;
			margin-bottom: 0px;
			padding: 10px 15px 10px 15px;
		}

		.check .alert {
			margin-top: 20px;
		}

		.credit-card-box .panel-title {

			display: inline;

			font-weight: bold;

		}

		.credit-card-box .display-td {

			display: table-cell;

			vertical-align: middle;

			width: 100%;

		}

		.credit-card-box .display-tr {

			display: table-row;

		}

	</style>
	</head>
	<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">
    @include('public.layouts.content')
	<!-- Footer -->
	<footer>
		<div class="container text-center">
			<p>Copyright &copy; All Access RMS 2016</p>
		</div>
	</footer>
	<script src="/assets/vendor/jquery/dist/jquery.min.js"></script>
    <script src="/assets/vendor/maskedinput/jquery.maskedinput.js"></script>
	<script src="/assets/vendor/moment/min/moment.min.js"></script>
	<script src="/assets/vendor/bootstrap/dist/js/bootstrap.min.js"></script>
	<script src="/assets/vendor/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
	<script src="/assets/vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
	<script src="/assets/vendor/signature_pad/signature_pad.min.js"></script>
	<script src="/js/app.js"></script>
	<!-- Google Maps API Key - Use your own API key to enable the map feature. More information on the Google Maps API can be found at https://developers.google.com/maps/ -->
	<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCRngKslUGJTlibkQ3FkfTxj3Xss1UlZDA&sensor=false"></script>
	<!-- Custom Theme JavaScript -->
	<script src="/js/public/app.js"></script>
	<script>
    	$('#flash-overlay-modal').modal();
	</script>
 	<!-- PARSLEY -->

	<script>

	window.ParsleyConfig = {

		errorsWrapper: '<div></div>',

		errorTemplate: '<div class="alert alert-danger parsley" role="alert"></div>',

		errorClass: 'has-error',

		successClass: 'has-success'
	};

	</script>

	<script src="/assets/vendor/parsleyjs/dist/parsley.min.js"></script>
	<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
	<script type="text/javascript" src="/js/public/billing.js"></script>
	</body>
</html>
