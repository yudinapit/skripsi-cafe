<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} | @yield('title')</title>

	<!-- Favicons-->
	<link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
	<link rel="apple-touch-icon" type="image/x-icon" href="img/apple-touch-icon-57x57-precomposed.png">
	<link rel="apple-touch-icon" type="image/x-icon" sizes="72x72" href="img/apple-touch-icon-72x72-precomposed.png">
	<link rel="apple-touch-icon" type="image/x-icon" sizes="114x114"
		href="img/apple-touch-icon-114x114-precomposed.png">
	<link rel="apple-touch-icon" type="image/x-icon" sizes="144x144"
		href="img/apple-touch-icon-144x144-precomposed.png">

	<!-- GOOGLE WEB FONT -->
	<link rel="preconnect" href="https://fonts.googleapis.com/">
	<link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
	<link
		href="https://fonts.googleapis.com/css2?family=Lora:ital@1&amp;family=Poppins:wght@400;500;600;700&amp;display=swap"
		rel="stylesheet">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"
		integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous" />

	<!-- BASE CSS -->
	<link href="{{ asset('assets/frontend/css/vendors.min.css') }}" rel="stylesheet">
	<link href="{{ asset('assets/frontend/css/style.css') }}" rel="stylesheet">

	<!-- SPECIFIC CSS -->
	<link href="{{ asset('assets/frontend/css/wizard.css') }}" rel="stylesheet">
	<link href="{{ asset('assets/frontend/css/blog.css') }}" rel="stylesheet">
	<link href="{{ asset('assets/frontend/css/shop.css') }}" rel="stylesheet">

	<!-- YOUR CUSTOM CSS -->
	{{-- <link href="{{ asset('assets/frontend/css/custom.css') }}" rel="stylesheet"> --}}

    <style>
        #app {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            background: black;
        }

        #app .page {
            width: 100%;
            max-width: 600px;
            min-height: 100vh;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.48);
        }
    </style>

    @stack('css')
</head>

<body>

	{{-- <div id="preloader">
		<div data-loader="circle-side"></div>
	</div> --}}

    <div id="app">
        <div class="page">
            @yield('content')
        </div>
    </div>


    <!-- COMMON SCRIPTS -->
	<script src="{{ asset('assets/frontend/js/common_scripts.min.js') }}"></script>
	<script src="{{ asset('assets/frontend/js/slider.js') }}"></script>
	<script src="{{ asset('assets/frontend/js/common_func.js') }}"></script>
	<script src="{{ asset('assets/frontend/phpmailer/validate.js') }}"></script>

	<!-- SPECIFIC SCRIPTS (wizard form) -->
	<script src="{{ asset('assets/frontend/js/wizard/wizard_scripts.min.js') }}"></script>
	<script src="{{ asset('assets/frontend/js/wizard/wizard_func.js') }}"></script>
    @stack('js')
</body>

</html>
