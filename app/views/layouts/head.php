<?php

use App\Core\App;
use App\Core\Auth;
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel='icon' href='<?= public_url('/favicon.ico') ?>' type='image/ico' />
	<title>
		<?= ucfirst($pageTitle) . " | " . App::get('config')['app']['name'] ?>
	</title>

	<!-- Google Font: Source Sans Pro -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,800,800i,900,900i">
	<!-- Font Awesome Icons -->
	<link rel="stylesheet" href="<?= public_url('/assets/adminlte/plugins/fontawesome-free/css/all.min.css') ?>">
	<!-- Theme style -->
	<link rel="stylesheet" href="<?= public_url('/assets/adminlte/css/adminlte.min.css') ?>">
	<link rel="stylesheet" href="<?= public_url('/assets/adminlte/css/highlighter.css') ?>">
	<!-- overlayScrollbars -->
	<link rel="stylesheet" href="<?= public_url('/assets/adminlte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') ?>">

	<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/11.1.0/styles/default.min.css">
	<script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/11.1.0/highlight.min.js"></script>

	<style>
		body {
			font-family: 'Nunito' !important;
		}

		h1,
		h2,
		h3,
		h4,
		h5,
		h6 {
			margin-top: 2.5rem;
		}

		img {
			width: 100% !important;
		}

		pre {
			margin-top: 5px;
			padding: 0px;
			border-radius: 6px;
			box-shadow: 0 1px 1px rgb(0 0 0 / 20%);
			background: rgba(37,42,55,var(--tw-bg-opacity))!important;
		}

		code {
			color: #0c8819;
			border-radius: 6px;
			background-color: #6e768154;
			padding: 2px 4px;
		}

		.content-wrapper {
			color: #484545 !important;
			background-color: #FFF !important;
		}

		.hljs {
			background: #fbfbfd !important;
		}

		a {
			color: #0b8818;
		}

		a:hover {
		    color: #0e5115;
		}
		
		.dark-mode a:not(.btn):hover {
		    color: #0e5115;
		}

		.dark-mode {
		  background-color: black;
		  color: white;
		}

		.dark-mode .content-wrapper {
			color: #bbb7b7 !important;
			background-color: #14151a !important;
		}

		.dark-mode .navbar-white {
		    background-color: #222328;
			color: #fff;
		}

		.dark-mode .navbar-nav .nav-link  {
			color: #fff;
		}

		.dark-mode .navbar-nav .nav-link:hover {
		    color: rgba(181, 179, 179, 0.7);
		}

		.dark-mode .navbar-nav .nav-link:focus {
		    color: rgba(181, 179, 179, 0.7);
		}

		.dark-mode .main-sidebar {
			background-color: #202126 !important;
		}

		.dark-mode .brand-link {
			background-color: #202126 !important;
    		border-bottom: 1px solid #242526;
		}

		.dark-mode .main-footer {
			background-color: #202126 !important;
		}

		.dark-mode .main-header {
			border-bottom: 1px solid #28292f;
		}

		.dark-mode .hljs {
			background: #2d323e6b !important;
			/*color: #3c3c3c;*/
			color: #e3dede;
		}

		.hljs-deletion, .hljs-number, .hljs-quote, .hljs-selector-class, .hljs-selector-id, .hljs-string, .hljs-template-tag, .hljs-type {
		    color: #0c8819 !important;
		}

		.hljs-tag .hljs-attr, .hljs-tag .hljs-name {
		    color: #929292;
		}

		.hljs-punctuation, .hljs-tag {
		    color: #888;
		}
	</style>

	<!-- jQuery -->
	<script src="<?= public_url('/assets/adminlte/plugins/jquery/jquery.min.js') ?>"></script>

	<?php
	// this will auto include filepond css/js when adding filepond in public/assets
	if (file_exists('public/assets/filepond')) {
		require_once 'public/assets/filepond/filepond.php';
	}

	$updateDir = array_diff(scandir(__DIR__ . '/../update/'), array('.', '..'));
	?>

	<script>
		const base_url = "<?= App::get('base_url') ?>";
		const session_dm = localStorage.getItem('dark-mode');
		

	    $(document).ready(function() {
	        var version_selected = "<?= $_SESSION['VERSION'] ?>";
	        if (version_selected == "") {
	            changeVersion();
	        }
	    });

		function changeVersion() {
			var selectedVersion = $("#selected-version").val();
			$.post("change-version", {
				selectedVersion: selectedVersion
			}, function(data) {
				location.reload();
			});
		}
	</script>
</head>
</head>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed">

	<script type="text/javascript">	
    	const element_bdy = document.body;
        if(session_dm == 1){
            element_bdy.classList.add("dark-mode");
        }else{
            element_bdy.classList.remove("dark-mode");
        }
	</script>

	<div class="wrapper">

		<!-- Navbar -->
		<nav class="main-header navbar navbar-expand navbar-white navbar-light">
			<!-- Left navbar links -->
			<ul class="navbar-nav">
				<li class="nav-item">
					<a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
				</li>
				<li class="nav-item d-sm-inline-block">
					<select class="nav-link form-control" name="selected-version" id="selected-version" style="width: 200px;" onchange="changeVersion()">
						<?php
						rsort($updateDir);
						foreach ($updateDir as $file) :
							$selected = ($_SESSION['VERSION'] == $file) ? 'selected' : '';
						?>
							<option <?= $selected ?> value="<?= $file ?>"><?= $file ?></option>
						<?php endforeach; ?>
					</select>
				</li>
			</ul>

			<!-- Right navbar links -->
			<ul class="navbar-nav ml-auto">
				<li class="nav-item">
					<a class="nav-link" data-widget="fullscreen" href="#" role="button">
						<i class="fas fa-expand-arrows-alt"></i>
					</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#" role="button" onclick="darkMood()">
						<i class="fas fa-adjust"></i>
					</a>
				</li>
			</ul>
		</nav>
		<!-- /.navbar -->

		<!-- Main Sidebar Container -->
		<aside class="main-sidebar sidebar-dark-primary elevation-4">
			<!-- Brand Logo -->
			<a href="<?= route('/') ?>" class="brand-link">
				<span class="brand-image img-circle elevation-3" style="opacity: .8"></span>
				<span class="brand-text font-weight-light" style="font-size: 18px;"><?= App::get('config')['app']['name'] ?></span>
			</a>

			<!-- Sidebar -->
			<div class="sidebar">

				<!-- SidebarSearch Form -->
				<div class="form-inline mt-3">
					<div class="input-group" data-widget="sidebar-search">
						<input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
						<div class="input-group-append">
							<button class="btn btn-sidebar">
								<i class="fas fa-search fa-fw"></i>
							</button>
						</div>
					</div>
				</div>

				<!-- Sidebar Menu -->
				<nav class="mt-2 pb-3">
					<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
						<li class="nav-item">
							<a href="<?= route('/whats-new') ?>" class="nav-link">
								<i class="nav-icon fas fa-certificate"></i>
								<p>
									What's new?
								</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?= route('/introduction') ?>" class="nav-link">
								<i class="nav-icon fas fa-home"></i>
								<p>
									Introduction
								</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?= route('/upgrade-guide') ?>" class="nav-link">
								<i class="nav-icon fas fa-cog"></i>
								<p>
									Upgrade Guide
								</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?= route('/installation') ?>" class="nav-link">
								<i class="nav-icon fas fa-microchip"></i>
								<p>
									Installation
								</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?= route('/deployment') ?>" class="nav-link">
								<i class="nav-icon fas fa-cloud-upload-alt"></i>
								<p>
									Deployment
								</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?= route('/file-structure') ?>" class="nav-link">
								<i class="nav-icon fas fa-list"></i>
								<p>
									File Structure
								</p>
							</a>
						</li>
						<li class="nav-header">Digging Deeper</li>
						<li class="nav-item">
							<a href="<?= route('/databases') ?>" class="nav-link">
								<i class="nav-icon fas fa-database"></i>
								<p>
									Database
								</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?= route('/migration') ?>" class="nav-link">
								<i class="nav-icon fas fa-download"></i>
								<p>
									Migration
								</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?= route('/routing') ?>" class="nav-link">
								<i class="nav-icon fas fa-ethernet"></i>
								<p>
									Routing
								</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?= route('/controllers') ?>" class="nav-link">
								<i class="nav-icon fas fa-laptop-code"></i>
								<p>
									Controllers
								</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?= route('/views') ?>" class="nav-link">
								<i class="nav-icon far fa-eye"></i>
								<p>
									Views
								</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?= route('/validation') ?>" class="nav-link">
								<i class="nav-icon fas fa-exclamation-circle"></i>
								<p>
									Validation
								</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?= route('/authentication') ?>" class="nav-link">
								<i class="nav-icon fas fa-lock"></i>
								<p>
									Authentication
								</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?= route('/registration') ?>" class="nav-link">
								<i class="nav-icon fas fa-user-friends"></i>
								<p>
									Registration
								</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?= route('/alerts') ?>" class="nav-link">
								<i class="nav-icon fas fa-exclamation-triangle"></i>
								<p>
									Alert Messages
								</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?= route('/helpers') ?>" class="nav-link">
								<i class="nav-icon fas fa-info-circle"></i>
								<p>
									Function helpers
								</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?= route('/csrf') ?>" class="nav-link">
								<i class="nav-icon fas fa-user-shield"></i>
								<p>
									Csrf Protection
								</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?= route('/email') ?>" class="nav-link">
								<i class="nav-icon fas fa-envelope"></i>
								<p>
									E-mail
								</p>
							</a>
						</li>
						<li class="nav-header">Packages</li>
						<li class="nav-item">
							<a href="<?= route('/packages/fortify') ?>" class="nav-link">
								<i class="nav-icon fas fa-dungeon"></i>
								<p>
									Fortify
								</p>
							</a>
						</li>
						<li class="nav-header">Sprnva Horizons</li>
						<li class="nav-item">
							<a href="<?= route('/argon-template') ?>" class="nav-link">
								<i class="nav-icon fas fa-clone"></i>
								<p>
									Argon template
								</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?= route('/adminty-template') ?>" class="nav-link">
								<i class="nav-icon fas fa-clone"></i>
								<p>
									Adminty template
								</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?= route('/adminlte-template') ?>" class="nav-link">
								<i class="nav-icon fas fa-clone"></i>
								<p>
									AdminLte3
								</p>
							</a>
						</li>
					</ul>
				</nav>
				<!-- /.sidebar-menu -->
			</div>
			<!-- /.sidebar -->
		</aside>

		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">

			<!-- Main content -->
			<div class="content">
				<div class="container-fluid">
					<div class="row">