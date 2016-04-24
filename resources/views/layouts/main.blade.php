<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="token" id="token" value="{{ csrf_token() }}">
        <meta name="csrf-token" content="<?= csrf_token() ?>" />
        <meta name="csrf-param" content="_token" />
		<title>All Access RMS</title>

		<link type="text/css" rel="stylesheet" href="{{ URL::to('assets/vendor/bootstrap/dist/css/bootstrap.min.css') }}">
        <link type="text/css" rel="stylesheet" href="{{ URL::to('assets/vendor/font-awesome/css/font-awesome.min.css') }}">
        <link type="text/css" rel="stylesheet" href="{{ URL::to('assets/vendor/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css') }}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/css/bootstrap-select.min.css">
        <link type="text/css" rel="stylesheet" href="{{URL::to('css/app.css')}}">
	</head>
	<body id="app">
		<div class="wrapper">
            @include("layouts.header")
            @include("layouts.sidebar")
            @include("layouts.content")
		</div>
		@include("partials.confirm_delete")
        @include("partials.footer")
        @include("partials.message")
	</body>
</html>