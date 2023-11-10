<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin | Log in</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
	<link href="{{ asset('css/app.css') }}" rel="stylesheet">
	 <link rel="icon" href="../files/assets/images/favicon.ico" type="image/x-icon">
    <!-- Google font--><link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600" rel="stylesheet">
    <!-- Required Fremwork -->
    <link rel="stylesheet" type="text/css" href="{{ asset('admin-assets/bower_components/bootstrap/css/bootstrap.min.css') }}">
    <!-- themify-icons line icon -->
    <link rel="stylesheet" type="text/css" href="{{ asset('admin-assets/icon/themify-icons/themify-icons.css') }}">
    <!-- ico font -->
    <link rel="stylesheet" type="text/css" href="{{ asset('admin-assets/icon/icofont/css/icofont.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" type="text/css" href="{{ asset('admin-assets/icon/font-awesome/css/font-awesome.min.css') }}">
    <!-- Style.css -->
	<link rel="stylesheet" type="text/css" href="{{ asset('plugins/toastr/toastr.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin-assets/css/style.css') }}">
</head>
<body class="fix-menu">
<div class="theme-loader">
        <div class="loader-track">
            <div class="loader-bar"></div>
        </div>
    </div>
@yield('content')
<script  src="{{ asset('admin-assets/bower_components/jquery/js/jquery.min.js') }}"></script>
    <script  src="{{ asset('admin-assets/bower_components/jquery-ui/js/jquery-ui.min.js') }}"></script>
    <script  src="{{ asset('admin-assets/bower_components/popper.js/js/popper.min.js') }}"></script>
    <script  src="{{ asset('admin-assets/bower_components/bootstrap/js/bootstrap.min.js') }}"></script>
    <!-- jquery slimscroll js -->
    <script  src="{{ asset('admin-assets/bower_components/jquery-slimscroll/js/jquery.slimscroll.js') }}"></script>
    <!-- modernizr js -->
    <script  src="{{ asset('admin-assets/bower_components/modernizr/js/modernizr.j') }}s"></script>
    <script  src="{{ asset('admin-assets/bower_components/modernizr/js/css-scrollbars.js') }}"></script>
    <!-- i18next.min.js -->
    <script  src="{{ asset('admin-assets/bower_components/i18next/js/i18next.min.js') }}"></script>
    <script  src="{{ asset('admin-assets/bower_components/i18next-xhr-backend/js/i18nextXHRBackend.min.js') }}"></script>
    <script  src="{{ asset('admin-assets/bower_components/i18next-browser-languagedetector/js/i18nextBrowserLanguageDetector.min.js') }}"></script>
    <script  src="{{ asset('admin-assets/bower_components/jquery-i18next/js/jquery-i18next.min.js') }}"></script>
	 <script src="{{ asset('js/custom.js') }} "></script>
	 <script src="{{ asset('plugins/toastr/toastr.min.js') }} "></script>
    <script  src="{{ asset('admin-assets/js/common-pages.js') }}"></script>
@yield('page-js-script')	
</body>
</html>
