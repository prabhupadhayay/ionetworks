<?php
	include_once 'include/config.php';
	include_once 'include/admin-functions.php';
	$admin = new AdminFunctions();

	$pageName = "News & Events";
	$parentPageURL = 'media-master.php';
	$pageURL = 'media-add.php';
	$addURL = "media-add.php";

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
			$result = $admin->addMedia($_POST, $_FILES);
			header("location:".$parentPageURL."?registersuccess");
		}
	}

	if(isset($_GET['edit'])){
		$id = $admin->escape_string($admin->strip_all($_GET['id']));
		$data = $admin->getUniqueMediaById($id);
	}

	if(isset($_POST['id']) && !empty($_POST['id'])) {
		if($csrf->check_valid('post')) {
			$id = trim($admin->escape_string($admin->strip_all($_POST['id'])));
			$result = $admin->updateMedia($_POST, $_FILES);
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


	<!-- Main CSS -->
	<link rel="stylesheet" href="assets/css/style.css">

	<!-- Crop Image css -->
	<link href="assets/css/crop-image/cropper.min.css" rel="stylesheet">


	<!-- Datetimepicker CSS -->
	<link rel="stylesheet" href="assets/css/bootstrap-datetimepicker.min.css">

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
									<h4 class="card-title mb-0"> News & Events Details</h4>
								</div>
								<div class="card-body">
									<div class="form-group row">
										<div class="col-sm-4">
											<label>Type</label>
											<select class="form-control" name="type">
												<option value="PressRelease" <?php if(isset($_GET['edit']) and $data['type']=='Press Release') { echo 'selected'; } ?>>PressRelease</option>
												<option value="Events" <?php if(isset($_GET['edit']) and $data['type']=='Events') { echo 'selected'; } ?>>Events</option>
											</select>
										</div>
										<div class="col-sm-4">
											<label>Title<em>*</em></label>
											<input type="text" class="form-control" name="title" value="<?php if(isset($_GET['edit'])){ echo $data['title']; } ?>" required>
										</div>

										<div class="col-sm-4">
											<label>Short Description<em>*</em></label>
											<textarea class="form-control" name="short_description" required><?php if(isset($_GET['edit'])){ echo $data['short_description']; } ?></textarea>
										</div>
									</div>
									<hr>
									<div class="form-group row">
										<div class="col-sm-6">
											<label>Permalink<em>*</em></label>
											<input type="text" class="form-control" name="permalink" value="<?php if(isset($_GET['edit'])){ echo $data['permalink']; } ?>" required>
										</div>
									</div>
									<hr>
									<div class="form-group row">
										<div class="col-sm-4">
											<label>Listing Page Image</label>
											<input type="file" class="form-control file" name="listing_image" id="" data-image-index="0" />
											<span class="help-text">
												Files must be less than <strong>2 MB</strong>.<br>
												Allowed file types: <strong>png|jpg|jpeg</strong>.<br>
												Images must be exactly <strong>754 x 369</strong> pixels.
											</span>
											<?php 
												if(isset($_GET['edit']) && !empty($data['listing_image'])) {
													$file_name = str_replace('', '-', strtolower( pathinfo($data['listing_image'], PATHINFO_FILENAME)));
													$ext = pathinfo($data['listing_image'], PATHINFO_EXTENSION);
											?>
													<br><img src="../images/media/<?php echo $file_name.'_crop.'.$ext ?>" width="200"  />
											<?php
											} ?>
										</div>

										<div class="col-sm-4">
											<label>Detail Page Image</label>
											<input type="file" class="form-control file" name="detail_image" id="" data-image-index="1" />
											<span class="help-text">
												Files must be less than <strong>2 MB</strong>.<br>
												Allowed file types: <strong>png|jpg|jpeg</strong>.<br>
												Images must be exactly <strong>764 x 1465</strong> pixels.
											</span>
											<?php 
												if(isset($_GET['edit']) && !empty($data['detail_image'])) {
													$file_name = str_replace('', '-', strtolower( pathinfo($data['detail_image'], PATHINFO_FILENAME)));
													$ext = pathinfo($data['detail_image'], PATHINFO_EXTENSION);
											?>
													<br><img src="../images/media/<?php echo $file_name.'_crop.'.$ext ?>" width="200"  />
											<?php
											} ?>
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
										<div class="col-sm-4">
											<label>News & Event Date <em>*</em></label>
											<input type="text" required class="form-control valid_date" name="media_date" id="" value="<?php if(isset($_GET['edit'])){ echo date('d-m-Y', strtotime($data['media_date'])); }?>" />
 										</div>
 										<div class="col-sm-4">
											<label>Third Part URL</label><span style="font-size: 13px;">Ex - https://www.google.co.in</span>
											<input type="text" class="form-control" name="third_party_url" id="" value="<?php if(isset($_GET['edit'])){ echo $data['third_party_url']; }?>" />
 										</div>
									</div>
									<hr>
									<div class="form-group row">
										<div class="col-sm-12">
											<label>Detail Description</label>
											<textarea class="form-control" name="description" id="description"><?php if(isset($_GET['edit'])){ echo $data['description']; } ?></textarea>
										</div>
									</div>
									<hr>
									
									<div class="form-group row">
										<div class="col-sm-4">
											<label>Facebook URL</label>
											<input type="text" class="form-control" name="facebook" value="<?php if(isset($_GET['edit'])){ echo $data['facebook']; }?>"/>
										</div>
										<div class="col-sm-4">
											<label>Instagram URL</label>
											<input type="text" class="form-control" name="instagram" value="<?php if(isset($_GET['edit'])){ echo $data['instagram']; }?>"/>
										</div>
										<div class="col-sm-4">
											<label>Twitter URL</label>
											<input type="text" class="form-control" name="twitter" value="<?php if(isset($_GET['edit'])){ echo $data['twitter']; }?>"/>
										</div>
									</div>
									<hr>
									<div class="form-group row">
										<div class="col-sm-4">
											<label>Youtube URL</label>
											<input type="text" class="form-control" name="youtube" value="<?php if(isset($_GET['edit'])){ echo $data['youtube']; }?>"/>
										</div>
										<div class="col-sm-4">
											<label>Linkedin URL</label>
											<input type="text" class="form-control" name="linkedin" value="<?php if(isset($_GET['edit'])){ echo $data['linkedin']; }?>"/>
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

	<!-- Datetimepicker JS -->
	<script src="assets/js/moment.min.js"></script>
	<script src="assets/js/bootstrap-datetimepicker.min.js"></script>

	<!-- Crop Image js -->
	<script src="assets/js/crop-image/cropper.min.js"></script>
	<script src="assets/js/crop-image/image-crop-app.js"></script>

	<!-- Colorpicker JS -->
	<link href="assets/css/spectrum.min.css" rel="stylesheet">
	<script src="assets/js/spectrum.min.js"></script>
	<script>

	   $(document).ready(function() {
	     $('.valid_date').datetimepicker({
	       format: "DD/MM/YYYY",
	    });
	  });
	</script>

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
		$(document).ready(function() {
			$('input[name="listing_image"]').change(function(){
				loadImagePreview(this, (754 / 369));
			});

			$('input[name="detail_image"]').change(function(){
				loadImagePreview(this, (764 / 1465));
			});

			$("#form").validate({
				ignore: [],
				rules: {
					type:{
						required:true
					},
					third_party_url:{
						url:true
					},
					title:{
						required:true,
						maxlength:90
					},
					permalink:{
						required:true,
						lettersonly:true,
						remote:{
                           url:"ajax-check-media-name.php",
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
					short_description:{
						required:true,
						maxlength:230
					},
					description:{
						required:false
					},
					media_date:{
						required:true
					},
					facebook:{
						url:true
					},
					instagram:{
						url:true
					},
					twitter:{
						url:true
					},
					youtube:{
						url:true
					},
					linkedin:{
						url:true
					},
					listing_image:{
						extension: "jpg|jpeg|png"
					},
					detail_image:{
						extension: "jpg|jpeg|png"
					}
				},
				messages: {
					listing_image: {
						extension: "Please upload jpg or png image"
					},
					detail_image: {
						extension: "Please upload jpg or png image"
					},
					permalink:{
						remote:"URL already exists!"
					}
				}
			});
			$.validator.addMethod("lettersonly", function(value, element) {
                return this.optional(element) || /^[a-zA-Z0-9\-]*$/.test(value);
            }, "Please enter character/number or - only");

			$.validator.addMethod('filesizevideo', function (value, element, param) {
				return this.optional(element) || (element.files[0].size <= param)
			}, 'File size must be less than 30 MB');
		});
	</script>
</body>
</html>