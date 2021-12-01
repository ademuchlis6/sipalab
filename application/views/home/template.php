<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js">
<!--<![endif]-->
<!-- BEGIN HEAD -->

<head>
	<meta charset="utf-8" />
	<title>SIPALAB</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta content="width=device-width, initial-scale=1.0" name="viewport" />
	<meta content="<?php echo $this->config->item('nama_site') ?>" name="description" />
	<meta content="Ade Muchlis M Anwar" name="author" />
	<!-- BEGIN GLOBAL MANDATORY STYLES -->
	<!--<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>-->
	<link href="<?php echo base_url() ?>assets/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />

	<!--<link href="<?php echo base_url() ?>assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>-->
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/bootstrap.min.css">


	<link href="<?php echo base_url() ?>assets/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css" />
	<!-- END GLOBAL MANDATORY STYLES -->
	<!-- BEGIN PAGE LEVEL STYLES -->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/plugins/select2/select2.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/plugins/select2/select2-metronic.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/plugins/bootstrap-datepicker/css/datepicker.css" />
	<!--<link href="<?php echo base_url() ?>assets/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css" rel="stylesheet" type="text/css"/>-->
	<!--<link href="<?php echo base_url() ?>assets/plugins/bootstrap-modal/css/bootstrap-modal.css" rel="stylesheet" type="text/css"/>-->
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/data-tables/DT_bootstrap.css" />
	<!-- END PAGE LEVEL STYLES -->
	<!-- BEGIN THEME STYLES -->
	<link href="<?php echo base_url() ?>assets/css/style-metronic.min.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url() ?>assets/css/style.min.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url() ?>assets/css/style-responsive.min.css" rel="stylesheet" type="text/css" />
	<!-- <link href="<?php echo base_url() ?>assets/css/siak-style.css" rel="stylesheet" type="text/css" /> -->
	<link href="<?php echo base_url() ?>assets/css/plugins.min.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url() ?>assets/css/themes/default.css" rel="stylesheet" type="text/css" id="style_color" />
	<link href="<?php echo base_url() ?>assets/css/custom.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url() ?>assets/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url() ?>assets/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />
	<!-- <link type="text/css" href="//gyrocode.github.io/jquery-datatables-checkboxes/1.2.11/css/dataTables.checkboxes.css" rel="stylesheet" /> -->



	<!-- END THEME STYLES -->

	<link rel="shortcut icon" href="<?php echo base_url() ?>assets/img/favicon.png" />

	<script src="<?php echo base_url() ?>assets/plugins/jquery-1.10.2.min.js" type="text/javascript"></script>

</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->

<body class="page-header-fixed page-sidebar-fixed">
	<!-- BEGIN HEADER -->
	<div class="header navbar navbar-fixed-top">
		<!-- BEGIN TOP NAVIGATION BAR -->
		<div class="header-inner">
			<!-- BEGIN LOGO -->

			<a class="navbar-brand" href="<?php echo site_url() ?>">

				<p style="margin-top: 0px; margin-left: 20px ;  color:#fff">SIPALAB</p>
				<!-- DASHBOARD DISDUKCAPIL KOTA BOGOR -->
			</a>
			<!-- END LOGO -->
			<!-- BEGIN RESPONSIVE MENU TOGGLER -->
			<a href="javascript:;" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
				<img src="<?php echo base_url() ?>assets/img/menu-toggler.png" alt="" />
			</a>
			<!-- END RESPONSIVE MENU TOGGLER -->



			<!-- BEGIN TOP NAVIGATION MENU -->
			<ul class="nav navbar-nav pull-right">
				<!-- BEGIN USER LOGIN DROPDOWN -->
				<li class="dropdown user">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
						<img alt="" src="<?php echo base_url() ?>assets/img/user_small.png" width="24" />
						<span class="username">
							<?php echo $this->ion_auth->user()->row()->username; ?>
						</span>
						<i class="fa fa-angle-down"></i>
					</a>
					<ul class="dropdown-menu">
						<li>
							<a href="javascript:;" id="trigger_fullscreen">
								<i class="fa fa-arrows"></i> Full Screen
							</a>
						</li>
						<li>
							<a href="<?php echo site_url('auth/logout') ?>">
								<i class="fa fa-key"></i> Log Out
							</a>
						</li>
					</ul>
				</li>
				<!-- END USER LOGIN DROPDOWN -->
			</ul>
			<!-- END TOP NAVIGATION MENU -->
		</div>
		<!-- END TOP NAVIGATION BAR -->
	</div>
	<!-- END HEADER -->
	<div class="clearfix">
	</div>
	<!-- BEGIN CONTAINER -->
	<div class="page-container">
		<!-- BEGIN SIDEBAR1 -->
		<div class="page-sidebar navbar-collapse collapse">
			<!-- BEGIN SIDEBAR MENU1 -->
			<ul class="page-sidebar-menu" data-auto-scroll="true" data-slide-speed="200">
				<li>
					<!-- BEGIN SIDEBAR TOGGLER BUTTON
				<div class="sidebar-toggler hidden-xs">
				</div>
				 BEGIN SIDEBAR TOGGLER BUTTON -->
				</li>
				<li class="start">
					<a class="ajaxify start" href="<?php echo site_url('profile/profileInfo') ?>">
						<i class="fa fa-home"></i>
						<span class="title">
							HOME
						</span>
						<!--		<span class="selected">
					</span>
				-->
					</a>
				</li>
				<?php
				//	if($this->session->userdata('level')==0) {
				//	$this->load->view('admin/menu/admin');
				//		} elseif($this->session->userdata('level')==1) {
				$this->load->view('home/menu');
				//			}
				?>
				<!--			<li>
				<a href="javascript:;">
					<i class="fa fa-users"></i>
					<span class="title">
						MENU
					</span>
					<span class="selected">
					</span>
					<span class="arrow">
					</span>
				</a>
				<ul class="sub-menu">
					<li>
						<a class="ajaxify" href="<?php echo site_url('user/input') ?>">
							MENU
						</a>
					</li>
					<li>
						<a class="ajaxify" href="<?php echo site_url('user/listdata') ?>">
							MENU
						</a>
					</li>
				</ul>
			</li>
			<li>
				<a href="javascript:;">
					<i class="fa fa-file"></i>
					<span class="title">
						MENU
					</span>
					<span class="selected">
					</span>
					<span class="arrow">
					</span>
				</a>
				<ul class="sub-menu">
					<li>
						<a class="ajaxify" href="<?php echo site_url('dkb/input') ?>">
							MENU
						</a>
					</li>
					<li>
						<a class="ajaxify" href="<?php echo site_url('dkb/listdata') ?>">
							MENU
						</a>
					</li>
				</ul>
			</li>
-->

			</ul>
			<!-- END SIDEBAR MENU1 -->
		</div>
		<!-- END SIDEBAR1 -->
		<!-- BEGIN CONTENT -->

		<div class="page-content-wrapper">
			<div class="page-content">
				<div class="page-content-body" id="page-content-body">

					<!-- HERE WILL BE LOADED AN AJAX CONTENT -->
				</div>
			</div>
			<!-- BEGIN CONTENT -->
		</div>
		<!-- END CONTAINER -->
		<!-- BEGIN FOOTER -->
		<div class="footer">
			<div class="footer-inner">
				<?php echo date('Y'); ?> &copy; Ademuchlis. All Rights Reserved. SIPALAB 1.0<?php //echo $this->config->item('wil_name').' '.CI_VERSION 
																							?>.
			</div>
			<div class="footer-tools">
				<span class="go-top">
					<i class="fa fa-angle-up"></i>
				</span>
			</div>
		</div>

		<!-- END FOOTER -->
		<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
		<!-- BEGIN CORE PLUGINS -->
		<!--[if lt IE 9]>
<script src="<?php echo base_url() ?>assets/plugins/respond.min.js"></script>
<script src="<?php echo base_url() ?>assets/plugins/excanvas.min.js"></script> 
<![endif]-->
		<script src="<?php echo base_url() ?>assets/plugins/jquery-migrate-1.2.1.min.js" type="text/javascript"></script>

		<script src="<?php echo base_url() ?>assets/plugins/jquery-ui/jquery-ui-1.10.3.custom.min.js" type="text/javascript"></script>

		<script src="<?php echo base_url() ?>assets/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>


		<script src="<?php echo base_url() ?>assets/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
		<script src="<?php echo base_url() ?>assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
		<script src="<?php echo base_url() ?>assets/plugins/jquery.blockui.min.js" type="text/javascript"></script>
		<!-- <script src="<?php echo base_url() ?>assets/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script> -->

		<script src="<?php echo base_url() ?>assets/plugins/highcharts/highcharts.js"></script>
		<script src="<?php echo base_url() ?>assets/plugins/highcharts/highcharts-3d.js"></script>
		<script src="<?php echo base_url() ?>assets/plugins/highcharts/modules/exporting.js"></script>

		<script type="text/javascript" src="<?php echo base_url() ?>assets/plugins/select2/select2.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url() ?>assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
		<script src="<?php echo base_url() ?>assets/plugins/bootstrap-modal/js/bootstrap-modalmanager.js" type="text/javascript"></script>
		<script src="<?php echo base_url() ?>assets/plugins/bootstrap-modal/js/bootstrap-modal.js" type="text/javascript"></script>
		<script type="text/javascript" src="<?php echo base_url() ?>assets/plugins/data-tables/jquery.dataTables.js"></script>
		<script type="text/javascript" src="<?php echo base_url() ?>assets/plugins/data-tables/DT_bootstrap.js"></script>

		<script src="<?php echo base_url() ?>assets/js/jquery.dataTables.min.js"></script>
		<script src="<?php echo base_url() ?>assets/js/dataTables.bootstrap4.min.js"></script>

		<script src="<?php echo base_url() ?>assets/js/dataTables.buttons.min.js"></script>

		<!-- <script type="text/javascript" src="//gyrocode.github.io/jquery-datatables-checkboxes/1.2.11/js/dataTables.checkboxes.min.js"></script> -->

		<script src="<?php echo base_url() ?>assets/js/jszip.min.js"></script>
		<script src="<?php echo base_url() ?>assets/js/buttons.html5.min.js"></script>

		<script src="<?php echo base_url() ?>assets/scripts/core/app.js"></script>
		<script type="text/javascript" src="<?php echo base_url() ?>assets/plugins/jquery.media.js"></script>
		<script type="text/javascript">
			jQuery(document).ready(function() {
				App.init();
				$('.page-sidebar .ajaxify.start').click(); // load the content for the dashboard page.
				// menuclick();
			});
		</script>
		<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->

</html>