<?php
	include_once 'include/config.php';
	include_once 'include/admin-functions.php';
	$admin = new AdminFunctions();

	$pageName = "New Category";
	$parentPageURL = 'category-masternew.php';
	$pageURL = 'category-add-new.php';

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
			$result = $admin->addCategory($_POST, $_FILES);
			header("location:".$parentPageURL."?registersuccess");
		}
	}

	if(isset($_GET['edit'])){
		$id = $admin->escape_string($admin->strip_all($_GET['id']));
		$data = $admin->getUniqueCategoryById($id);
	}

	if(isset($_POST['id']) && !empty($_POST['id'])) {
		if($csrf->check_valid('post')) {
			$id = trim($admin->escape_string($admin->strip_all($_POST['id'])));
			$result = $admin->updateCategory($_POST, $_FILES);
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
								<li class="breadcrumb-item"><a href="<?php echo $parentPageURL; ?>"><?php echo $pageName; ?></a></li>
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
											<label>Category Name <em>*</em></label>
											<input type="text" name="category_name" value="<?php if(isset($_GET['edit'])) { echo $data['category_name']; } ?>" class="form-control" required />
										</div>
										<div class="col-sm-4">
											<label>Image </label>
											<input type="file" class="form-control" name="image_name" data-image-index="0" />
											<span class="help-text">
												Files must be less than <strong>2 MB</strong>.<br>
												Allowed file types: <strong>png</strong>.<br>
												Images must be exactly <strong>39x36</strong> pixels.
											</span>
											<br>
											<?php if(isset($_GET['edit']) and !empty($data['image_name'])) {
												$file_name = str_replace('', '-', strtolower( pathinfo($data['image_name'], PATHINFO_FILENAME)));
												$ext = pathinfo($data['image_name'], PATHINFO_EXTENSION);
											?>
													<img src="../images/category/<?php echo $file_name.'_crop.'.$ext ?>" width="100"  />
											<?php
												}
											?>
										</div>
										<div class="col-sm-4">
											<label>Active</label>
											<select class="form-control" name="active">
												<option value="1" <?php if(isset($_GET['edit']) and $data['active']=='1') { echo 'selected'; } ?>>Yes</option>
												<option value="0" <?php if(isset($_GET['edit']) and $data['active']=='0') { echo 'selected'; } ?>>No</option>
											</select>
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
										<div class="col-md-4">
											<label>Show Tab on Home Page</label>
											<select class="form-control" name="show_tab">
												<option value="0" <?php if(isset($_GET['edit']) and $data['show_tab']=='0') { echo 'selected'; } ?>>No</option>
												<option value="1" <?php if(isset($_GET['edit']) and $data['show_tab']=='1') { echo 'selected'; } ?>>Yes</option>
											</select>
										</div>
									</div>
                                    <div class="form-group row">
										<div class="col-sm-6">
											<label>Main title<em>*</em></label>
											<input type="text" class="form-control" name="main_title" value="<?php if(isset($_GET['edit'])){ echo $data['main_title']; } ?>" required>
										</div>
									</div>
                                    <div class="form-group row">
										<div class="col-sm-6">
											<label>Main sub title<em>*</em></label>
											<input type="text" class="form-control" name="main_sub_title" value="<?php if(isset($_GET['edit'])){ echo $data['main_sub_title']; } ?>" required>
										</div>
									</div>
                                    <div class="col-sm-4">
											<label>Hero Image1 </label>
											<input type="file" class="form-control" name="hero_image1" data-image-index="0" />
											<span class="help-text">
												Files must be less than <strong>2 MB</strong>.<br>
												Allowed file types: <strong>png</strong>.<br>
												Images must be exactly <strong>39x36</strong> pixels.
											</span>
											<br>
											<?php if(isset($_GET['edit']) and !empty($data['hero_image1'])) {
												$file_name = str_replace('', '-', strtolower( pathinfo($data['hero_image1'], PATHINFO_FILENAME)));
												$ext = pathinfo($data['hero_image1'], PATHINFO_EXTENSION);
											?>
													<img src="../images/category/<?php echo $file_name.'_crop.'.$ext ?>" width="100"  />
											<?php
												}
											?>
										</div>
                                    <div class="form-group row">
										<div class="col-sm-6">
											<label>hero_title1<em>*</em></label>
											<input type="text" class="form-control" name="hero_title1" value="<?php if(isset($_GET['edit'])){ echo $data['hero_title1']; } ?>" required>
										</div>
									</div>
                                    <div class="form-group row">
										<div class="col-sm-6">
											<label>hero_description1<em>*</em></label>
											<input type="text" class="form-control" name="hero_description1" value="<?php if(isset($_GET['edit'])){ echo $data['hero_description1']; } ?>" required>
										</div>
									</div>

                                    <div class="col-sm-4">
											<label>Hero Image2 </label>
											<input type="file" class="form-control" name="hero_image2" data-image-index="0" />
											<span class="help-text">
												Files must be less than <strong>2 MB</strong>.<br>
												Allowed file types: <strong>png</strong>.<br>
												Images must be exactly <strong>39x36</strong> pixels.
											</span>
											<br>
											<?php if(isset($_GET['edit']) and !empty($data['hero_image2'])) {
												$file_name = str_replace('', '-', strtolower( pathinfo($data['hero_image2'], PATHINFO_FILENAME)));
												$ext = pathinfo($data['hero_image2'], PATHINFO_EXTENSION);
											?>
													<img src="../images/category/<?php echo $file_name.'_crop.'.$ext ?>" width="100"  />
											<?php
												}
											?>
									</div>

                                    <div class="form-group row">
										<div class="col-sm-6">
											<label>hero_title2<em>*</em></label>
											<input type="text" class="form-control" name="hero_title2" value="<?php if(isset($_GET['edit'])){ echo $data['hero_title2']; } ?>" required>
										</div>
									</div>
                                    <div class="form-group row">
										<div class="col-sm-6">
											<label>hero_description2<em>*</em></label>
											<input type="text" class="form-control" name="hero_description2" value="<?php if(isset($_GET['edit'])){ echo $data['hero_description2']; } ?>" required>
										</div>
									</div>
                                     
                                    <div class="col-sm-4">
											<label>Hero Image3 </label>
											<input type="file" class="form-control" name="hero_image3" data-image-index="0" />
											<span class="help-text">
												Files must be less than <strong>2 MB</strong>.<br>
												Allowed file types: <strong>png</strong>.<br>
												Images must be exactly <strong>39x36</strong> pixels.
											</span>
											<br>
											<?php if(isset($_GET['edit']) and !empty($data['hero_image3'])) {
												$file_name = str_replace('', '-', strtolower( pathinfo($data['hero_image3'], PATHINFO_FILENAME)));
												$ext = pathinfo($data['hero_image3'], PATHINFO_EXTENSION);
											?>
													<img src="../images/category/<?php echo $file_name.'_crop.'.$ext ?>" width="100"  />
											<?php
												}
											?>
									</div>

                                    <div class="form-group row">
										<div class="col-sm-6">
											<label>Hero title3<em>*</em></label>
											<input type="text" class="form-control" name="hero_title3" value="<?php if(isset($_GET['edit'])){ echo $data['hero_title3']; } ?>" required>
										</div>
									</div>
                                    <div class="form-group row">
										<div class="col-sm-6">
											<label>Hero description3<em>*</em></label>
											<input type="text" class="form-control" name="hero_description3" value="<?php if(isset($_GET['edit'])){ echo $data['hero_description3']; } ?>" required>
										</div>
									</div>


                                    <div class="col-sm-4">
											<label>Lower_bg_Image </label>
											<input type="file" class="form-control" name="lower_bg_image" data-image-index="0" />
											<span class="help-text">
												Files must be less than <strong>2 MB</strong>.<br>
												Allowed file types: <strong>png</strong>.<br>
												Images must be exactly <strong>39x36</strong> pixels.
											</span>
											<br>
											<?php if(isset($_GET['edit']) and !empty($data['lower_bg_image'])) {
												$file_name = str_replace('', '-', strtolower( pathinfo($data['lower_bg_image'], PATHINFO_FILENAME)));
												$ext = pathinfo($data['lower_bg_image'], PATHINFO_EXTENSION);
											?>
													<img src="../images/category/<?php echo $file_name.'_crop.'.$ext ?>" width="100"  />
											<?php
												}
											?>
									</div>

                                    <div class="form-group row">
										<div class="col-sm-6">
											<label>lower_bg_title<em>*</em></label>
											<input type="text" class="form-control" name="lower_bg_title" value="<?php if(isset($_GET['edit'])){ echo $data['lower_bg_title']; } ?>" required>
										</div>
									</div>
                                    <div class="form-group row">
										<div class="col-sm-6">
											<label>lower_bg_description<em>*</em></label>
											<input type="text" class="form-control" name="lower_bg_description" value="<?php if(isset($_GET['edit'])){ echo $data['lower_bg_description']; } ?>" required>
										</div>
									</div>
                                    <div class="form-group row">
										<div class="col-sm-6">
											<label>Lower_bg_URL<em>*</em></label>
											<input type="text" class="form-control" name="lower_url" value="<?php if(isset($_GET['edit'])){ echo $data['lower_url']; } ?>" required>
										</div>
									</div>
                                

                                    <div class="form-group row">
										<div class="col-sm-6">
											<label>cloud title<em>*</em></label>
											<input type="text" class="form-control" name="cloud_title" value="<?php if(isset($_GET['edit'])){ echo $data['cloud_title']; } ?>" required>
										</div>
									</div>
                                    <div class="form-group row">
										<div class="col-sm-6">
											<label>cloud description<em>*</em></label>
											<input type="text" class="form-control" name="cloud_description" value="<?php if(isset($_GET['edit'])){ echo $data['cloud_description']; } ?>" required>
										</div>
									</div>
                                    <div class="form-group row">
										<div class="col-sm-6">
											<label>cloud url<em>*</em></label>
											<input type="text" class="form-control" name="cloud_url" value="<?php if(isset($_GET['edit'])){ echo $data['cloud_url']; } ?>" required>
										</div>
									</div>
                                   
                                    <hr>
									<div class="form-group row">
										<div class="col-sm-12">
											<label>High aps area<em>*</em></label>
											<textarea class="form-control" name="high_aps_area" id="high_aps_area" required><?php if(isset($_GET['edit'])){ echo $data['high_aps_area']; } ?></textarea>
										</div>
									</div>
									<hr>
                                    <hr>
									<div class="form-group row">
										<div class="col-sm-12">
											<label>Related resources area<em>*</em></label>
											<textarea class="form-control" name="related_resources_area" id="related_resources_area" required><?php if(isset($_GET['edit'])){ echo $data['related_resources_area']; } ?></textarea>
										</div>
									</div>
									<hr>

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

	<!-- Custom JS -->
	<script src="assets/js/app.js"></script>

	<!-- Validate JS -->
	<script src="assets/js/jquery.validate.js"></script>
	<script src="assets/js/additional-methods.js"></script>

	<!-- Crop Image js -->
	<script src="assets/js/crop-image/cropper.min.js"></script>
	<script src="assets/js/crop-image/image-crop-app.js"></script>

	<script type="text/javascript">
		$(document).ready(function() {
			$('input[name="image_name"]').change(function(){
				loadImagePreview(this, (39 / 36));
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
                           url:"ajax-check-category-name.php",
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
						extension: "png"
					}
				},
				messages: {
					image_name: {
						extension: "Please upload png image"
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
    var editor = CKEDITOR.replace( 'high_aps_area', {
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
    var editor = CKEDITOR.replace( 'related_resources_area', {
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

</body>
</html>