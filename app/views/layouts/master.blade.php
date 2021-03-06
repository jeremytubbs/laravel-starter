<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		@section('meta')
			<title>{{ $_ENV['SITE_NAME'] }}</title>
			<meta name="description" content="Laravel Starter">
		@show
		@yield('styles')
		{{ HTML::style('vendor/bootstrap.min.css') }}
		{{ HTML::style('styles/main.min.css') }}
	</head>
	@section('bodyTag')
	<body>
	@show
		@section('header')
		   @include('layouts.partials._header')
		@show

		<div class="container-fluid">
		@yield('breadcrumb')
		@include('layouts.partials._notifications')
		</div>


		@yield('content')

		@section('footer')
		   @include('layouts.partials._footer')
		@show

		{{-- scripts --}}
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		<!-- <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script> -->
		@yield('scripts')
		{{ HTML::script('vendor/bootstrap.min.js') }}
		{{ HTML::script('vendor/angular/angular.min.js') }}
		{{ HTML::script('vendor/angular/angular-animate.min.js') }}
		{{ HTML::script('app/app.js') }}
		@yield('ngscripts')
		<!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
		<script>
			(function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
			function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
			e=o.createElement(i);r=o.getElementsByTagName(i)[0];
			e.src='//www.google-analytics.com/analytics.js';
			r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
			ga('create','{{ $_ENV['GOOGLE_ANALYTICS'] }}','auto');ga('send','pageview');
		</script>
	</body>
</html>