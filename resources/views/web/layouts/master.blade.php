<?php
// $link=explode('/',$_SERVER['PHP_SELF']);
// print_r($link);
// $_SERVER['PHP_SELF'];
// print $_SERVER["REQUEST_URI"];
// $page=(isset($link[3]))?$link[3]:'index';

$link=explode('/',$_SERVER['REQUEST_URI']);
$page=$link[count($link)-1];
// echo "$page";
$page=($page=='admin')?'index':$page;
// echo $_SERVER['REQUEST_URI'];
?>
<!doctype html>
<html class="fixed" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<head>

		<!-- Basic -->
		<meta charset="UTF-8">

		<title>{{ config('app.name', 'Laravel') }}</title>
		<!-- CSRF Token -->
	    <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="keywords" content="HTML5 Admin Template" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

		<meta name="description" content="Porto Admin - Responsive HTML5 Template">
		<meta name="author" content="okler.net">
		<meta name="author" content="JSOFT.net">

		<!-- Mobile Metas -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

		<!-- Web Fonts  -->
		<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">

		<!-- Vendor CSS -->
		<link rel="stylesheet" href="{{ asset('contents/vendor/bootstrap/css/bootstrap.css') }}" />
		<link rel="stylesheet" href="{{ asset('contents/vendor/font-awesome/css/font-awesome.css') }}" />
		<link rel="stylesheet" href="{{ asset('contents/vendor/magnific-popup/magnific-popup.css') }}" />
		<link rel="stylesheet" href="{{ asset('contents/vendor/bootstrap-datepicker/css/datepicker3.css') }}" />

        <link rel="stylesheet" href="{{ asset('contents/vendor/jquery-ui/css/ui-lightness/jquery-ui-1.10.4.custom.css') }}" />
		<link rel="stylesheet" href="{{ asset('contents/vendor/select2/select2.css') }}" />
		<link rel="stylesheet" href="{{ asset('contents/vendor/bootstrap-multiselect/bootstrap-multiselect.css') }}" />
		<link rel="stylesheet" href="{{ asset('contents/vendor/bootstrap-tagsinput/bootstrap-tagsinput.css') }}" />
		<link rel="stylesheet" href="{{ asset('contents/vendor/bootstrap-colorpicker/css/bootstrap-colorpicker.css') }}" />
		<link rel="stylesheet" href="{{ asset('contents/vendor/bootstrap-timepicker/css/bootstrap-timepicker.css') }}" />
		{{-- <link rel="stylesheet" href="{{ asset('contents/vendor/dropzone/css/basic.css') }}" /> --}}
		{{-- <link rel="stylesheet" href="{{ asset('contents/vendor/dropzone/css/dropzone.css') }}" /> --}}
		<link rel="stylesheet" href="{{ asset('contents/vendor/bootstrap-markdown/css/bootstrap-markdown.min.css') }}" />
		<link rel="stylesheet" href="{{ asset('contents/vendor/summernote/summernote.css') }}" />
		<link rel="stylesheet" href="{{ asset('contents/vendor/summernote/summernote-bs3.css') }}" />
		<link rel="stylesheet" href="{{ asset('contents/vendor/codemirror/lib/codemirror.css') }}" />
		<link rel="stylesheet" href="{{ asset('contents/vendor/codemirror/theme/monokai.css') }}" />
        <link rel="stylesheet" href="{{ asset('contents/vendor/jquery-datatables-bs3/assets/css/datatables.css') }}" />
        
        <!--Form Validation css-->
        <link rel="stylesheet" href="{{ asset('contents/validation/css/formValidation.min.css') }}" />

		<!-- Theme CSS -->
		<link rel="stylesheet" href="{{ asset('contents/stylesheets/theme.css') }}" />

		<!-- Skin CSS -->
		<link rel="stylesheet" href="{{ asset('contents/stylesheets/skins/default.css') }}" />

		<!-- Theme Custom CSS -->
        <link rel="stylesheet" href="{{ asset('contents/stylesheets/theme-custom.css') }}">

		<!-- Head Libs -->
		<script src="{{ asset('contents/vendor/modernizr/modernizr.js') }}"></script>

	</head>
	<body>
		<section class="body">   
            <!-- start: header -->
            <header class="header">
                <div class="logo-container">
                    <a href="../" class="logo">
                        <img src="{{ asset('contents/images/logo.png') }}" height="35" alt="DIU Admin" />
                    </a>
                    <div class="visible-xs toggle-sidebar-left" data-toggle-class="sidebar-left-opened" data-target="html" data-fire-event="sidebar-left-opened">
                        <i class="fa fa-bars" aria-label="Toggle sidebar"></i>
                    </div>
                </div>
            
                <!-- start: search & user box -->
                <div class="header-right">
            
                    <form action="pages-search-results.html" class="search nav-form">
                        <div class="input-group input-search">
                            <input type="text" class="form-control" name="q" id="q" placeholder="Search...">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
                            </span>
                        </div>
                    </form>
            
                    <span class="separator"></span>
            
                    <ul class="notifications">
                        <li>
                            <a href="#" class="dropdown-toggle notification-icon" data-toggle="dropdown">
                                <i class="fa fa-tasks"></i>
                                <span class="badge"></span>
                            </a>
            
                            <div class="dropdown-menu notification-menu large">
                                <div class="notification-title">
                                    <span class="pull-right label label-default">3</span>
                                    Tasks
                                </div>
            
                                <div class="content">
                                    <ul>
                                        <li>
                                            <p class="clearfix mb-xs">
                                                <span class="message pull-left">Generating Sales Report</span>
                                                <span class="message pull-right text-dark">60%</span>
                                            </p>
                                            <div class="progress progress-xs light">
                                                <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;"></div>
                                            </div>
                                        </li>
            
                                        <li>
                                            <p class="clearfix mb-xs">
                                                <span class="message pull-left">Importing Contacts</span>
                                                <span class="message pull-right text-dark">98%</span>
                                            </p>
                                            <div class="progress progress-xs light">
                                                <div class="progress-bar" role="progressbar" aria-valuenow="98" aria-valuemin="0" aria-valuemax="100" style="width: 98%;"></div>
                                            </div>
                                        </li>
            
                                        <li>
                                            <p class="clearfix mb-xs">
                                                <span class="message pull-left">Uploading something big</span>
                                                <span class="message pull-right text-dark">33%</span>
                                            </p>
                                            <div class="progress progress-xs light mb-xs">
                                                <div class="progress-bar" role="progressbar" aria-valuenow="33" aria-valuemin="0" aria-valuemax="100" style="width: 33%;"></div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                        <li>
                            <a href="#" class="dropdown-toggle notification-icon" data-toggle="dropdown">
                                <i class="fa fa-envelope"></i>
                                <span class="badge"></span>
                            </a>
            
                            <div class="dropdown-menu notification-menu">
                                <div class="notification-title">
                                    <span class="pull-right label label-default">230</span>
                                    Messages
                                </div>
            
                                <div class="content">
                                    <ul>
                                        <li>
                                            <a href="#" class="clearfix">
                                                <figure class="image">
                                                    <img src="{{ asset('contents/images/!sample-user.jpg') }}" alt="Joseph Doe Junior" class="img-circle" />
                                                </figure>
                                                <span class="title">Joseph Doe</span>
                                                <span class="message">Lorem ipsum dolor sit.</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" class="clearfix">
                                                <figure class="image">
                                                    <img src="{{ asset('contents/images/!sample-user.jpg') }}" alt="Joseph Junior" class="img-circle" />
                                                </figure>
                                                <span class="title">Joseph Junior</span>
                                                <span class="message truncate">Truncated message. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec sit amet lacinia orci. Proin vestibulum eget risus non luctus. Nunc cursus lacinia lacinia. Nulla molestie malesuada est ac tincidunt. Quisque eget convallis diam, nec venenatis risus. Vestibulum blandit faucibus est et malesuada. Sed interdum cursus dui nec venenatis. Pellentesque non nisi lobortis, rutrum eros ut, convallis nisi. Sed tellus turpis, dignissim sit amet tristique quis, pretium id est. Sed aliquam diam diam, sit amet faucibus tellus ultricies eu. Aliquam lacinia nibh a metus bibendum, eu commodo eros commodo. Sed commodo molestie elit, a molestie lacus porttitor id. Donec facilisis varius sapien, ac fringilla velit porttitor et. Nam tincidunt gravida dui, sed pharetra odio pharetra nec. Duis consectetur venenatis pharetra. Vestibulum egestas nisi quis elementum elementum.</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" class="clearfix">
                                                <figure class="image">
                                                    <img src="{{ asset('contents/images/!sample-user.jpg') }}" alt="Joe Junior" class="img-circle" />
                                                </figure>
                                                <span class="title">Joe Junior</span>
                                                <span class="message">Lorem ipsum dolor sit.</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" class="clearfix">
                                                <figure class="image">
                                                    <img src="{{ asset('contents/images/!sample-user.jpg') }}" alt="Joseph Junior" class="img-circle" />
                                                </figure>
                                                <span class="title">Joseph Junior</span>
                                                <span class="message">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec sit amet lacinia orci. Proin vestibulum eget risus non luctus. Nunc cursus lacinia lacinia. Nulla molestie malesuada est ac tincidunt. Quisque eget convallis diam.</span>
                                            </a>
                                        </li>
                                    </ul>
            
                                    <hr />
            
                                    <div class="text-right">
                                        <a href="#" class="view-more">View All</a>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <a href="#" class="dropdown-toggle notification-icon" data-toggle="dropdown">
                                <i class="fa fa-bell"></i>
                                <span class="badge"></span>
                            </a>
            
                            <div class="dropdown-menu notification-menu">
                                <div class="notification-title">
                                    <span class="pull-right label label-default">3</span>
                                    Alerts
                                </div>
            
                                <div class="content">
                                    <ul>
                                        <li>
                                            <a href="#" class="clearfix">
                                                <div class="image">
                                                    <i class="fa fa-thumbs-down bg-danger"></i>
                                                </div>
                                                <span class="title">Server is Down!</span>
                                                <span class="message">Just now</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" class="clearfix">
                                                <div class="image">
                                                    <i class="fa fa-lock bg-warning"></i>
                                                </div>
                                                <span class="title">User Locked</span>
                                                <span class="message">15 minutes ago</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" class="clearfix">
                                                <div class="image">
                                                    <i class="fa fa-signal bg-success"></i>
                                                </div>
                                                <span class="title">Connection Restaured</span>
                                                <span class="message">10/10/2014</span>
                                            </a>
                                        </li>
                                    </ul>
            
                                    <hr />
            
                                    <div class="text-right">
                                        <a href="#" class="view-more">View All</a>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
            
                    <span class="separator"></span>
            
                    <div id="userbox" class="userbox">
                        <a href="#" data-toggle="dropdown">
                            <figure class="profile-picture">
                                <img src="{{ asset('contents/images/!logged-user.jpg') }}" alt="Joseph Doe" class="img-circle" data-lock-picture="{{ asset('contents/images/!logged-user.jpg') }}" />
                            </figure>
                            <div class="profile-info">
                                <span class="name">{{ Auth::user()->name }}</span>
                                <span class="role">Employee Panel</span>
                            </div>
            
                            <i class="fa custom-caret"></i>
                        </a>
            
                        <div class="dropdown-menu">
                            <ul class="list-unstyled">
                                <li class="divider"></li>
                                <li>
                                    <a role="menuitem" tabindex="-1" href="{{route('profile')}}"><i class="fa fa-user"></i> My Profile</a>
                                </li>
                                <li>
                                    <a role="menuitem" tabindex="-1" href="{{ route('logout') }}" 
                                        onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                        <i class="fa fa-power-off"></i> Logout
                                    </a>
                                </li>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- end: search & user box -->
            </header>
            <!-- end: header -->

            <div class="inner-wrapper">
                <!-- start: sidebar -->
                <aside id="sidebar-left" class="sidebar-left">
                
                    <div class="sidebar-header">
                        <div class="sidebar-title" style="color: white;">
                            Navigation
                        </div>
                        <div class="sidebar-toggle hidden-xs" data-toggle-class="sidebar-left-collapsed" data-target="html" data-fire-event="sidebar-left-toggle">
                            <i class="fa fa-bars" aria-label="Toggle sidebar"></i>
                        </div>
                    </div>
                
                    <div class="nano">
                        <div class="nano-content">
                            <nav id="menu" class="nav-main" role="navigation">
                                <ul class="nav nav-main">
                                    <li @if($page=="home") class="nav-active" style="background-color: #21262d;" @endif>
                                        <a href="{{route('home')}}">
                                            <i class="fa fa-home" aria-hidden="true"></i>
                                            <span>Dashboard</span>
                                        </a>
                                    </li>

                                    <li @if($page=="supervisorSemister") class="nav-active" style="background-color: #21262d;" @endif>
                                        <a href="{{route('supervisorSemister')}}">
                                            <i class="fa fa-table" aria-hidden="true"></i>
                                            <span>Semester</span>
                                        </a>
                                    </li>

                                    <li @if($page=="attendance") class="nav-active" style="background-color: #21262d;" @endif>
                                        <a href="{{route('attendance')}}">
                                            <i class="fa fa-share-square-o" aria-hidden="true"></i>
                                            <span>Attendance</span>
                                        </a>
                                    </li>

                                    @if((Auth::user()->is_supervisor) == 1)
                                    {{-- supervisor Start --}}
                                     <li @if($page=="employeeSemister") class="nav-active" style="background-color: #21262d;" @endif>
                                        <a href="{{route('employeeSemister')}}">
                                            <i class="fa fa-th-list" aria-hidden="true"></i>
                                            <span>Employee Semester</span>
                                        </a>
                                    </li>

                                     <li @if($page=="employeeAttendance") class="nav-active" style="background-color: #21262d;" @endif>
                                        <a href="{{route('employeeAttendance')}}">
                                            <span class="pull-right label label-primary">{{\App\EmployeeAttendanceActivities::where('seen_status', 0)->where('user_type', 2)->count()}}</span>
                                            <i class="fa fa-bell" aria-hidden="true"></i>
                                            <span>Notifications</span>
                                        </a>
                                    </li>

                                    <li @if($page=="attendanceReport")class="nav-active" style="background-color: #21262d;" @endif>
                                        <a href="{{route('attendanceReport')}}">
                                            <i class="fa fa-ticket" aria-hidden="true"></i>
                                            <span>Attendance Report</span>
                                        </a>
                                    </li>
                                    {{-- supervisor End --}}
                                    @endif
                                    
                                   
                                </ul>
                            </nav>
                        </div>
                    </div>
                
                </aside>
            <!-- end: sidebar -->
            <section role="main" class="content-body">
                <header class="page-header">
                    <h2>@if($page=="home")Dashboard @elseif($page=="supervisorSemister")My Semester @elseif($page=="employeeSemister")Employee Semester @elseif($page=="attendance")Attendance @endif</h2>
                    <div class="right-wrapper pull-right">
                        <a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
                    </div>
                </header>

			    @yield('content')
				
			</div>
			<aside id="sidebar-right" class="sidebar-right">
				<div class="nano">
					<div class="nano-content">
						<a href="#" class="mobile-close visible-xs">
							Collapse <i class="fa fa-chevron-right"></i>
						</a>
			
						<div class="sidebar-right-wrapper">
			
							<div class="sidebar-widget widget-calendar">
								<h6>Upcoming Tasks</h6>
								<div data-plugin-datepicker data-plugin-skin="dark" ></div>
			
								<ul>
									<li>
										<time datetime="2014-04-19T00:00+00:00">04/19/2014</time>
										<span>Company Meeting</span>
									</li>
								</ul>
							</div>
			
							<div class="sidebar-widget widget-friends">
								<h6>Friends</h6>
								<ul>
									<li class="status-online">
										<figure class="profile-picture">
											<img src="{{ asset('contents/images/!sample-user.jpg') }}" alt="Joseph Doe" class="img-circle">
										</figure>
										<div class="profile-info">
											<span class="name">Joseph Doe Junior</span>
											<span class="title">Hey, how are you?</span>
										</div>
									</li>
									<li class="status-online">
										<figure class="profile-picture">
											<img src="{{ asset('contents/images/!sample-user.jpg') }}" alt="Joseph Doe" class="img-circle">
										</figure>
										<div class="profile-info">
											<span class="name">Joseph Doe Junior</span>
											<span class="title">Hey, how are you?</span>
										</div>
									</li>
									<li class="status-offline">
										<figure class="profile-picture">
											<img src="{{ asset('contents/images/!sample-user.jpg') }}" alt="Joseph Doe" class="img-circle">
										</figure>
										<div class="profile-info">
											<span class="name">Joseph Doe Junior</span>
											<span class="title">Hey, how are you?</span>
										</div>
									</li>
									<li class="status-offline">
										<figure class="profile-picture">
											<img src="{{ asset('contents/images/!sample-user.jpg') }}" alt="Joseph Doe" class="img-circle">
										</figure>
										<div class="profile-info">
											<span class="name">Joseph Doe Junior</span>
											<span class="title">Hey, how are you?</span>
										</div>
									</li>
								</ul>
							</div>
			
						</div>
					</div>
				</div>
			</aside>
		</section>

        {{-- global modal for delete item --}}
        <div id="dialog" class="modal-block mfp-hide">
			<section class="panel">
				<header class="panel-heading">
					<h2 class="panel-title">Are you sure?</h2>
				</header>
				<div class="panel-body">
					<div class="modal-wrapper">
						<div class="modal-text">
							<p>Are you sure that you want to delete this row?</p>
						</div>
					</div>
				</div>
				<footer class="panel-footer">
					<div class="row">
						<div class="col-md-12 text-right">
							<button id="dialogConfirm" class="btn btn-primary">Confirm</button>
							<button id="dialogCancel" class="btn btn-default">Cancel</button>
						</div>
					</div>
				</footer>
			</section>
		</div>
		<!-- Vendor -->
		<script src="{{ asset('contents/vendor/jquery/jquery.js') }}"></script>
		<script src="{{ asset('contents/vendor/jquery-browser-mobile/jquery.browser.mobile.js') }}"></script>
		<script src="{{ asset('contents/vendor/bootstrap/js/bootstrap.js') }}"></script>
		<script src="{{ asset('contents/vendor/nanoscroller/nanoscroller.js') }}"></script>
		<script src="{{ asset('contents/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>
		<script src="{{ asset('contents/vendor/magnific-popup/magnific-popup.js') }}"></script>
		<script src="{{ asset('contents/vendor/jquery-placeholder/jquery.placeholder.js') }}"></script>
		
		<!-- Specific Page Vendor -->
		<script src="{{ asset('contents/vendor/jquery-ui/js/jquery-ui-1.10.4.custom.js') }}"></script>
		<script src="{{ asset('contents/vendor/jquery-ui-touch-punch/jquery.ui.touch-punch.js') }}"></script>
		<script src="{{ asset('contents/vendor/jquery-appear/jquery.appear.js') }}"></script>
		<script src="{{ asset('contents/vendor/bootstrap-multiselect/bootstrap-multiselect.js') }}"></script>
		<script src="{{ asset('contents/vendor/jquery-easypiechart/jquery.easypiechart.js') }}"></script>
		<script src="{{ asset('contents/vendor/flot/jquery.flot.js') }}"></script>
		<script src="{{ asset('contents/vendor/flot-tooltip/jquery.flot.tooltip.js') }}"></script>
		<script src="{{ asset('contents/vendor/flot/jquery.flot.pie.js') }}"></script>
		<script src="{{ asset('contents/vendor/flot/jquery.flot.categories.js') }}"></script>
		<script src="{{ asset('contents/vendor/flot/jquery.flot.resize.js') }}"></script>
		<script src="{{ asset('contents/vendor/jquery-sparkline/jquery.sparkline.js') }}"></script>
		<script src="{{ asset('contents/vendor/raphael/raphael.js') }}"></script>
		<script src="{{ asset('contents/vendor/morris/morris.js') }}"></script>
		<script src="{{ asset('contents/vendor/gauge/gauge.js') }}"></script>
		<script src="{{ asset('contents/vendor/snap-svg/snap.svg.js') }}"></script>
		<script src="{{ asset('contents/vendor/liquid-meter/liquid.meter.js') }}"></script>
		<script src="{{ asset('contents/vendor/jqvmap/jquery.vmap.js') }}"></script>
		<script src="{{ asset('contents/vendor/jqvmap/data/jquery.vmap.sampledata.js') }}"></script>
		<script src="{{ asset('contents/vendor/jqvmap/maps/jquery.vmap.world.js') }}"></script>
		<script src="{{ asset('contents/vendor/jqvmap/maps/continents/jquery.vmap.africa.js') }}"></script>
		<script src="{{ asset('contents/vendor/jqvmap/maps/continents/jquery.vmap.asia.js') }}"></script>
		<script src="{{ asset('contents/vendor/jqvmap/maps/continents/jquery.vmap.australia.js') }}"></script>
		<script src="{{ asset('contents/vendor/jqvmap/maps/continents/jquery.vmap.europe.js') }}"></script>
		<script src="{{ asset('contents/vendor/jqvmap/maps/continents/jquery.vmap.north-america.js') }}"></script>
        <script src="{{ asset('contents/vendor/jqvmap/maps/continents/jquery.vmap.south-america.js') }}"></script>
        
		<script src="{{ asset('contents/vendor/jquery-maskedinput/jquery.maskedinput.js') }}"></script>
		<script src="{{ asset('contents/vendor/bootstrap-tagsinput/bootstrap-tagsinput.js') }}"></script>
		<script src="{{ asset('contents/vendor/bootstrap-colorpicker/js/bootstrap-colorpicker.js') }}"></script>
        <script src="{{ asset('contents/vendor/bootstrap-timepicker/js/bootstrap-timepicker.js') }}"></script>
		<script src="{{ asset('contents/vendor/fuelux/js/spinner.js') }}"></script>
		{{-- <script src="{{ asset('contents/vendor/dropzone/dropzone.js') }}"></script> --}}
		<script src="{{ asset('contents/vendor/bootstrap-markdown/js/markdown.js') }}"></script>
		<script src="{{ asset('contents/vendor/bootstrap-markdown/js/to-markdown.js') }}"></script>
        <script src="{{ asset('contents/vendor/bootstrap-markdown/js/bootstrap-markdown.js') }}"></script>
        
		<script src="{{ asset('contents/vendor/codemirror/lib/codemirror.js') }}"></script>
		<script src="{{ asset('contents/vendor/codemirror/addon/selection/active-line.js') }}"></script>
		<script src="{{ asset('contents/vendor/codemirror/addon/edit/matchbrackets.js') }}"></script>
		<script src="{{ asset('contents/vendor/codemirror/mode/javascript/javascript.js') }}"></script>
		<script src="{{ asset('contents/vendor/codemirror/mode/xml/xml.js') }}"></script>
		<script src="{{ asset('contents/vendor/codemirror/mode/htmlmixed/htmlmixed.js') }}"></script>
		<script src="{{ asset('contents/vendor/codemirror/mode/css/css.js') }}"></script>
		<script src="{{ asset('contents/vendor/summernote/summernote.js') }}"></script>
		<script src="{{ asset('contents/vendor/bootstrap-maxlength/bootstrap-maxlength.js') }}"></script>
        <script src="{{ asset('contents/vendor/ios7-switch/ios7-switch.js') }}"></script>

        <!-- DataTable Vendor -->
		<script src="{{ asset('contents/vendor/select2/select2.js') }}"></script>
		<script src="{{ asset('contents/vendor/jquery-datatables/media/js/jquery.dataTables.js') }}"></script>
        <script src="{{ asset('contents/vendor/jquery-datatables-bs3/assets/js/datatables.js') }}"></script>
        
		<!-- Theme Base, Components and Settings -->
		<script src="{{ asset('contents/javascripts/theme.js') }}"></script>
		
		<!-- Theme Custom -->
		<script src="{{ asset('contents/javascripts/theme.custom.js') }}"></script>
		
		<!-- Theme Initialization Files -->
		<script src="{{ asset('contents/javascripts/theme.init.js') }}"></script>

		<!-- Examples -->
        <script src="{{ asset('contents/javascripts/dashboard/examples.dashboard.js') }}"></script>
        <script src="{{ asset('contents/javascripts/tables/examples.datatables.editable.js') }}"></script>

        <!-- Validation -->
        <script src="{{ asset('contents/validation/js/formValidation.min.js') }}"></script>
        
        @stack('javaScript')
	</body>
</html>