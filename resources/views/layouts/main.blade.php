<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="token" id="token" value="{{ csrf_token() }}">

		<title>All Access RMS</title>

		<link type="text/css" rel="stylesheet" href="{{URL::to('css/app.css')}}">
		<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
	</head>
	<body id="app">
		<div class="wrapper">
			@include("layouts.header")
			@include("layouts.sidebar")
			@include("layouts.content")
		</div>
	<script src="/js/app.js"></script>
	<script src="/js/laravel-bootstrap-modal-form.js"></script>
	</body>
</html>