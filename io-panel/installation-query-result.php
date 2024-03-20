<?php
	include_once 'include/config.php';
	include_once 'include/admin-functions.php';
	$admin = new AdminFunctions();

	if(!$loggedInUserDetailsArr = $admin->sessionExists()){
		header("location: admin-login.php");
		exit();
	}

	$pageName = "Installation Enquiry";
	$tableName = 'installation_queries';
	$deleteURL = 'installation-query-result.php';
	$pageURL = 'installation-query-result.php';

	$sql = "select * from ".PREFIX.$tableName." order by id DESC";
	$results = $admin->query($sql);

	if(isset($_GET['delId']) && !empty($_GET['delId']) ){
		$delId = trim($admin->strip_all($_GET['delId']));
		$admin->deleteInstallationReport($delId);
		header('location: '.$pageURL.'?deletesuccess');
		exit;
	}			
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
	<meta name="description" content="">
	<meta name="keywords" content="">
	<meta name="author" content="">
	<meta name="robots" content="noindex, nofollow">
	<title><?php echo ADMIN_TITLE ?></title>

	<!-- Favicon -->
	<link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">

	<!-- Fontawesome CSS -->
	<link rel="stylesheet" href="assets/css/font-awesome.min.css">

	<!-- Lineawesome CSS -->
	<link rel="stylesheet" href="assets/css/line-awesome.min.css">

	<!-- Datatable CSS -->
	<link rel="stylesheet" href="assets/css/dataTables.bootstrap4.min.css">

	<!-- Select2 CSS -->
	<link rel="stylesheet" href="assets/css/select2.min.css">

	<!-- Datetimepicker CSS -->
	<link rel="stylesheet" href="assets/css/bootstrap-datetimepicker.min.css">

	<!-- Main CSS -->
	<link rel="stylesheet" href="assets/css/style.css">

	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->

</head>
<body>
	<!-- Main Wrapper -->
	<div class="main-wrapper">

		<!-- Header -->
		<?php include("include/header.php"); ?>
		<!-- /Header -->
		
		<!-- Sidebar -->
		<?php include("include/sidebar.php"); ?>
		<!-- /Sidebar -->
		
		<!-- Page Wrapper -->
		<div class="page-wrapper">
			
			<!-- Page Content -->
			<div class="content container-fluid">

				<!-- Page Header -->
				<div class="page-header">
					<div class="row align-items-center">
						<div class="col">
							<h3 class="page-title"><?php echo $pageName; ?></h3>
							<ul class="breadcrumb">
								<li class="breadcrumb-item"><a href="index.php">Home</a></li>
								<li class="breadcrumb-item active"><?php echo $pageName; ?></li>
							</ul>
						</div>
					</div>
				</div>
				<!-- /Page Header -->

				<?php if(isset($_GET['registersuccess'])){ ?>
					<div class="alert alert-success alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
						<i class="icon-checkmark3"></i> <?php echo $pageName; ?> successfully added.
					</div><br/>
				<?php } ?>

				<?php if(isset($_GET['registerfail'])){ ?>
					<div class="alert alert-danger alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
						<i class="icon-checkmark3"></i> <?php echo $pageName; ?> not added.
					</div><br/>
				<?php } ?>

				<?php if(isset($_GET['updatesuccess'])){ ?>
					<div class="alert alert-success alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
						<i class="icon-checkmark3"></i> <?php echo $pageName; ?> successfully updated.
					</div><br/>
				<?php } ?>

				<?php if(isset($_GET['updatefail'])){ ?>
					<div class="alert alert-danger alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
						<i class="icon-close"></i> <strong><?php echo $pageName; ?> not updated.</strong> <?php echo $admin->escape_string($admin->strip_all($_GET['msg'])); ?>.
					</div>
				<?php } ?>

				<?php if(isset($_GET['deletesuccess'])){ ?>
					<div class="alert alert-success alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
						<i class="icon-checkmark"></i> <?php echo $pageName; ?> successfully deleted.
					</div><br/>
				<?php } ?>
				<div class="row">
					<div class="col-md-12">
						<table class="table table-striped custom-table mb-0 datatable datatable-selectable-data">
							<thead>
								<tr>
									<th>#</th>
									<th>Name</th>
									<th>Last Name</th>
									<th>Mobile</th>
									<th>Email</th>
									<th>Country</th>
									<th>Address Site A</th>
									<th>Address Site B</th>
									<th>Lat Long A</th>
									<th>Lat Long B</th>
									<th>MAX EIRP</th>
									<th>Channel Bandwidth</th>
									<th>Channel Frequency</th>
									<th>Radio Site A</th>
									<th>Radio Site B</th>
									<th>Antenna Gain A</th>
									<th>Antenna Gain B</th>
									<th>Cable Loss A</th>
									<th>Cable Loss B</th>
									<th>Transmit Power A</th>
									<th>Transmit Power B</th>
									<th>Height A</th>
									<th>Height B</th>
									<th>Line of Sight</th>
									<th>Link Distance</th>
									<th>Fresnel Radius</th>
									<th>RSL A</th>
									<th>RSL B</th>
									<th>SNR A</th>
									<th>SNR B</th>
									<th>Throughput</th>
									<th>Link Reliability</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php
									$x = 1;
									while($row = $admin->fetch($results)){
								?>
										<tr>
											<td><?php echo $x++ ?></td>
											<td><?php echo $row['first_name']; ?></td>
											<td><?php echo $row['last_name']; ?></td>
											<td><?php echo $row['mobile']; ?></td>
											<td><?php echo $row['email']; ?></td>
											<td><?php echo $row['country']; ?></td>
											<td><?php echo $row['address_site_a']; ?></td>
											<td><?php echo $row['address_site_b']; ?></td>
											<td><?php echo $row['lat_long_site_a']; ?></td>
											<td><?php echo $row['lat_long_site_b']; ?></td>
											<td><?php echo $row['max_eirp']; ?></td>
											<td><?php echo $row['channel_bandwidth']; ?></td>
											<td><?php echo $row['channel_frequency']; ?></td>

											<td><?php echo $row['radio_site_a']; ?></td>
											<td><?php echo $row['radio_site_b']; ?></td>
											<td><?php echo $row['antenna_gain_a']; ?></td>
											<td><?php echo $row['antenna_gain_b']; ?></td>
											<td><?php echo $row['cable_loss_a']; ?></td>
											<td><?php echo $row['cable_loss_b']; ?></td>
											<td><?php echo $row['transmit_power_a']; ?></td>
											<td><?php echo $row['transmit_power_b']; ?></td>
											<td><?php echo $row['height_a']; ?></td>
											<td><?php echo $row['height_b']; ?></td>
											<td><?php echo $row['line_of_sight']; ?></td>
											<td><?php echo $row['link_distance']; ?></td>
											<td><?php echo $row['fresnel_radius']; ?></td>
											<td><?php echo $row['rsl_a']; ?></td>
											<td><?php echo $row['rsl_b']; ?></td>
											<td><?php echo $row['snr_a']; ?></td>
											<td><?php echo $row['snr_b']; ?></td>
											<td><?php echo $row['throughput']; ?></td>
											<td><?php echo $row['link_reliability']; ?></td>
											
											<td>
												<a class="btn-transition btn" href="<?php echo $deleteURL; ?>?delId=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to delete?');" title="Delete"> <i class="fa fa-trash-o"></i> </a>
											</td>
										</tr>
								<?php
									}
								?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<!-- /Page Content -->

		</div>
		<!-- /Page Wrapper -->

	</div>
	<!-- /Main Wrapper -->

	<!-- jQuery -->
	<script src="assets/js/jquery-3.2.1.min.js"></script>

	<!-- Bootstrap Core JS -->
	<script src="assets/js/popper.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>

	<!-- Slimscroll JS -->
	<script src="assets/js/jquery.slimscroll.min.js"></script>

	<!-- Select2 JS -->
	<script src="assets/js/select2.min.js"></script>

	<!-- Datetimepicker JS -->
	<script src="assets/js/moment.min.js"></script>
	<script src="assets/js/bootstrap-datetimepicker.min.js"></script>

	<!-- Datatable JS -->
	<script src="assets/js/jquery.dataTables.min.js"></script>
	<script src="assets/js/dataTables.bootstrap4.min.js"></script>
		<!-- Validate JS -->
	<script src="assets/js/jquery.validate.js"></script>
	<script src="assets/js/additional-methods.js"></script>

	<!-- Custom JS -->
	<script src="assets/js/app.js"></script>
</body>
</html>