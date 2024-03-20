<?php
	include_once 'include/config.php';
	include_once 'include/admin-functions.php';
	$admin = new AdminFunctions();

	$pageName = "Empowering Industry";
	$parentPageURL = 'industry-empower-master.php';
	$pageURL = 'industry-empower-add.php';

	if(!$loggedInUserDetailsArr = $admin->sessionExists()){
		header("location: admin-login.php");
		exit();
	}

	include_once 'csrf.class.php';
	$csrf = new csrf();
	$token_id = $csrf->get_token_id();
	$token_value = $csrf->get_token($token_id);

	if(isset($_POST['register'])){
		if($csrf->check_valid('post')) {
			$result = $admin->addEmpower($_POST, $_FILES);
			header("location:".$parentPageURL."?registersuccess");
		}
	}

	if(isset($_GET['edit'])){
		$id = $admin->escape_string($admin->strip_all($_GET['id']));
		$data = $admin->getUniqueEmpowerById($id);
	}

	if(isset($_POST['id']) && !empty($_POST['id'])) {
		if($csrf->check_valid('post')) {
			$id = trim($admin->escape_string($admin->strip_all($_POST['id'])));
			$result = $admin->updateEmpower($_POST, $_FILES);
			header("location:".$pageURL."?updatesuccess&edit&id=".$id);
			exit();
		}
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
		<!--[if lt IE 9]>
			<script src="assets/js/html5shiv.min.js"></script>
			<script src="assets/js/respond.min.js"></script>
		<![endif]
	-->

	<!-- Crop Image css -->
	<link href="assets/css/crop-image/cropper.min.css" rel="stylesheet">

	<style>
		em{
			color:red;
		}
		.group{
			width:35px!important;
			height: 40px!important;
		}
	</style>
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
						<div class="col-auto float-right ml-auto">
							<a href="<?php echo $parentPageURL; ?>" class="btn add-btn"><i class="fa fa-arrow-left"></i> Back to <?php echo $pageName; ?></a>
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
						<form action="" id="form" method="post" enctype="multipart/form-data" autocomplete="off">
							<div class="card">
								<div class="card-header">
									<h4 class="card-title mb-0"> Empowering Industry Details</h4>
								</div>
								<div class="card-body">
									<div class="form-group row">
										<div class="col-md-4">
											<label>Industry<em>*</em></label>
											<select  required class="form-control select" name="industry1" id="industry1" required>
												<option value="">Select</option>
												<?php
													$query = $admin->query("select * from ".PREFIX."industry_master where active='1' order by name ASC");
													while($row = $admin->fetch($query)) {
												?>
														<option value="<?php echo $row['id']; ?>" <?php if(isset($_GET['edit']) && $row['id']==$data['industry1']){ echo "selected"; } ?> ><?php echo $row['name']; ?></option>
												<?php
													}
												?>
											</select>
										</div>
										<div class="col-sm-4">
											<label>Small Text 1<em>*</em></label>
											<textarea class="form-control" name="text1" required><?php if(isset($_GET['edit'])){ echo $data['text1']; } ?></textarea>
										</div>
										<div class="col-sm-4">
											<label>Small Image</label>
											<input type="file" class="form-control file" name="image1" id="" data-image-index="0" />
											<span class="help-text">
												Files must be less than <strong>2 MB</strong>.<br>
												Allowed file types: <strong>png</strong>.<br>
												Images must be exactly <strong>297 x 183</strong> pixels.
											</span>
											<?php 
												if(isset($_GET['edit']) && !empty($data['image1'])) {
													$file_name = str_replace('', '-', strtolower( pathinfo($data['image1'], PATHINFO_FILENAME)));
													$ext = pathinfo($data['image1'], PATHINFO_EXTENSION);
											?>
													<br><img src="../images/industry/<?php echo $file_name.'_crop.'.$ext ?>" width="200"  />
											<?php
											} ?>
										</div>
									</div>
									<hr>
									<div class="form-group row">
										<div class="col-md-4">
											<label>Industry<em>*</em></label>
											<select  required class="form-control select" name="industry2" id="industry2" required>
												<option value="">Select</option>
												<?php
													$query = $admin->query("select * from ".PREFIX."industry_master where active='1' order by name ASC");
													while($row = $admin->fetch($query)) {
												?>
														<option value="<?php echo $row['id']; ?>" <?php if(isset($_GET['edit']) && $row['id']==$data['industry2']){ echo "selected"; } ?> ><?php echo $row['name']; ?></option>
												<?php
													}
												?>
											</select>
										</div>
										<div class="col-sm-4">
											<label>Small Text 2<em>*</em></label>
											<textarea class="form-control" name="text2" required><?php if(isset($_GET['edit'])){ echo $data['text2']; } ?></textarea>
										</div>
										<div class="col-sm-4">
											<label>Small Image</label>
											<input type="file" class="form-control file" name="image2" id="" data-image-index="1" />
											<span class="help-text">
												Files must be less than <strong>2 MB</strong>.<br>
												Allowed file types: <strong>png</strong>.<br>
												Images must be exactly <strong>297 x 183</strong> pixels.
											</span>
											<?php 
												if(isset($_GET['edit']) && !empty($data['image2'])) {
													$file_name = str_replace('', '-', strtolower( pathinfo($data['image2'], PATHINFO_FILENAME)));
													$ext = pathinfo($data['image2'], PATHINFO_EXTENSION);
											?>
													<br><img src="../images/industry/<?php echo $file_name.'_crop.'.$ext ?>" width="200"  />
											<?php
											} ?>
										</div>
									</div>
									<hr>
									<div class="form-group row">
										<div class="col-md-4">
											<label>Industry<em>*</em></label>
											<select  required class="form-control select" name="industry3" id="industry3" required>
												<option value="">Select</option>
												<?php
													$query = $admin->query("select * from ".PREFIX."industry_master where active='1' order by name ASC");
													while($row = $admin->fetch($query)) {
												?>
														<option value="<?php echo $row['id']; ?>" <?php if(isset($_GET['edit']) && $row['id']==$data['industry3']){ echo "selected"; } ?> ><?php echo $row['name']; ?></option>
												<?php
													}
												?>
											</select>
										</div>
										<div class="col-sm-4">
											<label>Big Text 1<em>*</em></label>
											<textarea class="form-control" name="text3" required><?php if(isset($_GET['edit'])){ echo $data['text3']; } ?></textarea>
										</div>
										<div class="col-sm-4">
											<label>Big Image</label>
											<input type="file" class="form-control file" name="image3" id="" data-image-index="2" />
											<span class="help-text">
												Files must be less than <strong>2 MB</strong>.<br>
												Allowed file types: <strong>png</strong>.<br>
												Images must be exactly <strong>720 x 634</strong> pixels.
											</span>
											<?php 
												if(isset($_GET['edit']) && !empty($data['image3'])) {
													$file_name = str_replace('', '-', strtolower( pathinfo($data['image3'], PATHINFO_FILENAME)));
													$ext = pathinfo($data['image3'], PATHINFO_EXTENSION);
											?>
													<br><img src="../images/industry/<?php echo $file_name.'_crop.'.$ext ?>" width="200"  />
											<?php
											} ?>
										</div>
									</div>
									<div class="form-group row">
										<div class="col-sm-4">
											<label>Active</label>
											<select class="form-control" name="active">
												<option value="1" <?php if(isset($_GET['edit']) and $data['active']=='1') { echo 'selected'; } ?>>Yes</option>
												<option value="0" <?php if(isset($_GET['edit']) and $data['active']=='0') { echo 'selected'; } ?>>No</option>
											</select>
										</div>
									</div>
								</div>
							</div>
							<div class="form-actions text-right">
								<input type="hidden" name="<?php echo $token_id; ?>" value="<?php echo $token_value; ?>" />
								<?php if(isset($_GET['edit'])){ ?>
									<input type="hidden" class="form-control" name="id" id="id" value="<?php echo $id ?>"/>
									<button type="submit" name="update" value="update" id="update" class="btn btn-warning"><i class="icon-pencil"></i>Update <?php echo $pageName; ?></button>
								<?php } else { ?>
									<button type="submit" name="register" id="register" class="btn btn-danger"><i class="icon-signup"></i>Add <?php echo $pageName; ?></button>
								<?php } ?>
							</div>
						</form>
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

	<!-- Custom JS -->
	<script src="assets/js/app.js"></script>

	<!-- CK Editor -->
	<script type="text/javascript" src="assets/js/editor/ckeditor/ckeditor.js"></script>
	<script type="text/javascript" src="assets/js/editor/ckeditor/adapters/jquery.js"></script>
	<script type="text/javascript" src="assets/js/editor/ckfinder/ckfinder.js"></script>

	<!-- Validate JS -->
	<script src="assets/js/jquery.validate.js"></script>
	<script src="assets/js/additional-methods.js"></script>

	<!-- Crop Image js -->
	<script src="assets/js/crop-image/cropper.min.js"></script>
	<script src="assets/js/crop-image/image-crop-app.js"></script>

	<!-- Colorpicker JS -->
	<link href="assets/css/spectrum.min.css" rel="stylesheet">
	<script src="assets/js/spectrum.min.js"></script>

	<script type="text/javascript">
		$(document).ready(function() {
			$('input[name="image1"]').change(function(){
				loadImagePreview(this, (297 / 183));
			});

			$('input[name="image2"]').change(function(){
				loadImagePreview(this, (297 / 183));
			});

			$('input[name="image3"]').change(function(){
				loadImagePreview(this, (720 / 634));
			});


			$("#form").validate({
				ignore: [],
				rules: {	
					image1:{
						extension: "jpg|jpeg|png"
					},
					image2:{
						extension: "jpg|jpeg|png"
					},
					image3:{
						extension: "jpg|jpeg|png"
					},
					text1:{
						required:true,
						maxlength:130
					},
					text2:{
						required:true,
						maxlength:130
					},
					text3:{
						required:true,
						maxlength:190
					}
				},
				messages: {
					image1: {
						extension: "Please upload jpg or png image"
					},
					image2: {
						extension: "Please upload jpg or png image"
					},
					image3: {
						extension: "Please upload jpg or png image"
					}
				}
			});
			$.validator.addMethod('filesizevideo', function (value, element, param) {
				return this.optional(element) || (element.files[0].size <= param)
			}, 'File size must be less than 30 MB');
		});
	</script>
</body>
</html>