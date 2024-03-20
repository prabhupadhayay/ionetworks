<?php
	include_once 'include/config.php';
	include_once 'include/admin-functions.php';
	$admin = new AdminFunctions();

	if(!$loggedInUserDetailsArr = $admin->sessionExists()){
		header("location: admin-login.php");
		exit();
	}

	$pageName = "Resource Request";
	$tableName = 'document_download_request';
	$deleteURL = 'download-resource-request.php';
	$pageURL = 'download-resource-request.php';

	$sql = "select * from ".PREFIX.$tableName." order by id DESC";
	$results = $admin->query($sql);

	if(isset($_GET['delId']) && !empty($_GET['delId']) ){
		$delId = trim($admin->strip_all($_GET['delId']));
		$admin->deleteResourceEmquiry($delId);
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
						<table id="expExcel" class="table table-striped custom-table mb-0 datatable-selectable-data" style="width:100%;">
							<thead>

								<tr>
									<th>#</th>
									<th>Action</th>
									<th>Product Namee</th>
									<th>First Name</th>
									<th>Last Name</th>
									<th>Mobile No</th>
									<th>Email Id</th>
									<th>Company Name</th>
									<th>Designation</th>
									<th>Country</th>
									<th>City</th>
									<th>#</th>
									<th>File Type</th>
									<th>Download Date Time</th>
								</tr>
							</thead>
							<tbody>
								<?php
									$x = 1;
									while($row = $admin->fetch($results)){
										$productDetails =  $admin->getUniqueProductById($row['product_id']);
								?>
										<tr>
											<td><?php echo $x; ?></td>
											<td>
												<a class="btn-transition btn" href="<?php echo $deleteURL; ?>?delId=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to delete?');" title="Delete"> <i class="fa fa-trash-o"></i> </a>
											</td>
											<td><?php echo $productDetails['product_name']; ?></td>
											<td><?php echo $row['first_name']; ?></td>
											<td><?php echo $row['last_name']; ?></td>
											<td><?php echo $row['mobile']; ?></td>
											<td><?php echo $row['email']; ?></td>
											<td><?php echo $row['company_name']; ?></td>
											<td><?php echo $row['designation']; ?></td>
											<td><?php echo $row['country']; ?></td>
											<td><?php echo $row['city']; ?></td>
											<?php
												$xx=1;
												$sql_sne = "select * from ".PREFIX."resource_download_history where request_id = '".$row['id']."' ";
					                            $results_sne = $admin->query($sql_sne);
					                            $sm=$admin->num_rows($results_sne);  
					                            if($sm=="0"){ 
					                        ?>
					                                  	<td></td>
					                                  	<td></td>
					                                  	<td></td>
					                               <?php  
					                            }
											 while($row_sne = $admin->fetch($results_sne)) 
                            {
                             if($xx=="1")
                             {
                              ?>
                              <td><?php echo $xx; ?></td>
                              <td><?php echo $row_sne['file_type']; ?></td>
                              <!-- <td><?php echo date('d F, Y G:ia', strtotime($row_sne['created'])); ?></td> -->
							  <td><?php echo $row['created'];  ?></td>
                        </tr>
                        <?php 
                     }
                     
                     else 
                     {
                        ?>
                        <tr>
                           <td style="background:#fdfdfd;text-align: left;">-<?php// echo $x.".".$xx; ?></td>
                           <td style="background:#fdfdfd;text-align: left;">-</td>
                           <td style="background:#fdfdfd;text-align: left;"></td>
                           <td style="background:#fdfdfd;text-align: left;">-</td>
                           <td style="background:#fdfdfd;text-align: left;">-</td>
                           <td style="background:#fdfdfd;text-align: left;">-</td>
                           <td style="background:#fdfdfd;text-align: left;"></td>
                           <td style="background:#fdfdfd;text-align: left;">-</td>
                           <td style="background:#fdfdfd;text-align: left;">-</td>
                           <td style="background:#fdfdfd;text-align: left;">-</td>
                           <td style="background:#fdfdfd;text-align: left;">-</td>
                           <td><?php echo $xx; ?></td>
                           <td><?php echo $row_sne['file_type']; ?></td>
                           <!-- <td><?php echo date('d F, Y G:ia', strtotime($row_sne['created'])); ?></td> -->
						   <td><?php echo $row['created'];  ?></td>
                              </tr>
                              <?php
                           }
                           $xx++;
                        }
                        ?>
											
										</tr>
								<?php
									$x++;
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
		         ordering: false,
     				sorting: false,
     				"scrollX": true,
		        buttons: [
			     	{ extend: 'excel', text: 'Export to Excel',title: 'Resource Download Requests' }
			     ]
		    } );
		} );
	</script>
</body>
</html>