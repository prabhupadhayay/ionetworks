<?php
	include_once 'include/config.php';
	include_once 'include/admin-functions.php';
	$admin = new AdminFunctions();

	if(!$loggedInUserDetailsArr = $admin->sessionExists()){
		header("location: admin-login.php");
		exit();
	}

	$pageName = "Brochure Enquiry";
	$pageURL = 'brochure-enquiry2022.php';
	$addURL = 'brochure-enquiry2022.php';
	$deleteURL = 'brochure-enquiry2022.php';
	$tableName = 'brochureware_external';

	$sql = "select * from ".PREFIX.$tableName." order by created DESC";
	$results = $admin->query($sql);
	
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
	<!-- Crop Image css -->
	<link href="assets/css/crop-image/cropper.min.css" rel="stylesheet">

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
				

				<div class="row">
					<div class="col-md-12">
						<table class="table table-striped custom-table mb-0 datatable datatable-selectable-data">
							<thead>
								<tr>
									<th>#</th>
									<th>Email</th>
									<th>Mobile</th>
									<th>Designation</th>
                                    <th>Selected PDFs </th>
                                    <th>Date</th>
								</tr>
							</thead>
							<tbody>
								<?php
									$x = 1;
									while($row = $admin->fetch($results)){
                                        // $pdfs = "";
                                        // foreach($row['selected_pdfs'] as $fruit) {
                                        //     $pdfs .= "https://io.hfcl.com/pdf/".$fruit."<br>";
                                        // }
								?>
										<tr>
											<td><?php echo $x++ ?></td>
											<td><?php echo $row['email']; ?></td>
											<td>
                                            <?php echo $row['mobile'] ?>
											</td>
											<td>
                                            <?php echo $row['designation'] ?>
											</td>
                                            <td>
                                            <?php 
                                            //$pdf = explode(",",$row['selected_pdfs']);
                                            $pdf = array_map('trim', explode(',', $row['selected_pdfs']));
                                            $pdfs = "";
                                            foreach($pdf as $fruit) {
                                            $pdfs .= "https://io.hfcl.com/pdf/".$fruit."<br>";
                                        }
                                             ?>
                                            <a target="_blank" href="<?php echo $pdfs; ?>"><?php echo $pdfs; ?></a>
											</td>
                                            <td>
                                            <?php echo $row['created'] ?>
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
	<!-- Crop Image js -->
	<script src="assets/js/crop-image/cropper.min.js"></script>
	<script src="assets/js/crop-image/image-crop-app.js"></script>

	<!-- Custom JS -->
	<script src="assets/js/app.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			$("#form").validate({
				rules: {
					banner_video:{
						extension: 'mp4'/*,
						filesize: 8000000*/
					},
					banner_image: {
						extension: 'png|jpg|jpeg',
						filesize: 5000000
					},
				},
				messages: {
					banner_video:{
						extension: "Please upload mp4 format file only."
					}
				}
			});
			$.validator.addMethod('filesize', function (value, element, param) {
				return this.optional(element) || (element.files[0].size <= param)
			}, 'File size must be less than 5 MB');

			$.validator.addMethod('bannerfilesize', function (value, element, param) {
				return this.optional(element) || (element.files[0].size <= param)
			}, 'File size must be less than 2 MB');



			$('input[name="banner_image"]').change(function(){
				loadImagePreview(this, (1920 / 860));
			});
		});
	</script>
</body>
</html>