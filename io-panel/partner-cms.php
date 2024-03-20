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

	$pageName = "Partner Page CMS";
	$pageURL = 'partner-cms.php';
	$tableName = 'partner_cms';

	$sql = "SELECT * FROM ".PREFIX.$tableName." ";
	$results = $admin->query($sql);
	$data = $admin->fetch($results);

	// if(isset($_POST['update'])) {
	// 	if($csrf->check_valid('post')) {
	// 		$result = $admin->updatePartnerCMS($_POST,$_FILES);
	// 		header("location:".$pageURL."?updatesuccess");
	// 		exit;
	// 	}
	// }
	
    if(isset($_POST['update'])) {
		if($csrf->check_valid('post')) {
			$result = $admin->updatePartnerCMS2($_POST,$_FILES);
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
									<h4 class="card-title mb-0"> Industry Banner Details</h4>
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
										<div class="col-sm-12">
											<label>Introduction <em>*</em></label>
											<textarea class="form-control" name="introduction" id="introduction"><?php echo $data['introduction']; ?></textarea>
										</div>
									</div>

									<div class="form-group row">
										<div class="col-sm-12">
											<label>Testimonial Title<em>*</em></label>
											<input type="text" class="form-control" name="testimonial_title" value="<?php echo $data['testimonial_title']; ?>" required>
										</div>
									</div>
									<div class="form-group row">
										<div class="col-sm-12">
											<label>Testimonial Description <em>*</em></label>
											<textarea class="form-control" name="testimonial_description" id="testimonial_description"><?php echo $data['testimonial_description']; ?></textarea>
										</div>
									</div>

									<div class="form-group row">
										<div class="col-sm-12">
											<label>Together We Can Description <em>*</em></label>
											<textarea class="form-control" name="togather_we_can" id="togather_we_can"><?php echo $data['togather_we_can']; ?></textarea>
										</div>
									</div>

									<div class="col-sm-4">
											<label>Channel Partner Section Image *</label>
											<input type="file" class="form-control file" name="channel_partner_image" id="channel_partner_image" data-image-index="0" />
											<span class="help-text">
												Files must be less than <strong>2 MB</strong>.<br>
												Allowed file types: <strong>png jpg jpeg</strong>.<br>
												Images must be exactly <strong>1920 x 306</strong> pixels.
											</span>
											<?php 
												if(!empty($data['channel_partner_image'])) {
													$file_name = str_replace('', '-', strtolower( pathinfo($data['channel_partner_image'], PATHINFO_FILENAME)));
													$ext = pathinfo($data['channel_partner_image'], PATHINFO_EXTENSION);
											?>
													<br><img src="../images/slider-banner/<?php echo $file_name.'_crop.'.$ext ?>" width="200"  />
											<?php
											} ?>
									</div>



									<div class="form-group row">
										<div class="col-sm-12">
											<label>Channel Partner Section Description<em>*</em></label>
											<textarea class="form-control" name="channel_partner_description" id="channel_partner_description"><?php echo $data['channel_partner_description']; ?></textarea>
										</div>
									</div>



									<div class="col-sm-4">
											<label>Partner with us banner image *</label>
											<input type="file" class="form-control file" name="partner_new_image" id="partner_new_image" data-image-index="0" />
											<span class="help-text">
												Files must be less than <strong>2 MB</strong>.<br>
												Allowed file types: <strong>png jpg jpeg</strong>.<br>
												Images must be exactly <strong>1920 x 306</strong> pixels.
											</span>
											<?php 
												if(!empty($data['partner_new_image'])) {
													$file_name = str_replace('', '-', strtolower( pathinfo($data['partner_new_image'], PATHINFO_FILENAME)));
													$ext = pathinfo($data['partner_new_image'], PATHINFO_EXTENSION);
											?>
													<br><img src="../images/slider-banner/<?php echo $file_name.'_crop.'.$ext ?>" width="200"  />
											<?php
											} ?>
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
		var editor = CKEDITOR.replace( 'introduction', {
			height: 300,
			filebrowserImageBrowseUrl : 'assets/js/editor/ckfinder/ckfinder.html?type=Images',
			filebrowserImageUploadUrl : 'assets/js/editor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
			toolbarGroups: [
				{"name":"document","groups":["mode"]},
				{"name":"basicstyles","groups":["basicstyles"]},
				{"name":"links","groups":["links"]},
				{"name":"paragraph","groups":["list"]},
				{"name":"insert","groups":["insert"]},
				{"name":"insert","groups":["insert"]},
				{"name":"styles","groups":["styles"]},
				{"name":"paragraph","groups":["align"]},
				{"name":"about","groups":["about"]},
				{"name":"colors","tems": [ 'TextColor', 'BGColor' ] },
			],
			removeButtons: 'Iframe,Flash,Strike,Smiley,Subscript,Superscript,Anchor,Specialchar'
		} );
		CKFinder.setupCKEditor( editor, '../' );
	</script>
	<script type="text/javascript">
		var editor = CKEDITOR.replace( 'togather_we_can', {
			height: 300,
			filebrowserImageBrowseUrl : 'assets/js/editor/ckfinder/ckfinder.html?type=Images',
			filebrowserImageUploadUrl : 'assets/js/editor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
			toolbarGroups: [
				{"name":"document","groups":["mode"]},
				{"name":"basicstyles","groups":["basicstyles"]},
				{"name":"links","groups":["links"]},
				{"name":"paragraph","groups":["list"]},
				{"name":"insert","groups":["insert"]},
				{"name":"insert","groups":["insert"]},
				{"name":"styles","groups":["styles"]},
				{"name":"paragraph","groups":["align"]},
				{"name":"about","groups":["about"]},
				{"name":"colors","tems": [ 'TextColor', 'BGColor' ] },
			],
			removeButtons: 'Iframe,Flash,Strike,Smiley,Subscript,Superscript,Anchor,Specialchar'
		} );
		CKFinder.setupCKEditor( editor, '../' );
	</script>

	<script type="text/javascript">
		var editor = CKEDITOR.replace( 'testimonial_description', {
			height: 200,
			filebrowserImageBrowseUrl : 'assets/js/editor/ckfinder/ckfinder.html?type=Images',
			filebrowserImageUploadUrl : 'assets/js/editor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
			toolbarGroups: [
				{"name":"document","groups":["mode"]},
				{"name":"basicstyles","groups":["basicstyles"]},
				{"name":"links","groups":["links"]},
				{"name":"paragraph","groups":["list"]},
				{"name":"insert","groups":["insert"]},
				{"name":"insert","groups":["insert"]},
				{"name":"styles","groups":["styles"]},
				{"name":"paragraph","groups":["align"]},
				{"name":"about","groups":["about"]},
				{"name":"colors","tems": [ 'TextColor', 'BGColor' ] },
			],
			removeButtons: 'Iframe,Flash,Strike,Smiley,Subscript,Superscript,Anchor,Specialchar'
		} );
		CKFinder.setupCKEditor( editor, '../' );
	</script>

<script type="text/javascript">
		var editor = CKEDITOR.replace( 'channel_partner_description', {
			height: 200,
			filebrowserImageBrowseUrl : 'assets/js/editor/ckfinder/ckfinder.html?type=Images',
			filebrowserImageUploadUrl : 'assets/js/editor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
			toolbarGroups: [
				{"name":"document","groups":["mode"]},
				{"name":"basicstyles","groups":["basicstyles"]},
				{"name":"links","groups":["links"]},
				{"name":"paragraph","groups":["list"]},
				{"name":"insert","groups":["insert"]},
				{"name":"insert","groups":["insert"]},
				{"name":"styles","groups":["styles"]},
				{"name":"paragraph","groups":["align"]},
				{"name":"about","groups":["about"]},
				{"name":"colors","tems": [ 'TextColor', 'BGColor' ] },
			],
			removeButtons: 'Iframe,Flash,Strike,Smiley,Subscript,Superscript,Anchor,Specialchar'
		} );
		CKFinder.setupCKEditor( editor, '../' );
	</script>



	<script type="text/javascript">
		$(document).ready(function() {
			$('input[name="image_name"]').change(function(){
				loadImagePreview(this, (1920 / 306));
			});

			$('input[name="partner_new_image"]').change(function(){
				loadImagePreview(this, (1920 / 1376));
			});
			$('input[name="channel_partner_image"]').change(function(){
				loadImagePreview(this, (1920 / 1376));
			});

			$("#form").validate({
				rules: {
					image_name: {
						extension: "jpg|jpeg|png"
					},
					title:{
						required:true,
						maxlength:50
					},
					description:{
						required:true,
						maxlength:85
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