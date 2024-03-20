<?php
	include_once 'include/config.php';
	include_once 'include/admin-functions.php';
	$admin = new AdminFunctions();

	if(!$loggedInUserDetailsArr = $admin->sessionExists()){
		header("location: admin-login.php");
		exit();
	}

	include_once 'csrf.class.php';
	$csrf = new csrf();
	$token_id = $csrf->get_token_id();
	$token_value = $csrf->get_token($token_id);

	$pageName = "Category Page CMS";
	$pageURL = 'category-page-cms.php';
	$tableName = 'category_page_cms';

	$sql = "SELECT * FROM ".PREFIX.$tableName." ";
	$results = $admin->query($sql);
	$data = $admin->fetch($results);

	if(isset($_POST['update'])) {
		if($csrf->check_valid('post')) {
			$result = $admin->updateCategoryCMS($_POST,$_FILES);
			header("location:".$pageURL."?updatesuccess");
			exit;
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
									<h4 class="card-title mb-0"> Category Details</h4>
								</div>
								<div class="card-body">
									<div class="form-group row">
										<div class="col-sm-4">
											<label>Banner Image</label>
											<input type="file" class="form-control file" name="image_name" id="" data-image-index="0" />
											<span class="help-text">
												Files must be less than <strong>2 MB</strong>.<br>
												Allowed file types: <strong>png jpg jpeg</strong>.<br>
												Images must be exactly <strong>1920 x 306</strong> pixels.
											</span>
											<?php 
												if(!empty($data['image_name'])) {
													$file_name = str_replace('', '-', strtolower( pathinfo($data['image_name'], PATHINFO_FILENAME)));
													$ext = pathinfo($data['image_name'], PATHINFO_EXTENSION);
											?>
													<br><img src="../images/slider-banner/<?php echo $file_name.'_crop.'.$ext ?>" width="200"  />
											<?php
											} ?>
										</div>
										<div class="col-sm-4">
											<label>Banner Title<em>*</em></label>
											<input type="text" class="form-control" name="title" value="<?php echo $data['title']; ?>" required>
										</div>
										<div class="col-sm-4">
											<label>Banner Description<em>*</em></label>
											<textarea class="form-control" name="description" id="description" required><?php echo $data['description']; ?></textarea>
										</div>
									</div>

									<div class="form-group row">
										<div class="col-sm-4">
											<label>Page Title<em>*</em></label>
											<input type="text" class="form-control" name="page_title" value="<?php echo $data['page_title']; ?>" required>
										</div>
										<div class="col-sm-4">
											<label>Page Description<em>*</em></label>
											<textarea class="form-control" name="page_description" id="page_description" required><?php echo $data['page_description']; ?></textarea>
										</div>
									</div>

									<div class="form-group row">
										<div class="col-sm-4">
											<label>Page Image 1</label>
											<input type="file" class="form-control file" name="image1" id="" data-image-index="1" />
											<span class="help-text">
												Files must be less than <strong>2 MB</strong>.<br>
												Allowed file types: <strong>png</strong>.<br>
												Images must be exactly <strong>155 x 155</strong> pixels.
											</span>
											<?php 
												if(!empty($data['image1'])) {
													$file_name = str_replace('', '-', strtolower( pathinfo($data['image1'], PATHINFO_FILENAME)));
													$ext = pathinfo($data['image1'], PATHINFO_EXTENSION);
											?>
													<br><img src="../images/category/<?php echo $file_name.'_crop.'.$ext ?>" width="200"  />
											<?php
											} ?>
										</div>

										<div class="col-sm-4">
											<label>Page Image 1</label>
											<input type="file" class="form-control file" name="image2" id="" data-image-index="2" />
											<span class="help-text">
												Files must be less than <strong>2 MB</strong>.<br>
												Allowed file types: <strong>png</strong>.<br>
												Images must be exactly <strong>155 x 155</strong> pixels.
											</span>
											<?php 
												if(!empty($data['image2'])) {
													$file_name = str_replace('', '-', strtolower( pathinfo($data['image2'], PATHINFO_FILENAME)));
													$ext = pathinfo($data['image2'], PATHINFO_EXTENSION);
											?>
													<br><img src="../images/category/<?php echo $file_name.'_crop.'.$ext ?>" width="200"  />
											<?php
											} ?>
										</div>

										<div class="col-sm-4">
											<label>Page Image 1</label>
											<input type="file" class="form-control file" name="image3" id="" data-image-index="3" />
											<span class="help-text">
												Files must be less than <strong>2 MB</strong>.<br>
												Allowed file types: <strong>png</strong>.<br>
												Images must be exactly <strong>155 x 155</strong> pixels.
											</span>
											<?php 
												if(!empty($data['image3'])) {
													$file_name = str_replace('', '-', strtolower( pathinfo($data['image3'], PATHINFO_FILENAME)));
													$ext = pathinfo($data['image3'], PATHINFO_EXTENSION);
											?>
													<br><img src="../images/category/<?php echo $file_name.'_crop.'.$ext ?>" width="200"  />
											<?php
											} ?>
										</div>
									</div>
									<div class="form-group row">
										<div class="col-sm-4">
											<label>Title 1<em>*</em></label>
											<input type="text" class="form-control" name="title1" value="<?php echo $data['title1']; ?>" required>
										</div>
										<div class="col-sm-4">
											<label>Title 2<em>*</em></label>
											<input type="text" class="form-control" name="title2" value="<?php echo $data['title2']; ?>" required>
										</div>
										<div class="col-sm-4">
											<label>Title 3<em>*</em></label>
											<input type="text" class="form-control" name="title3" value="<?php echo $data['title3']; ?>" required>
										</div>
									</div>
								</div>
							</div>

							<div class="form-actions text-right">
								<input type="hidden" name="<?php echo $token_id; ?>" value="<?php echo $token_value; ?>" />
								<input type="hidden" class="form-control" name="id" id="" required="required" value="<?php echo $data['id'] ?>"/>
								<button type="submit" name="update" value="update" id="update" class="btn btn-warning"><i class="icon-pencil"></i>Update <?php echo $pageName; ?></button>
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
	<!-- Validate JS -->
	<script src="assets/js/jquery.validate.js"></script>
	<script src="assets/js/additional-methods.js"></script>

	<!-- CK Editor -->
	<script type="text/javascript" src="assets/js/editor/ckeditor/ckeditor.js"></script>
	<script type="text/javascript" src="assets/js/editor/ckeditor/adapters/jquery.js"></script>
	<script type="text/javascript" src="assets/js/editor/ckfinder/ckfinder.js"></script>
	<script src="assets/js/crop-image/cropper.min.js"></script>
	<script src="assets/js/crop-image/image-crop-app.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			$('input[name="image_name"]').change(function(){
				loadImagePreview(this, (1920 / 306));
			});

			$('input[name="image1"]').change(function(){
				loadImagePreview(this, (155 / 155));
			});

			$('input[name="image2"]').change(function(){
				loadImagePreview(this, (155 / 155));
			});

			$('input[name="image3"]').change(function(){
				loadImagePreview(this, (155 / 155));
			});

		
			$("#form").validate({
				rules: {
					image_name: {
						extension: "jpg|jpeg|png"
					},
					image1:{
						extension:"png"
					},
					image2:{
						extension:"png"
					},
					image3:{
						extension:"png"
					},
					title:{
						required:true,
						maxlength:70
					},
					description:{
						required:true,
						maxlength:100
					},
					page_title:{
						required:true,
						maxlength:100
					},
					page_description:{
						required:true,
						maxlength:200
					},
					title1:{
						required:true,
						maxlength:20
					},
					title2:{
						required:true,
						maxlength:20
					},
					title3:{
						required:true,
						maxlength:20
					}
				},
				messages: {
					image_name: {
						extension: "Please upload jpg or png image"
					}
				}
			});
		});
	</script>
</body>
</html>