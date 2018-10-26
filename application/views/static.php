<?php
date_default_timezone_set("Asia/Jakarta");
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
	<meta name="author" content="Coderthemes">

	<link rel="shortcut icon" href="<?=base_url();?>assets/images/favicon_1.ico">

	<title>Sistem Monitoring Laporan Percetakan</title>

	<!-- DataTables -->
	<link href="<?=base_url();?>assets/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css"/>
	<link href="<?=base_url();?>assets/plugins/datatables/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css"/>

	<!-- Date Picker -->	
	<link href="<?=base_url();?>assets/plugins/timepicker/bootstrap-timepicker.min.css" rel="stylesheet">
	<link href="<?=base_url();?>assets/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css" rel="stylesheet">
	<link href="<?=base_url();?>assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">
	<link href="<?=base_url();?>assets/plugins/clockpicker/css/bootstrap-clockpicker.min.css" rel="stylesheet">
	<link href="<?=base_url();?>assets/plugins/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

	<link href="<?=base_url();?>assets/plugins/bootstrap-select/css/bootstrap-select.min.css" rel="stylesheet" />

	<link href="<?=base_url();?>assets/plugins/custombox/css/custombox.css" rel="stylesheet">
	<link href="<?=base_url();?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
	<link href="<?=base_url();?>assets/css/core.css" rel="stylesheet" type="text/css" />
	<link href="<?=base_url();?>assets/css/components.css" rel="stylesheet" type="text/css" />
	<link href="<?=base_url();?>assets/css/icons.css" rel="stylesheet" type="text/css" />
	<link href="<?=base_url();?>assets/css/pages.css" rel="stylesheet" type="text/css" />
	<link href="<?=base_url();?>assets/css/responsive.css" rel="stylesheet" type="text/css" />

	<!-- CSS INTERNAL -->
	<style type="text/css">
		.logo{
			font-size : 16px;
		}
		#sidebar-menu{
			padding-top: 0px;
		}
		th{
			color: black;
		}
		td{
			color: black;
		}
		.table-hover > tbody > tr:hover{
			background-color: #8c8c8c !important;
		}
		body{
			color: black;
		}
		.dropdown-menu>li>a{
			color: black;
		}
	</style>

	<script src="<?=base_url();?>assets/js/modernizr.min.js"></script>
	<script type="text/javascript">
		function printPreCetak($id){
			var restorePage = document.body.innerHTML;
			var printContents = document.getElementById('detail-'+ $id).innerHTML;
			document.body.innerHTML = printContents;
			window.print();
			document.body.innerHTML = restorePage;
		}

		function printCetak($id){
			var restorePage = document.body.innerHTML;
			var printContents = document.getElementById('detail-cetak-'+ $id).innerHTML;
			document.body.innerHTML = printContents;
			window.print();
			document.body.innerHTML = restorePage;
		}

		function printFinishing($id){
			var restorePage = document.body.innerHTML;
			var printContents = document.getElementById('detail-finishing-'+ $id).innerHTML;
			document.body.innerHTML = printContents;
			window.print();
			document.body.innerHTML = restorePage;
		}
	</script>

</head>

<body class="fixed-left">

	<!-- Begin page -->
	<div id="wrapper">

		<!-- Top Bar Start -->
		<div class="topbar">

			<!-- LOGO -->
			<div class="topbar-left">
				<div class="text-center">
					<a href="<?php
						switch($this->session->userdata('hak_akses')){
							case 'Admin':
								echo base_url('admincontroller');
							break;
							
							case 'Pimpinan':
								echo base_url('pimpinancontroller');
							break;

							case 'Pre Cetak':
								echo base_url('precetakcontroller');
							break;

							case 'Cetak':
								echo base_url('cetakcontroller');
							break;

							case 'Finishing':
								echo base_url('finishingcontroller');
							break;
						}
					?>" class="logo"><i class="icon-magnet icon-c-logo"></i><span>PT. Metro Grafindo</span></a>
				</div>
			</div>

			<!-- Button mobile view to collapse sidebar menu -->
			<div class="navbar navbar-default" role="navigation">
				<div class="container">
					<div class="">
						<div class="pull-left">
							<button class="button-menu-mobile open-left waves-effect waves-light">
								<i class="md md-menu"></i>
							</button>
							<span class="clearfix"></span>
						</div>

						<ul class="nav navbar-nav navbar-right pull-right">
							<li class="hidden-xs">
								<a href="<?php echo base_url('logoutcontroller') ?>"><i class="glyphicon glyphicon-log-out"></i></a>
							</li>
						</ul>
					</div>
					<!--/.nav-collapse -->
				</div>
			</div>
		</div>
		<!-- Top Bar End -->

		<!-- Left Sidebar Start -->
		<div class="left side-menu">
			<div class="sidebar-inner slimscrollleft">
				<!--- Divider -->
				<div id="sidebar-menu">
					<ul>
						<!-- DASHBOARD -->
						<li>
							<a href="<?php 
							switch($this->session->userdata('hak_akses')){
								case 'Admin':
								echo base_url('admincontroller');
								break;

								case 'Pimpinan':
								echo base_url('pimpinancontroller');
								break;

								case 'Pre Cetak':
								echo base_url('precetakcontroller');
								break;

								case 'Cetak':
								echo base_url('cetakcontroller');
								break;

								case 'Finishing':
								echo base_url('finishingcontroller');
								break;
							}
							?>" class="waves-effect"><i class="ti-home"></i> <span> Dashboard </span></a>
						</li>

						<?php
						// MENU KHUSUS ADMIN
						if ($this->session->userdata('hak_akses') == 'Admin') {
							?>
							<li>
								<a href="<?php echo base_url('admincontroller/pengguna') ?>" class="waves-effect"><i class="md-person"></i> <span> Pengguna </span></a>
							</li>
							<?php
						// MENU KHUSUS PIMPINAN
						} else if ($this->session->userdata('hak_akses') == 'Pimpinan') {
							?>
							<li>
								<a href="<?php echo base_url('pimpinancontroller/monitoring') ?>" class="waves-effect"><i class="fa fa-tripadvisor"></i> <span> Monitoring </span></a>
							</li>
							<li class="has_sub">
								<a href="javascript:void(0);" class="waves-effect"><i class="fa fa-file-pdf-o"></i> <span> Laporan Divisi </span> <span class="menu-arrow"></span> </a>
								<ul class="list-unstyled">
									<li><a href="<?php echo base_url('pimpinancontroller/laporandivisi/precetak') ?>">Pre Cetak</a></li>
									<li><a href="<?php echo base_url('pimpinancontroller/laporandivisi/cetak') ?>"> Cetak</a></li>
									<li><a href="<?php echo base_url('pimpinancontroller/laporandivisi/finishing') ?>">Finishing</a></li>
								</ul>
							</li>
							<?php
						}

						// MENU KHUSUS DIVISI
						if (($this->session->userdata('hak_akses') != 'Admin') && ($this->session->userdata('hak_akses') != 'Pimpinan')) {
							?>
							<li>
								<a href="<?php
								switch($this->session->userdata('hak_akses')){
									case 'Pre Cetak':
									echo base_url('precetakcontroller/status');
									break;

									case 'Cetak':
									echo base_url('cetakcontroller/status');
									break;

									case 'Finishing':
									echo base_url('finishingcontroller/status');
									break;
								}

								?>" class="waves-effect"><i class="fa fa-check-square"></i> <span> Status </span></a>
							</li>
							<li>
								<a href="<?php 
								switch($this->session->userdata('hak_akses')){
									case 'Pre Cetak':
									echo base_url('precetakcontroller/laporan');
									break;

									case 'Cetak':
									echo base_url('cetakcontroller/laporan');
									break;

									case 'Finishing':
									echo base_url('finishingcontroller/laporan');
									break;
								}
								?>" class="waves-effect"><i class="fa fa-file-pdf-o"></i> <span> Laporan </span></a>
							</li>
							<?php
						}
						?>					

					</ul>
					<div class="clearfix"></div>
				</div>
				<div class="clearfix"></div>
			</div>
		</div>
		<!-- Left Sidebar End -->

		<?php
		echo $contents;
		?>

	</div>
	<!-- END wrapper -->

	<script>
		var resizefunc = [];
	</script>

	<!-- jQuery  -->
	<script src="<?=base_url();?>assets/js/jquery.min.js"></script>
	<script src="<?=base_url();?>assets/js/bootstrap.min.js"></script>
	<script src="<?=base_url();?>assets/js/detect.js"></script>
	<script src="<?=base_url();?>assets/js/fastclick.js"></script>
	<script src="<?=base_url();?>assets/js/jquery.slimscroll.js"></script>
	<script src="<?=base_url();?>assets/js/jquery.blockUI.js"></script>
	<script src="<?=base_url();?>assets/js/waves.js"></script>
	<script src="<?=base_url();?>assets/js/wow.min.js"></script>
	<script src="<?=base_url();?>assets/js/jquery.nicescroll.js"></script>
	<script src="<?=base_url();?>assets/js/jquery.scrollTo.min.js"></script>

	<!-- Date Picker -->
	<script src="<?=base_url();?>assets/plugins/moment/moment.js"></script>
	<script src="<?=base_url();?>assets/plugins/timepicker/bootstrap-timepicker.js"></script>
	<script src="<?=base_url();?>assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
	<script src="<?=base_url();?>assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
	<script src="<?=base_url();?>assets/plugins/clockpicker/js/bootstrap-clockpicker.min.js"></script>
	<script src="<?=base_url();?>assets/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>

	<!-- JS DATATABLE -->
	<script src="<?=base_url();?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
	<script src="<?=base_url();?>assets/plugins/datatables/dataTables.bootstrap.js"></script>
	<script src="<?=base_url();?>assets/pages/datatables.init.js"></script>

	<!-- Modal-Effect -->
	<script src="<?=base_url();?>assets/plugins/custombox/js/custombox.min.js"></script>
	<script src="<?=base_url();?>assets/plugins/custombox/js/legacy.min.js"></script>

	<!-- Notification -->
	<script src="<?=base_url();?>assets/plugins/notifyjs/js/notify.js"></script>
	<script src="<?=base_url();?>assets/plugins/notifications/notify-metro.js"></script>

	<script src="<?=base_url();?>assets/plugins/bootstrap-select/js/bootstrap-select.min.js" type="text/javascript"></script>

	<script src="<?=base_url();?>assets/js/jquery.core.js"></script>
	<script src="<?=base_url();?>assets/js/jquery.app.js"></script>

	<!-- Form Picker -->
	<script src="<?=base_url();?>assets/pages/jquery.form-pickers.init.js"></script>

	<!-- PARSLEY -->
	<script type="text/javascript" src="<?=base_url();?>assets/plugins/parsleyjs/parsley.min.js"></script>

	<script type="text/javascript">
		$(document).ready(function () {
			$('#datatable').dataTable();
			var table = $('#datatable-fixed-header').DataTable({fixedHeader: true});
			var table = $('#datatable-fixed-col').DataTable({
				scrollY: "300px",
				scrollX: true,
				scrollCollapse: true,
				paging: false,
				fixedColumns: {
					leftColumns: 1,
					rightColumns: 1
				}
			});
			$(document).ready(function() {
				$('form').parsley();
			});
		});
		TableManageButtons.init();
	</script>

</body>
</html>