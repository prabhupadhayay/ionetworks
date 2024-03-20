<?php

	include_once 'include/config.php';

	include_once 'include/admin-functions.php';

	$admin = new AdminFunctions();



	if(!$loggedInUserDetailsArr = $admin->sessionExists()){

		header("location: admin-login.php");

		exit();

	}



	$pageName = "Partnership Enquiry";

	$tableName = 'partnership_form_details';

	$deleteURL = 'partnership-enquiry.php';

	$pageURL = 'partnership-enquiry.php';



	$sql = "select * from ".PREFIX.$tableName." order by id DESC";

	$results = $admin->query($sql);



	if(isset($_GET['delId']) && !empty($_GET['delId']) ){

		$delId = trim($admin->strip_all($_GET['delId']));

		$admin->deletePartnershipEmquiry($delId);

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
	<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap4.min.css">
	<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.0.1/css/buttons.dataTables.min.css">

	<!-- Select2 CSS -->
	<link rel="stylesheet" href="assets/css/select2.min.css">

	<!-- Datetimepicker CSS -->
	<link rel="stylesheet" href="assets/css/bootstrap-datetimepicker.min.css">

	<!-- Main CSS -->
	<link rel="stylesheet" href="assets/css/style.css">


	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
			<script src="assets/js/html5shiv.min.js"></script>
			<script src="assets/js/respond.min.js"></script>
		<![endif]
	-->

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

						<table id="expExcel" class="table table-striped custom-table mb-0 datatable-selectable-data dt-responsive nowrap" style="width:100%;">

							<thead>



								<tr>

									<th data-priority="1">#</th>

									<th data-priority="2">User Email</th>

									<th data-priority="3">First Name</th>

									<th data-priority="4">Last Name</th>

									<th data-priority="5">Mobile No</th>

									<th data-priority="6">Email Id</th>

									<th data-priority="7">Designation</th>

									<th data-priority="8">Company Name</th>

									<th data-priority="9">Primary Vertical Market</th>

									<th>Primary Business</th>
									<th>Other Primary Business</th>

									<th>Company Nature</th>

									<th>Company Website</th>

									<th>Company Address</th>

									<th>City</th>

									<th>Zip</th>

									<th>State</th>

									<th>Country</th>

									<th>No of Employee</th>

									<th>Primary Customer</th>

									<th>Wireless Product</th>

									<th>Network Product</th>

									<th>Interested in Product</th>
									<th>Other Interested in Product</th>

									<th>How Know About Us</th>

									<th>Current Opportunity</th>

									<th>Date</th>

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

											<td><?php echo $row['email']; ?></td>

											<td><?php echo $row['personal_first_name']; ?></td>

											<td><?php echo $row['personal_last_name']; ?></td>

											<td><?php echo $row['personal_mobile_no']; ?></td>

											<td><?php echo $row['personal_email_id']; ?></td>

											<td><?php echo $row['personal_designation']; ?></td>

											<td><?php echo $row['company_name']; ?></td>

											<td><?php echo $row['primary_market']; ?></td>

											<td><?php echo $row['primary_business']; ?></td>
											<td><?php echo $row['other_primary_business']; ?></td>

											<td><?php echo $row['company_nature']; ?></td>

											<td><?php echo $row['company_website']; ?></td>

											<td><?php echo $row['company_address']; ?></td>

											<td><?php echo $row['city']; ?></td>

											<td><?php echo $row['zip']; ?></td>

											<td><?php echo $row['state']; ?></td>

											<td><?php echo $row['country']; ?></td>

											<td><?php echo $row['no_emp']; ?></td>

											<td><?php echo $row['prime_customer']; ?></td>

											<td><?php echo $row['wireless_product']; ?></td>

											<td><?php echo $row['network_product']; ?></td>

											<td><?php echo $row['product_in_interested']; ?></td>
											<td><?php echo $row['other_product_in_interested']; ?></td>

											<td><?php echo $row['how_know_about']; ?></td>

											<td><?php echo $row['current_oppo']; ?></td>

											<td><?php echo date('d F, Y G:ia', strtotime($row['created'])); ?></td>

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
	<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
	<script src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap4.min.js"></script>


	<script src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
	<script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.html5.min.js"></script>
	<script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.print.min.js"></script>
		<!-- Validate JS -->
	<script src="assets/js/jquery.validate.js"></script>
	<script src="assets/js/additional-methods.js"></script>

	<!-- Custom JS -->
	<script src="assets/js/app.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {
		    $('#expExcel').DataTable( {
		        dom: 'Bfrtip',
		        buttons: [
			     	{ extend: 'excel', text: 'Export to Excel',title: 'Partnership-Enquiries' }
			     ]

		    } );
		} );
	</script>

</body>

</html>