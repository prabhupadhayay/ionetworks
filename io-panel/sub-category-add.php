<?php
	include_once 'include/config.php';
	include_once 'include/admin-functions.php';
	$admin = new AdminFunctions();

	$pageName = "Sub Category";
	$parentPageURL = 'sub-category-master.php';
	$pageURL = 'sub-category-add.php';

	if(!$loggedInUserDetailsArr = $admin->sessionExists()){
		header("location: admin-login.php");
		exit();
	}

	if(isset($_GET['cat_id']) && !empty($_GET['cat_id'])){
		$category_id = trim($admin->escape_string($admin->strip_all($_GET['cat_id'])));
	} else {
		header("location:category-master.php?INVALIDCAT");
		exit;
	}

	include_once 'csrf.class.php';
	$csrf = new csrf();
	$token_id = $csrf->get_token_id();
	$token_value = $csrf->get_token($token_id);

	if(isset($_POST['register'])){
		if($csrf->check_valid('post')) {
			$category_id = trim($admin->escape_string($admin->strip_all($_POST['category_id'])));
			$result = $admin->addSubCategory($_POST, $_FILES);
			header("location:".$pageURL."?registersuccess&cat_id=".$category_id);
			exit;
		}
	}

	if(isset($_GET['edit'])){
		$id = $admin->escape_string($admin->strip_all($_GET['id']));
		$data = $admin->getUniqueSubCategoryById($id);
	}

	if(isset($_POST['id']) && !empty($_POST['id'])) {
		if($csrf->check_valid('post')) {
			$id = trim($admin->escape_string($admin->strip_all($_POST['id'])));
			$category_id = trim($admin->escape_string($admin->strip_all($_POST['category_id'])));
			$result = $admin->updateSubCategory($_POST, $_FILES);
			header("location:".$pageURL."?updatesuccess&edit&id=".$id."&cat_id=".$_POST['category_id']);
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
	<link rel="stylesheet" href="assets/css/bootstrap-datepicker.min.css" rel="stylesheet">

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
								<li class="breadcrumb-item"><a href="<?php echo $parentPageURL.'?cat_id='.$category_id; ?>"><?php echo $pageName; ?></a></li>
								<li class="breadcrumb-item active">
									<?php if(isset($_GET['edit'])) {
										echo 'Edit '.$pageName;
									} else {
										echo 'Add New '.$pageName;
									}
									?>
								</li>
							</ul>
						</div>
						<div class="col-auto float-right ml-auto">
							<a href="<?php echo $parentPageURL.'?cat_id='.$category_id; ?>" class="btn add-btn"><i class="fa fa-arrow-left"></i> Back to <?php echo $pageName; ?></a>
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
				<div class="row">
					<div class="col-lg-12">
						<form action="" id="form" method="post" enctype="multipart/form-data" autocomplete="off">
							<div class="card">
								<div class="card-header">
									<h4 class="card-title mb-0"> Details</h4>
								</div>
								<div class="card-body">
									<div class="form-group row">
										<div class="col-md-4">
											<label>Sub Category Name <em>*</em></label>
											<input type="text" name="category_name" value="<?php if(isset($_GET['edit'])) { echo $data['category_name']; } ?>" class="form-control" required />
										</div>
										<div class="col-sm-4">
											<label>Active</label>
											<select class="form-control" name="active">
												<option value="1" <?php if(isset($_GET['edit']) and $data['active']=='1') { echo 'selected'; } ?>>Yes</option>
												<option value="0" <?php if(isset($_GET['edit']) and $data['active']=='0') { echo 'selected'; } ?>>No</option>
											</select>
										</div>
										<div class="col-md-4">
											<label>Display Order <em>*</em></label>
											<input type="text" name="display_order" value="<?php if(isset($_GET['edit'])) { echo $data['display_order']; } ?>" class="form-control" required />
										</div>
									</div>
									<hr>
									<div class="form-group row">
										<div class="col-sm-6">
											<label>Permalink<em>*</em></label>
											<input type="text" class="form-control" name="permalink" value="<?php if(isset($_GET['edit'])){ echo $data['permalink']; } ?>" required>
										</div>
									</div>
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
											<label>Page Description</label>
											<textarea class="form-control" name="page_description" id="page_description" required><?php echo $data['page_description']; ?></textarea>
										</div>
									</div>
                                    
									<div class="form-group row">
										<div class="col-sm-4">
											<label>Main Image</label>
											<input type="file" class="form-control file" name="main_image" id="" data-image-index="1" />
											<span class="help-text">
												Files must be less than <strong>2 MB</strong>.<br>
												Allowed file types: <strong>png</strong>.<br>
												Images must be exactly <strong>160 x 155</strong> pixels.
											</span>
											<?php 
												if(!empty($data['main_image'])) {
													$file_name = str_replace('', '-', strtolower( pathinfo($data['main_image'], PATHINFO_FILENAME)));
													$ext = pathinfo($data['main_image'], PATHINFO_EXTENSION);
											?>
													<br><img src="../images/category/<?php echo $file_name.'_crop.'.$ext ?>" width="200"  />
											<?php
											} ?>
										</div>

									<div class="form-group row">
										<div class="col-sm-4">
											<label>Page Image 1</label>
											<input type="file" class="form-control file" name="image1" id="" data-image-index="1" />
											<span class="help-text">
												Files must be less than <strong>2 MB</strong>.<br>
												Allowed file types: <strong>png</strong>.<br>
												Images must be exactly <strong>160 x 155</strong> pixels.
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
												Images must be exactly <strong>160 x 155</strong> pixels.
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
												Images must be exactly <strong>160 x 155</strong> pixels.
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
									<div class="form-group row">
										<div class="col-sm-4">
											<label>Title 1 Description <em>*</em></label>
											<textarea class="form-control" name="title1_description" id="title1_description" required><?php echo $data['title1_description']; ?></textarea>
										</div>
										<div class="col-sm-4">
											<label>Title 2 Description<em>*</em></label>
											<textarea class="form-control" name="title2_description" id="title2_description" required><?php echo $data['title2_description']; ?></textarea>
										</div>
										<div class="col-sm-4">
											<label>Title 3 Description<em>*</em></label>
											<textarea class="form-control" name="title3_description" id="title3_description" required><?php echo $data['title3_description']; ?></textarea>
										</div>
									</div>
									<hr>
									<div class="form-group row">
										<div class="col-sm-12">
											<label>Product Comparison</label>
											<textarea class="form-control" name="comparison" id="comparison"><?php if(isset($_GET['edit'])){ echo $data['comparison']; } ?></textarea>
										</div>
									</div>
									<!----new Product comparison area ----->
                                    <div class="form-group row">
										<div class="col-sm-12">
											<label>Product Comparison area 2</label>
											<textarea class="form-control" name="comparison_2" id="comparison_2"><?php if(isset($_GET['edit'])){ echo $data['comparison_2']; } ?></textarea>
										</div>
									</div>
                              <!----new Product comparison area ----->
                              <div class="form-group row">
										<div class="col-sm-12">
											<label>High Performance data area</label>
											<textarea class="form-control" name="high_performance_data" id="high_performance_data"><?php if(isset($_GET['edit'])){ echo $data['high_performance_data']; } ?></textarea>
										</div>
									</div>

									 <!----new Product comparison area ----->
									 <div class="form-group row">
										<div class="col-sm-12">
											<label>Wifi Standard Area</label>
											<textarea class="form-control" name="wifi_standard" id="wifi_standard"><?php if(isset($_GET['edit'])){ echo $data['wifi_standard']; } ?></textarea>
										</div>
									</div>

									 <!----new Product comparison area ----->
									 <div class="form-group row">
										<div class="col-sm-12">
											<label>Self_aps Area</label>
											<textarea class="form-control" name="self_aps" id="self_aps"><?php if(isset($_GET['edit'])){ echo $data['self_aps']; } ?></textarea>
										</div>
									</div>
									
                                   <!----new Product comparison area ----->
                              <div class="form-group row">
										<div class="col-sm-12">
											<label>Related Resources area</label>
											<textarea class="form-control" name="related_resource" id="related_resource"><?php if(isset($_GET['edit'])){ echo $data['related_resource']; } ?></textarea>
										</div>
									</div>



								</div>
							</div>
							<div class="form-actions text-right">
								<input type="hidden" name="category_id" value="<?php echo $category_id; ?>" />
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

	<!-- Custom JS -->
	<script src="assets/js/app.js"></script>

	<!-- Validate JS -->
	<script src="assets/js/jquery.validate.js"></script>
	<script src="assets/js/additional-methods.js"></script>
	<script src="assets/js/crop-image/cropper.min.js"></script>
	<script src="assets/js/crop-image/image-crop-app.js"></script>
	<!-- CK Editor -->
	<script type="text/javascript" src="assets/js/editor/ckeditor/ckeditor.js"></script>
	<script type="text/javascript" src="assets/js/editor/ckeditor/adapters/jquery.js"></script>
	<script type="text/javascript" src="assets/js/editor/ckfinder/ckfinder.js"></script>
	<script type="text/javascript">
		var editor = CKEDITOR.replace( 'comparison', {
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
		var editor = CKEDITOR.replace( 'comparison_2', {
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
		var editor = CKEDITOR.replace( 'wifi_standard', {
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
		var editor = CKEDITOR.replace( 'self_aps', {
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
		var editor = CKEDITOR.replace( 'high_performance_data', {
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
		var editor = CKEDITOR.replace( 'related_resource', {
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

			$('input[name="image_name"]').change(function(){
				loadImagePreview(this, (1920 / 306));
			});

			$('input[name="main_image"]').change(function(){
				loadImagePreview(this, (1920 / 306));
			});

			$('input[name="image1"]').change(function(){
				loadImagePreview(this, (160 / 155));
			});

			$('input[name="image2"]').change(function(){
				loadImagePreview(this, (160 / 155));
			});

			$('input[name="image3"]').change(function(){
				loadImagePreview(this, (160 / 155));
			});

			$("#form").validate({
				ignore: [],
				debug: false,
				rules: {
					category_name:{
						required:true
					},
					permalink:{
						required:true,
						lettersonly:true,
						remote:{
                           url:"check-sub-category-name.php",
                           type: "post",
                           	<?php if(isset($_GET['edit'])){ ?>
	                           data: {
	                              id: function() {
	                                 return $( "#id" ).val();
	                              }
	                           }
	                        <?php } ?>
                        }
					},
					image_name: {
						extension: "jpg|jpeg|png"
					},
					main_image: {
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
					display_order:{
						required:true,
						number:true,
						min:1
					},
					title:{
						required:true,
						maxlength:70
					},
					description:{
						required:true,
						maxlength:250
					},
					page_title:{
						required:true,
						maxlength:100
					},
					page_description:{
						required:false,
						maxlength:200
					},
					title1:{
						required:true,
						maxlength:80
					},
					title2:{
						required:true,
						maxlength:80
					},
					title3:{
						required:true,
						maxlength:80
					}
				},
				messages: {
					image_name:{
						extension:"Please upload png/jpeg/jpg image only."
					},
					main_image:{
						extension:"Please upload png/jpeg/jpg image only."
					},
					image1:{
						extension:"Please upload png image only."
					},
					image2:{
						extension:"Please upload png image only."
					},
					image3:{
						extension:"Please upload png image only."
					},
					permalink:{
						remote:"URL already exists."
					}
				}
			});
			$.validator.addMethod("lettersonly", function(value, element) {
                return this.optional(element) || /^[a-zA-Z0-9\-]*$/.test(value);
            }, "Please enter character/number or - only");

			$.validator.addMethod('filesize', function (value, element, param) {
				return this.optional(element) || (element.files[0].size <= param)
			}, 'File size must be less than 2 MB');

		});
	</script>
</body>
</html>