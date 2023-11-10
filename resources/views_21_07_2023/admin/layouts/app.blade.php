<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $getSiteSettings = getSiteSettings(); ?>
	<!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
	<title>{{ $page->title }} - {{ env('APP_NAME') }}</title>
	<link rel="icon" href="../files/assets/images/favicon.ico" type="image/x-icon">
	
	<!-- Styles -->
   
    <!-- Google font-->
	<link rel="icon" href="{{ asset('admin-assets/images/favicon.ico') }}" type="image/x-icon">
    <!-- Google font-->
	<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600" rel="stylesheet">
    <!-- Required Fremwork -->
    <link rel="stylesheet" type="text/css" href="{{ asset('admin-assets/bower_components/bootstrap/css/bootstrap.min.css') }}">
    <!-- themify icon -->
    <link rel="stylesheet" type="text/css" href="{{ asset('admin-assets/icon/themify-icons/themify-icons.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" type="text/css" href="{{ asset('admin-assets/icon/font-awesome/css/font-awesome.min.css') }}">
    <!-- scrollbar.css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('admin-assets/css/jquery.mCustomScrollbar.css') }}">
   
    <!-- Data Table Css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('admin-assets/bower_components/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin-assets/pages/data-table/css/buttons.dataTables.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin-assets/bower_components/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}">
	<link href="{{ asset('admin-assets/bower_components/select2/css/select2.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('admin-assets/bower_components/summernote/summernote.css') }}" rel="stylesheet">
    <!-- Style.css -->
	<link rel="stylesheet" type="text/css" href="{{ asset('plugins/toastr/toastr.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('admin-assets/css/style.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/custom.css') }}">
	
	<link rel="stylesheet" type="text/css" href="{{ asset('admin-assets/plugins/datepicker/datepicker3.css') }}">
    

    
</head>
<body>
<div class="theme-loader">
	<div class="loader-track">
		<div class="loader-bar"></div>
	</div>
</div>
 <div id="pcoded" class="pcoded">
        <div class="pcoded-overlay-box"></div>
        <div class="pcoded-container navbar-wrapper">
            @include('admin.includes.top-navbar')
            
            <div class="pcoded-main-container">
                <div class="pcoded-wrapper">
                     @include('admin.includes.sidebar')
                    <div class="pcoded-content">
                        <div class="pcoded-inner-content">
                            <!-- Main-body start -->
                            <div class="main-body">
                                <div class="page-wrapper">
                                   @yield('content')
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
	
	<div class="modal fade" id="modal-default">
	<div class="modal-dialog modal-lg">
		<div class="modal-content ">
			
		</div>
	</div>
</div>

	<script src="{{ asset('admin-assets/bower_components/jquery/js/jquery.min.js') }}"></script>
	<script src="{{ asset('js/app.js') }}" ></script>	
  
    <script src="{{ asset('admin-assets/bower_components/jquery-ui/js/jquery-ui.min.js') }} "></script>
    <script src="{{ asset('admin-assets/bower_components/popper.js/js/popper.min.js') }}"></script>
    <script src="{{ asset('admin-assets/bower_components/bootstrap/js/bootstrap.min.js') }} "></script>
    
    <script src="{{ asset('admin-assets/bower_components/jquery-slimscroll/js/jquery.slimscroll.js') }} "></script>
    <!-- modernizr js -->
    <script src="{{ asset('admin-assets/bower_components/modernizr/js/modernizr.js') }} "></script>
    <!-- slimscroll js -->
    <script src="{{ asset('admin-assets/js/SmoothScroll.js') }}"></script>
    <script src="{{ asset('admin-assets/js/jquery.mCustomScrollbar.concat.min.js') }} "></script>
   <!-- menu js -->
    <script src="{{ asset('admin-assets/js/pcoded.min.js') }}"></script>
    <script src="{{ asset('admin-assets/js/vertical/vertical-layout.min.js') }} "></script>
	<script src="{{ asset('js/custom.js') }} "></script>
    <script src="{{ asset('plugins/toastr/toastr.min.js') }} "></script>
	
	 <!-- data-table js -->
    <script src="{{ asset('admin-assets/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin-assets/bower_components/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('admin-assets/pages/data-table/js/jszip.min.js') }}"></script>
    <script src="{{ asset('admin-assets/pages/data-table/js/pdfmake.min.js') }}"></script>
    <script src="{{ asset('admin-assets/pages/data-table/js/vfs_fonts.js') }}"></script>
    <script src="{{ asset('admin-assets/bower_components/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('admin-assets/bower_components/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('admin-assets/bower_components/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('admin-assets/bower_components/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('admin-assets/bower_components/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('admin-assets/bower_components/summernote/summernote.js') }}" defer></script>
	<script src="{{ asset('admin-assets/bower_components/select2/js/select2.full.min.js') }}" ></script>
    <script src="{{ asset('admin-assets/js/script.js') }} "></script>
    <script src="{{ asset('js/admin-custom.js') }} "></script>
	
	<script type="text/javascript" src="{{ asset('admin-assets/plugins/datepicker/bootstrap-datepicker.js') }}"></script>
    <link rel="stylesheet" type="text/css" media="all" href="{{ asset('admin-assets/custom-datepicker/daterangepicker.css') }}"/>
    <script type="text/javascript" src="{{ asset('admin-assets/custom-datepicker/moment.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('admin-assets/custom-datepicker/daterangepicker.js') }}"></script>

	
@yield('page-js-script')	
</body>
</html>
