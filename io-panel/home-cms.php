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

	$pageName = "Home Page";
	$pageURL = 'home-cms.php';
	$tableName = 'home_cms';
	$deleteURL = 'home-cms.php';
	$addURL = 'product-add.php';

	$sql = "SELECT * FROM ".PREFIX.$tableName." ";
	$results = $admin->query($sql);
	$data = $admin->fetch($results);

	if(isset($_POST['update'])) {
		if($csrf->check_valid('post')) {
			//update to database
			$result = $admin->updateHomeCMS($_POST, $_FILES);
			header("location:".$pageURL."?updatesuccess");
			exit;
		}
	}

	if(isset($_GET['delId']) && !empty($_GET['delId']) ){
		$delId = trim($admin->strip_all($_GET['delId']));
		$admin->deleteProduct($delId);
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
									<h4 class="card-title mb-0"> Home Page Details</h4>
								</div>
								<div class="card-body">

									<div class="form-group row">
										<div class="col-sm-12">
											<label>FDC Description <em>*</em></label>
											<textarea class="form-control" name="fdc_description" required><?php echo $data['fdc_description'] ?></textarea>
										</div>
									</div>
									<div class="form-group row">
										<div class="col-sm-4">
											<label>Icon 1</label>
											<input type="file" class="form-control file" name="fdc_image1" id="" data-image-index="0" />
											<span class="help-text">
												Files must be less than <strong>2 MB</strong>.<br>
												Allowed file types: <strong>png jpg jpeg</strong>.<br>
												Images must be exactly <strong>47 x 47</strong> pixels.
											</span>
											<?php 
												if(!empty($data['fdc_image1'])) {
													$file_name = str_replace('', '-', strtolower( pathinfo($data['fdc_image1'], PATHINFO_FILENAME)));
													$ext = pathinfo($data['fdc_image1'], PATHINFO_EXTENSION);
											?>
													<br><img src="../images/home-images/<?php echo $file_name.'_crop.'.$ext ?>" width="48"  />
											<?php
											} ?>
										</div>
										<div class="col-sm-3">
											<label>Title 1 <em>*</em></label>
											<input type="text" class="form-control" name="fdc_title1" value="<?php echo $data['fdc_title1'] ?>" required>
										</div>

										<div class="col-sm-3">
											<label>Description 1 <em>*</em></label>
											<textarea class="form-control" name="fdc_description1" required><?php echo $data['fdc_description1'] ?></textarea>
										</div>
									</div>

									<div class="form-group row">
										<div class="col-sm-4">
											<label>Icon 2</label>
											<input type="file" class="form-control file" name="fdc_image2" id="" data-image-index="1" />
											<span class="help-text">
												Files must be less than <strong>2 MB</strong>.<br>
												Allowed file types: <strong>png jpg jpeg</strong>.<br>
												Images must be exactly <strong>47 x 47</strong> pixels.
											</span>
											<?php 
												if(!empty($data['fdc_image2'])) {
													$file_name = str_replace('', '-', strtolower( pathinfo($data['fdc_image2'], PATHINFO_FILENAME)));
													$ext = pathinfo($data['fdc_image2'], PATHINFO_EXTENSION);
											?>
													<br><img src="../images/home-images/<?php echo $file_name.'_crop.'.$ext ?>" width="48"  />
											<?php
											} ?>
										</div>
										<div class="col-sm-3">
											<label>Title 2 <em>*</em></label>
											<input type="text" class="form-control" name="fdc_title2" value="<?php echo $data['fdc_title2'] ?>" required>
										</div>

										<div class="col-sm-3">
											<label>Description 2 <em>*</em></label>
											<textarea class="form-control" name="fdc_description2" required><?php echo $data['fdc_description2'] ?></textarea>
										</div>
									</div>

									<div class="form-group row">
										<div class="col-sm-4">
											<label>Icon 3</label>
											<input type="file" class="form-control file" name="fdc_image3" id="" data-image-index="2" />
											<span class="help-text">
												Files must be less than <strong>2 MB</strong>.<br>
												Allowed file types: <strong>png jpg jpeg</strong>.<br>
												Images must be exactly <strong>47 x 47</strong> pixels.
											</span>
											<?php 
												if(!empty($data['fdc_image3'])) {
													$file_name = str_replace('', '-', strtolower( pathinfo($data['fdc_image3'], PATHINFO_FILENAME)));
													$ext = pathinfo($data['fdc_image3'], PATHINFO_EXTENSION);
											?>
													<br><img src="../images/home-images/<?php echo $file_name.'_crop.'.$ext ?>" width="48"  />
											<?php
											} ?>
										</div>
										<div class="col-sm-3">
											<label>Title 3 <em>*</em></label>
											<input type="text" class="form-control" name="fdc_title3" value="<?php echo $data['fdc_title3'] ?>" required>
										</div>

										<div class="col-sm-3">
											<label>Description 3 <em>*</em></label>
											<textarea class="form-control" name="fdc_description3" required><?php echo $data['fdc_description3'] ?></textarea>
										</div>
									</div>

									<div class="form-group row">
										<div class="col-sm-4">
											<label>Icon 4</label>
											<input type="file" class="form-control file" name="fdc_image4" id="" data-image-index="3" />
											<span class="help-text">
												Files must be less than <strong>2 MB</strong>.<br>
												Allowed file types: <strong>png jpg jpeg</strong>.<br>
												Images must be exactly <strong>47 x 47</strong> pixels.
											</span>
											<?php 
												if(!empty($data['fdc_image4'])) {
													$file_name = str_replace('', '-', strtolower( pathinfo($data['fdc_image4'], PATHINFO_FILENAME)));
													$ext = pathinfo($data['fdc_image4'], PATHINFO_EXTENSION);
											?>
													<br><img src="../images/home-images/<?php echo $file_name.'_crop.'.$ext ?>" width="48"  />
											<?php
											} ?>
										</div>
										<div class="col-sm-3">
											<label>Title 4 <em>*</em></label>
											<input type="text" class="form-control" name="fdc_title4" value="<?php echo $data['fdc_title4'] ?>" required>
										</div>

										<div class="col-sm-3">
											<label>Description 4 <em>*</em></label>
											<textarea class="form-control" name="fdc_description4" required><?php echo $data['fdc_description4'] ?></textarea>
										</div>
									</div>

								</div>
							</div>


							<div class="card">
								<div class="card-header">
									<h4 class="card-title mb-0"> Core Product Details</h4>
								</div>

								<div class="card-body">
									<div class="form-group row">
										<div class="col-sm-12">
											<label>Core Product Description <em>*</em></label>
											<textarea class="form-control" name="core_product_description" required><?php echo $data['core_product_description'] ?></textarea>
										</div>
									</div>

									<div class="form-group row">
										<div class="col-sm-12">
											<div class="col-auto float-right ml-auto">
												<a href="<?php echo $addURL; ?>" class="btn add-btn"><i class="fa fa-plus"></i> Add Product</a>
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
														<th>Product Name</th>
														<th>Active</th>
														<th>Action</th>
													</tr>
												</thead>
												<tbody>
													<?php
														$productSql = "select * from ".PREFIX."product_master ";
														$productResult = $admin->query($productSql);
														$x = 1;
														while($productDetails = $admin->fetch($productResult)){
															$file_name = str_replace('', '-', strtolower( pathinfo($productDetails['image_name'], PATHINFO_FILENAME)));
															$ext = pathinfo($productDetails['image_name'], PATHINFO_EXTENSION);
															$url =  BASE_URL."/images/product-image/".$file_name.'_crop.'.$ext;
													?>
															<tr>
																<td><?php echo $x++ ?></td>
																<td><img width="100" src="<?php echo $url; ?>"  /></td>
																<td><?php echo $productDetails['product_name']; ?></td>
																<td>
																	<?php if($productDetails['active']==1) { echo "Active";  } else{ echo "InActive"; } ?>
																</td>
																<td>
																	<a class="btn-transition btn" href="<?php echo $addURL; ?>?edit&id=<?php echo $productDetails['id']; ?>" title="Edit">   <i class="fa fa-pencil"></i> </a>
																	<a class="btn-transition btn" href="<?php echo $deleteURL; ?>?delId=<?php echo $productDetails['id']; ?>" onclick="return confirm('Are you sure you want to delete?');" title="Delete"> <i class="fa fa-trash-o"></i> </a>
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
			$('input[name="fdc_image1"]').change(function(){
				loadImagePreview(this, (47 / 47));
			});

			$('input[name="fdc_image2"]').change(function(){
				loadImagePreview(this, (47 / 47));
			});

			$('input[name="fdc_image3"]').change(function(){
				loadImagePreview(this, (47 / 47));
			});

			$('input[name="fdc_image4"]').change(function(){
				loadImagePreview(this, (47 / 47));
			});


			$("#form").validate({
				ignore: [],
				rules: {
					core_product_description:{
						required:true
					},
					fdc_description:{
						required:true
					},	
					fdc_image1:{
						extension: "jpg|jpeg|png"
					},
					fdc_title1:{
						required:true
					},
					fdc_description1:{
						required:true,
						maxlength:90
					},
					fdc_image2:{
						extension: "jpg|jpeg|png"
					},
					fdc_title2:{
						required:true
					},
					fdc_description2:{
						required:true,
						maxlength:90
					},
					fdc_image3:{
						extension: "jpg|jpeg|png"
					},
					fdc_title3:{
						required:true
					},
					fdc_description3:{
						required:true,
						maxlength:90
					},
					fdc_image4:{
						extension: "jpg|jpeg|png"
					},
					fdc_title4:{
						required:true
					},
					fdc_description4:{
						required:true,
						maxlength:90
					}
				},
				messages: {
					home_image: {
						extension: "Please upload png image"
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
		});
	</script>
</body>
</html>