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

	$pageName = "About Us CMS";
	$pageURL = 'about-us-cms.php';
	$tableName = 'about_cms';
	$deleteURL = 'about-us-cms.php';
	$addURL = 'testimonial-add.php';

	$sql = "SELECT * FROM ".PREFIX.$tableName." ";
	$results = $admin->query($sql);
	$data = $admin->fetch($results);

	if(isset($_POST['update'])) {
		if($csrf->check_valid('post')) {
			//update to database
			$result = $admin->updateAboutCMS($_POST, $_FILES);
			header("location:".$pageURL."?updatesuccess");
			exit;
		}
	}

	if(isset($_GET['delId']) && !empty($_GET['delId']) ){
		$delId = trim($admin->strip_all($_GET['delId']));
		$admin->deleteTestimonial($delId);
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
									<h4 class="card-title mb-0"> About Us Page Details</h4>
								</div>
								<div class="card-body">
									<div class="form-group row">
										<div class="col-sm-4">
											<label>Banner Image</label>
											<input type="file" class="form-control file" name="banner_image" id="" data-image-index="0" />
											<span class="help-text">
												Files must be less than <strong>2 MB</strong>.<br>
												Allowed file types: <strong>png jpg jpeg</strong>.<br>
												Images must be exactly <strong>1920 x 306</strong> pixels.
											</span>
											<?php 
												if(!empty($data['banner_image'])) {
													$file_name = str_replace('', '-', strtolower( pathinfo($data['banner_image'], PATHINFO_FILENAME)));
													$ext = pathinfo($data['banner_image'], PATHINFO_EXTENSION);
											?>
													<br><img src="../images/about-us/<?php echo $file_name.'_crop.'.$ext ?>" width="200"  />
											<?php
											} ?>
										</div>
										<div class="col-sm-4">
											<label>Banner Title<em>*</em></label>
											<input type="text" class="form-control" name="banner_title" value="<?php echo $data['banner_title'] ?>" required>
										</div>

										<div class="col-sm-4">
											<label>Banner Description<em>*</em></label>
											<textarea class="form-control" name="banner_description" required><?php echo $data['banner_description'] ?></textarea>
										</div>
									</div>
									<hr>
									<div class="form-group row">
										<div class="col-sm-4">
											<label>Image </label>
											<input type="file" class="form-control file" name="image_name" id="" data-image-index="1" />
											<span class="help-text">
												Files must be less than <strong>2 MB</strong>.<br>
												Allowed file types: <strong>png jpg jpeg</strong>.<br>
												Images must be exactly <strong>646 x 564</strong> pixels.
											</span>
											<?php 
												if(!empty($data['image_name'])) {
													$file_name = str_replace('', '-', strtolower( pathinfo($data['image_name'], PATHINFO_FILENAME)));
													$ext = pathinfo($data['image_name'], PATHINFO_EXTENSION);
											?>
													<br><img src="../images/about-us/<?php echo $file_name.'_crop.'.$ext ?>" width="100"  />
											<?php
											} ?>
										</div>

										<div class="col-sm-8">
											<label>Description<em>*</em></label>
											<textarea class="form-control" name="description" id="description" required><?php echo $data['description'] ?></textarea>
										</div>
									</div>
									<hr>

									<div class="form-group row">
										<div class="col-sm-4">
											<label>Image 2 </label>
											<input type="file" class="form-control file" name="mid_image" id="" data-image-index="2" />
											<span class="help-text">
												Files must be less than <strong>2 MB</strong>.<br>
												Allowed file types: <strong>png jpg jpeg</strong>.<br>
												Images must be exactly <strong>1922 x 437</strong> pixels.
											</span>
											<?php 
												if(!empty($data['mid_image'])) {
													$file_name = str_replace('', '-', strtolower( pathinfo($data['mid_image'], PATHINFO_FILENAME)));
													$ext = pathinfo($data['mid_image'], PATHINFO_EXTENSION);
											?>
													<br><img src="../images/about-us/<?php echo $file_name.'_crop.'.$ext ?>" width="100"  />
											<?php
											} ?>
										</div>
									</div>
									<hr>

									<div class="form-group row">
										<div class="col-sm-4">
											<label>Image </label>
											<input type="file" class="form-control file" name="image_name1" id="" data-image-index="3" />
											<span class="help-text">
												Files must be less than <strong>2 MB</strong>.<br>
												Allowed file types: <strong>png jpg jpeg</strong>.<br>
												Images must be exactly <strong>419 x 425</strong> pixels.
											</span>
											<?php 
												if(!empty($data['image_name1'])) {
													$file_name = str_replace('', '-', strtolower( pathinfo($data['image_name1'], PATHINFO_FILENAME)));
													$ext = pathinfo($data['image_name1'], PATHINFO_EXTENSION);
											?>
													<br><img src="../images/about-us/<?php echo $file_name.'_crop.'.$ext ?>" width="100"  />
											<?php
											} ?>
										</div>

										<div class="col-sm-8">
											<label>Description<em>*</em></label>
											<textarea class="form-control" name="description1" id="description1" required><?php echo $data['description1'] ?></textarea>
										</div>
									</div>
									<hr>
									<div class="form-group row">
										<div class="col-sm-4">
											<label>Image </label>
											<input type="file" class="form-control file" name="image_name2" id="" data-image-index="4" />
											<span class="help-text">
												Files must be less than <strong>2 MB</strong>.<br>
												Allowed file types: <strong>png jpg jpeg</strong>.<br>
												Images must be exactly <strong>384 x 450</strong> pixels.
											</span>
											<?php 
												if(!empty($data['image_name2'])) {
													$file_name = str_replace('', '-', strtolower( pathinfo($data['image_name2'], PATHINFO_FILENAME)));
													$ext = pathinfo($data['image_name2'], PATHINFO_EXTENSION);
											?>
													<br><img src="../images/about-us/<?php echo $file_name.'_crop.'.$ext ?>" width="100"  />
											<?php
											} ?>
										</div>

										<div class="col-sm-8">
											<label>Description<em>*</em></label>
											<textarea class="form-control" name="description2" id="description2" required><?php echo $data['description2'] ?></textarea>
										</div>
									</div>

									<hr>
									<div class="form-group row">
										<div class="col-sm-4">
											<label>Corporate Video</label>
											<input type="file" class="form-control" name="corporate_video">
											<span class="help-block" id="dim">(Size: MAX 30 MB/ MP4 Only`)</span>
											<?php 
												if(!empty($data['corporate_video'])) {
											?>
											<br><br>
											<a target="_blank" href="<?php echo BASE_URL; ?>/images/videos/<?php echo $data['corporate_video']; ?>">View Video</a><br>
											<?php
												} 
											?>
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


							<div class="card">
								<div class="card-header">
									<h4 class="card-title mb-0"> Testimonials </h4>
								</div>

								<div class="card-body">
									<div class="form-group row">
										<div class="col-sm-12">
											<div class="col-auto float-right ml-auto">
												<a href="<?php echo $addURL; ?>" class="btn add-btn"><i class="fa fa-plus"></i> Add Testimonial</a>
											</div>
										</div>
									</div>

									
									<div class="form-group row">
										<div class="col-md-12">
											<table class="table table-striped custom-table mb-0 datatable datatable-selectable-data">
												<thead>
													<tr>
														<th>#</th>
														<th>Image</th>
														<th>Name</th>
														<th>Designation</th>
														<th>Active</th>
														<th>Action</th>
													</tr>
												</thead>
												<tbody>
													<?php
														$testimonialSql = "select * from ".PREFIX."testimonial_master ";
														$testimonialResult = $admin->query($testimonialSql);
														$x = 1;
														while($testiminialDetails = $admin->fetch($testimonialResult)){
															$file_name = str_replace('', '-', strtolower( pathinfo($testiminialDetails['image_name'], PATHINFO_FILENAME)));
															$ext = pathinfo($testiminialDetails['image_name'], PATHINFO_EXTENSION);
															$url =  BASE_URL."/images/testimonial/".$file_name.'_crop.'.$ext;
													?>
															<tr>
																<td><?php echo $x++ ?></td>
																<td><img width="100" src="<?php echo $url; ?>"  /></td>
																<td><?php echo $testiminialDetails['name']; ?></td>
																<td><?php echo $testiminialDetails['designation']; ?></td>
																<td>
																	<?php if($testiminialDetails['active']==1) { echo "Active";  } else{ echo "InActive"; } ?>
																</td>
																<td>
																	<a class="btn-transition btn" href="<?php echo $addURL; ?>?edit&id=<?php echo $testiminialDetails['id']; ?>" title="Edit">   <i class="fa fa-pencil"></i> </a>
																	<a class="btn-transition btn" href="<?php echo $deleteURL; ?>?delId=<?php echo $testiminialDetails['id']; ?>" onclick="return confirm('Are you sure you want to delete?');" title="Delete"> <i class="fa fa-trash-o"></i> </a>
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
							</div>
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
		var editor = CKEDITOR.replace( 'description', {
			height: 300,
			filebrowserImageBrowseUrl : 'assets/js/editor/ckfinder/ckfinder.html?type=Images',
			filebrowserImageUploadUrl : 'assets/js/editor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
			toolbarGroups: [
				{"name":"document","groups":["mode"]},
				{"name":"clipboard","groups":["undo"]},
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
		var editor = CKEDITOR.replace( 'description1', {
			height: 300,
			filebrowserImageBrowseUrl : 'assets/js/editor/ckfinder/ckfinder.html?type=Images',
			filebrowserImageUploadUrl : 'assets/js/editor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
			toolbarGroups: [
				{"name":"document","groups":["mode"]},
				{"name":"clipboard","groups":["undo"]},
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
		var editor = CKEDITOR.replace( 'description2', {
			height: 300,
			filebrowserImageBrowseUrl : 'assets/js/editor/ckfinder/ckfinder.html?type=Images',
			filebrowserImageUploadUrl : 'assets/js/editor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
			toolbarGroups: [
				{"name":"document","groups":["mode"]},
				{"name":"clipboard","groups":["undo"]},
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
			$('input[name="banner_image"]').change(function(){
				loadImagePreview(this, (1920 / 306));
			});

			$('input[name="image_name"]').change(function(){
				loadImagePreview(this, (646 / 564));
			});

			$('input[name="mid_image"]').change(function(){
				loadImagePreview(this, (1922 / 437));
			});

			$('input[name="image_name1"]').change(function(){
				loadImagePreview(this, (419 / 425));
			});

			$('input[name="image_name2"]').change(function(){
				loadImagePreview(this, (384 / 450));
			});


			$("#form").validate({
				ignore: [],
				rules: {	
					banner_image:{
						extension: "jpg|jpeg|png"
					},
					banner_title:{
						required:true,
						maxlength:50
					},
					banner_description:{
						required:true,
						maxlength:110
					},
					image_name:{
						extension: "jpg|jpeg|png"
					},
					description:{
						required:true
					},
					mid_image:{
						extension: "jpg|jpeg|png"
					},
					image_name1:{
						extension: "jpg|jpeg|png"
					},
					image_name2:{
						extension: "jpg|jpeg|png"
					},
					corporate_video:{
						extension: 'mp4',
						filesizevideo: 30000000
					}
				},
				messages: {
					corporate_video: {
						extension: "Please upload mp4 video only."
					},
					home_icon1: {
						extension: "Please upload jpg or png image"
					},
					home_icon2: {
						extension: "Please upload jpg or png image"
					},
					background_image: {
						extension: "Please upload jpg or png image"
					},
					right_leaf: {
						extension: "Please upload jpg or png image"
					},
					left_leaf: {
						extension: "Please upload jpg or png image"
					},
					big_image: {
						extension: "Please upload png image"
					},
					bottom_image: {
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