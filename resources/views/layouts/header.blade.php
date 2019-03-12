<meta charset="UTF-8">
<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================-->
<link rel="icon" type="image/png" href="{{ asset('front/img/logo.ico') }}"/>
<!--===============================================-->
<link rel="stylesheet" href="{{ asset('admin/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('front/css/style.css') }}">
<link rel="stylesheet" href="{{ asset('front/css/colors/blue.css') }}">

@yield('css')