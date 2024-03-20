<?php
	include_once 'include/config.php';
	include_once 'include/admin-functions.php';
	$admin = new AdminFunctions();

	$pageName = "Product";
	$parentPageURL = 'product-master.php';
	$pageURL = 'product-add.php';
	$addURL = "specification-add.php";

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
			$result = $admin->addProduct($_POST, $_FILES);
			header("location:".$parentPageURL."?registersuccess");
		}
	}

	if(isset($_GET['edit'])){
		$id = $admin->escape_string($admin->strip_all($_GET['id']));
		$data = $admin->getUniqueProductById($id);
	}


	if(isset($_POST['id']) && !empty($_POST['id'])) {
		if($csrf->check_valid('post')) {
			$id = trim($admin->escape_string($admin->strip_all($_POST['id'])));
			$result = $admin->updateProduct($_POST, $_FILES);
			header("location:".$pageURL."?updatesuccess&edit&id=".$id);
			exit();
		}
	}

	if(isset($_GET['delId']) && !empty($_GET['delId']) ){
		$delId = trim($admin->strip_all($_GET['delId']));
		$industryId = trim($admin->strip_all($_GET['industryId']));
		$admin->deleteProductSpecification($delId);
		header('location: '.$pageURL.'?deletesuccess&edit&id='.$industryId);
		exit;
	}


	if(isset($_GET['fileType']) && !empty($_GET['fileType']) ){
		$fileType = trim($admin->strip_all($_GET['fileType']));
		$id = trim($admin->strip_all($_GET['id']));
		$sql="update ".PREFIX."product_master set $fileType='' where id='$id'";
		$admin->query($sql);
		header('location: '.$pageURL.'?edit&id='.$id);
		exit;
	}


	/*$sql = "select * from ".PREFIX."media_master ";
	$query=$admin->query($sql);
	while($mDetails = $admin->fetch($query)){
		$permalink = $admin->getValidatedPermalink($mDetails['title']);
		$sqlUpdate = "update ".PREFIX."media_master set permalink='".$permalink."' where id='".$mDetails['id']."' ";
		$queryUpdate=$admin->query($sqlUpdate);
	}
	exit();*/
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
									<h4 class="card-title mb-0"> Product Details</h4>
								</div>
								<div class="card-body">
									<div class="form-group row">
										<div class="col-sm-4">
											<label>Product Name<em>*</em></label>
											<input type="text" class="form-control" name="product_name" value="<?php if(isset($_GET['edit'])){ echo $data['product_name']; } ?>" required>
										</div>
										<div class="col-sm-4">
											<label>Product Title</label>
											<input type="text" class="form-control" name="product_title" value="<?php if(isset($_GET['edit'])){ echo $data['product_title']; } ?>">
										</div>
										<div class="col-sm-4">
											<label>Short Description<em>*</em></label>
											<input type="text" class="form-control" name="short_description" value="<?php if(isset($_GET['edit'])){ echo $data['short_description']; } ?>" required>
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
										<div class="col-md-3">
											<label>Product Category <em>*</em></label>
											<select  required class="form-control select" name="category_id" id="category_id" required>
												<option value="">Select</option>
												<?php
													$query = $admin->query("select * from ".PREFIX."category_master where active='1' order by category_name ASC");
													while($row = $admin->fetch($query)) {
												?>
														<option value="<?php echo $row['id']; ?>" <?php if(isset($_GET['edit']) && $row['id']==$data['category_id']){ echo "selected"; } ?> ><?php echo $row['category_name']; ?></option>
												<?php
													}
												?>
											</select>
										</div>
										<div class="col-sm-3">
											<label>Product Sub Category<em>*</em></label>
											<select class="form-control select" name="sub_category_id" id="sub_category_id" required>
												<option value="">Select</option>
												<?php
													if(isset($_GET['edit'])) {
														$subsql= $admin->query("SELECT * FROM ".PREFIX."sub_category_master WHERE `active`='1' and category_id='".$data['category_id']."' order by `category_name` ASC");
														while($row = $admin->fetch($subsql)) {
												?>
															<option value="<?php echo $row['id']; ?>" <?php if(isset($_GET['edit']) && $row['id']==$data['sub_category_id']){ echo "selected"; } ?> ><?php echo $row['category_name']; ?></option>
												<?php
														}
													}
												?>
											</select>
										</div>
										<div class="col-sm-3">
											<label>Product Verient<em>*</em></label>
											<select class="form-control select" name="varient_id" id="varient_id" required>
												<option value="">Select Verient</option>
												<?php
													if(isset($_GET['edit'])) {
														$subsql= $admin->query("SELECT * FROM ".PREFIX."varient_master WHERE `active`='1' and sub_category_id='".$data['sub_category_id']."' order by `name` ASC");
														while($row = $admin->fetch($subsql)) {
												?>
															<option value="<?php echo $row['id']; ?>" <?php if(isset($_GET['edit']) && $row['id']==$data['varient_id']){ echo "selected"; } ?> ><?php echo $row['name']; ?></option>
												<?php
														}
													}
												?>
											</select>
										</div>
										<div class="col-sm-3">
											<label>Product Sub Verient</label>
											<select class="form-control select" name="sub_varient_id" id="sub_varient_id">
												<option value="">Select Sub Verient</option>
												<?php
													if(isset($_GET['edit'])) {
														$subsql= $admin->query("SELECT * FROM ".PREFIX."sub_varient_master WHERE `active`='1' and varient_id='".$data['varient_id']."' order by `name` ASC");
														while($row = $admin->fetch($subsql)) {
												?>
															<option value="<?php echo $row['id']; ?>" <?php if(isset($_GET['edit']) && $row['id']==$data['sub_varient_id']){ echo "selected"; } ?> ><?php echo $row['name']; ?></option>
												<?php
														}
													}
												?>
											</select>
										</div>
									</div>
									<hr>
									<div class="form-group row">
										<div class="col-sm-4">
											<label>Product Home Page Image<em>*</em></label>
											<input type="file" class="form-control file" name="home_image" id="" data-image-index="0" <?php if(!isset($_GET['edit'])) { echo 'required'; }?>/>
											<span class="help-text">
												Files must be less than <strong>2 MB</strong>.<br>
												Allowed file types: <strong>png|jpg|jpeg</strong>.<br>
												Images must be exactly <strong>246 x 185</strong> pixels.
											</span>
											<?php 
												if(isset($_GET['edit']) && !empty($data['home_image'])) {
													$file_name = str_replace('', '-', strtolower( pathinfo($data['home_image'], PATHINFO_FILENAME)));
													$ext = pathinfo($data['home_image'], PATHINFO_EXTENSION);
											?>
													<br><img src="../images/product/<?php echo $file_name.'_crop.'.$ext ?>" width="50"  />
											<?php
											} ?>
										</div>
										<div class="col-sm-4">
											<label>Only For Documentation</label>
											<select class="form-control" name="only_for_documentation">
												<option value="0" <?php if(isset($_GET['edit']) and $data['only_for_documentation']=='0') { echo 'selected'; } ?>>No</option>
												<option value="1" <?php if(isset($_GET['edit']) and $data['only_for_documentation']=='1') { echo 'selected'; } ?>>Yes</option>
											</select>
										</div>
									</div>
									<hr>
									<div class="form-group row">
										<div class="col-sm-4">
											<label>Product Detail Page Image<em>*</em></label>
											<input type="file" class="form-control file" name="detail_image" id="" data-image-index="1" <?php if(!isset($_GET['edit'])) { echo 'required'; }?>/>
											<span class="help-text">
												Files must be less than <strong>2 MB</strong>.<br>
												Allowed file types: <strong>png|jpg|jpeg</strong>.<br>
												Images must be exactly <strong>820 x 559</strong> pixels.
											</span>
											<?php 
												if(isset($_GET['edit']) && !empty($data['detail_image'])) {
													$file_name = str_replace('', '-', strtolower( pathinfo($data['detail_image'], PATHINFO_FILENAME)));
													$ext = pathinfo($data['detail_image'], PATHINFO_EXTENSION);
											?>
													<br><img src="../images/product/<?php echo $file_name.'_crop.'.$ext ?>" width="50"  />
											<?php
											} ?>
										</div>

										<div class="col-sm-4">
											<label>Product Detail Page Image</label>
											<input type="file" class="form-control file" name="detail_imagee1" id="" data-image-index="8">
											<span class="help-text">
												Files must be less than <strong>2 MB</strong>.<br>
												Allowed file types: <strong>png|jpg|jpeg</strong>.<br>
												Images must be exactly <strong>820 x 559</strong> pixels.
											</span>
											<?php 
												if(isset($_GET['edit']) && !empty($data['detail_imagee1'])) {
													$file_name = str_replace('', '-', strtolower( pathinfo($data['detail_imagee1'], PATHINFO_FILENAME)));
													$ext = pathinfo($data['detail_imagee1'], PATHINFO_EXTENSION);
											?>
													<br><img src="../images/product/<?php echo $file_name.'_crop.'.$ext ?>" width="50"  />

													<a href="<?php echo $pageURL ?>??edit&id=<?php echo $id;?>&fileType=detail_imagee1" onclick="return confirm('Are you sure you want to delete ?');" title="delete" class="btn-transition btn"><i class="fa fa-close"></i></a>
											<?php
											} ?>
										</div>

										<div class="col-sm-4">
											<label>Product Detail Page Image</label>
											<input type="file" class="form-control file" name="detail_imagee2" id="" data-image-index="9">
											<span class="help-text">
												Files must be less than <strong>2 MB</strong>.<br>
												Allowed file types: <strong>png|jpg|jpeg</strong>.<br>
												Images must be exactly <strong>820 x 559</strong> pixels.
											</span>
											<?php 
												if(isset($_GET['edit']) && !empty($data['detail_imagee2'])) {
													$file_name = str_replace('', '-', strtolower( pathinfo($data['detail_imagee2'], PATHINFO_FILENAME)));
													$ext = pathinfo($data['detail_imagee2'], PATHINFO_EXTENSION);
											?>
													<br><img src="../images/product/<?php echo $file_name.'_crop.'.$ext ?>" width="50"  />

													<a href="<?php echo $pageURL ?>??edit&id=<?php echo $id;?>&fileType=detail_imagee2" onclick="return confirm('Are you sure you want to delete ?');" title="delete" class="btn-transition btn"><i class="fa fa-close"></i></a>
											<?php
											} ?>
										</div>
									</div>
									<div class="form-group row">
										<div class="col-sm-4">
											<label>Product Detail Page Image</label>
											<input type="file" class="form-control file" name="detail_imagee3" id="" data-image-index="10">
											<span class="help-text">
												Files must be less than <strong>2 MB</strong>.<br>
												Allowed file types: <strong>png|jpg|jpeg</strong>.<br>
												Images must be exactly <strong>820 x 559</strong> pixels.
											</span>
											<?php 
												if(isset($_GET['edit']) && !empty($data['detail_imagee3'])) {
													$file_name = str_replace('', '-', strtolower( pathinfo($data['detail_imagee3'], PATHINFO_FILENAME)));
													$ext = pathinfo($data['detail_imagee3'], PATHINFO_EXTENSION);
											?>
													<br><img src="../images/product/<?php echo $file_name.'_crop.'.$ext ?>" width="50"  />

													<a href="<?php echo $pageURL ?>??edit&id=<?php echo $id;?>&fileType=detail_imagee3" onclick="return confirm('Are you sure you want to delete ?');" title="delete" class="btn-transition btn"><i class="fa fa-close"></i></a>
											<?php
											} ?>
										</div>
										
										<div class="col-sm-4">
											<label>Product Video</label>
											<input type="file" class="form-control" name="detail_video">
											<span class="help-block" id="dim">(Size: MAX 50 MB/ MP4 Only`)</span>
											<?php 
												if(isset($_GET['edit']) && !empty($data['detail_video'])) {
											?>
											<br><br>
											<a target="_blank" href="<?php echo BASE_URL; ?>/images/videos/<?php echo $data['detail_video']; ?>">View Video</a><br>

											<a href="<?php echo $pageURL ?>??edit&id=<?php echo $id;?>&fileType=detail_video" onclick="return confirm('Are you sure you want to delete ?');" title="delete" class="btn-transition btn"><i class="fa fa-close"></i></a>
											<?php
												} 
											?>
										</div>
										<div class="col-sm-4">
											<label>Product Category Page Image<em>*</em></label>
											<input type="file" class="form-control file" name="category_image" id="" data-image-index="2" <?php if(!isset($_GET['edit'])) { echo 'required'; }?>/>
											<span class="help-text">
												Files must be less than <strong>2 MB</strong>.<br>
												Allowed file types: <strong>png</strong>.<br>
												Images must be exactly <strong>200 x 200</strong> pixels.
											</span>
											<?php 
												if(isset($_GET['edit']) && !empty($data['category_image'])) {
													$file_name = str_replace('', '-', strtolower( pathinfo($data['category_image'], PATHINFO_FILENAME)));
													$ext = pathinfo($data['category_image'], PATHINFO_EXTENSION);
											?>
													<br><img src="../images/product/<?php echo $file_name.'_crop.'.$ext ?>" width="50"  />
											<?php
											} ?>
										</div>
									</div>
									<hr>
									<div class="form-group row">
										<div class="col-sm-12">
											<label>Product Overview<em>*</em></label>
											<textarea class="form-control" name="overview" id="overview" required><?php if(isset($_GET['edit'])){ echo $data['overview']; } ?></textarea>
										</div>
									</div>
									<hr>
									<!--Product Overview 2-->
									<hr>
									<div class="form-group row">
										<div class="col-sm-12">
											<label>Product Overview 2<em>*</em></label>
											<textarea class="form-control" name="overview_2" id="overview_2" required><?php if(isset($_GET['edit'])){ echo $data['overview_2']; } ?></textarea>
										</div>
									</div>
									<hr>
                                   <!--Detail Area 1-->
                                    <!-- <hr>
									<div class="form-group row">
										<div class="col-sm-12">
											<label>Detail Area 1<em></em></label>
											<textarea class="form-control" name="detail_area_1" id="detail_area_1" required><?php if(isset($_GET['edit'])){ echo $data['detail_area_1']; } ?></textarea>
										</div>
									</div>
									<hr> -->

									 <!--Detail Area 2-->
									 
									<!-- <div class="form-group row">
										<div class="col-sm-12">
											<label>Detail Area 2<em></em></label>
											<textarea class="form-control" name="detail_area_2" id="detail_area_2" required><?php if(isset($_GET['edit'])){ echo $data['detail_area_2']; } ?></textarea>
										</div>
									</div> -->
									
									 <!--Video Description Area-->
									<hr>
									<div class="form-group row">
										<div class="col-sm-12">
											<label>Video Description Area<em>*</em></label>
											<textarea class="form-control" name="video_description_area" id="video_description_area" required><?php if(isset($_GET['edit'])){ echo $data['video_description_area']; } ?></textarea>
										</div>
									</div>
									<hr>
									<div class="form-group row">
									<div class="col-sm-4">
											<label>Product Detail Video Title<em>*</em></label>
											<input type="text" class="form-control" name="detail_video_title" value="<?php if(isset($_GET['edit'])){ echo $data['detail_video_title']; } ?>">
										</div>
										</div>
									<div class="form-group row">
										<div class="col-sm-4">
											<label>Product Detail Image 1<em>*</em></label>
											<input type="file" class="form-control file" name="detail_image1" id="" data-image-index="3" <?php if(!isset($_GET['edit'])) { echo 'required'; } ?>/>
											<span class="help-text">
												Files must be less than <strong>2 MB</strong>.<br>
												Allowed file types: <strong>png|jpg|jpeg</strong>.<br>
												Images must be exactly <strong>1014 x 860</strong> pixels.
											</span>
											<?php 
												if(isset($_GET['edit']) && !empty($data['detail_image1'])) {
													$file_name = str_replace('', '-', strtolower( pathinfo($data['detail_image1'], PATHINFO_FILENAME)));
													$ext = pathinfo($data['detail_image1'], PATHINFO_EXTENSION);
											?>
													<br><img src="../images/product/<?php echo $file_name.'_crop.'.$ext ?>" width="50"  />
											<?php
											} ?>
										</div>
										<div class="col-sm-4">
											<label>Product Detail Image 2</label>
											<input type="file" class="form-control file" name="detail_image2" id="" data-image-index="4"/>
											<span class="help-text">
												Files must be less than <strong>2 MB</strong>.<br>
												Allowed file types: <strong>png|jpg|jpeg</strong>.<br>
												Images must be exactly <strong>1014 x 860</strong> pixels.
											</span>
											<?php 
												if(isset($_GET['edit']) && !empty($data['detail_image2'])) {
													$file_name = str_replace('', '-', strtolower( pathinfo($data['detail_image2'], PATHINFO_FILENAME)));
													$ext = pathinfo($data['detail_image2'], PATHINFO_EXTENSION);
											?>
													<br><img src="../images/product/<?php echo $file_name.'_crop.'.$ext ?>" width="50"  />

													<a href="<?php echo $pageURL ?>??edit&id=<?php echo $id;?>&fileType=detail_image2" onclick="return confirm('Are you sure you want to delete ?');" title="delete" class="btn-transition btn"><i class="fa fa-close"></i></a>


											<?php
											} ?>
										</div>
										<div class="col-sm-4">
											<label>Product Detail Image 3</label>
											<input type="file" class="form-control file" name="detail_image3" id="" data-image-index="5"/>
											<span class="help-text">
												Files must be less than <strong>2 MB</strong>.<br>
												Allowed file types: <strong>png|jpg|jpeg</strong>.<br>
												Images must be exactly <strong>1014 x 860</strong> pixels.
											</span>
											<?php 
												if(isset($_GET['edit']) && !empty($data['detail_image3'])) {
													$file_name = str_replace('', '-', strtolower( pathinfo($data['detail_image3'], PATHINFO_FILENAME)));
													$ext = pathinfo($data['detail_image3'], PATHINFO_EXTENSION);
											?>
													<br><img src="../images/product/<?php echo $file_name.'_crop.'.$ext ?>" width="50"  />
													<a href="<?php echo $pageURL ?>??edit&id=<?php echo $id;?>&fileType=detail_image3" onclick="return confirm('Are you sure you want to delete ?');" title="delete" class="btn-transition btn"><i class="fa fa-close"></i></a>
											<?php
											} ?>
										</div>
									</div>
									
									<hr>
									<div class="form-group row">
										<div class="col-sm-4">
											<label>Product Detail Image 4</label>
											<input type="file" class="form-control file" name="detail_image4" id="" data-image-index="6"/>
											<span class="help-text">
												Files must be less than <strong>2 MB</strong>.<br>
												Allowed file types: <strong>png|jpg|jpeg</strong>.<br>
												Images must be exactly <strong>1014 x 860</strong> pixels.
											</span>
											<?php 
												if(isset($_GET['edit']) && !empty($data['detail_image4'])) {
													$file_name = str_replace('', '-', strtolower( pathinfo($data['detail_image4'], PATHINFO_FILENAME)));
													$ext = pathinfo($data['detail_image4'], PATHINFO_EXTENSION);
											?>
													<br><img src="../images/product/<?php echo $file_name.'_crop.'.$ext ?>" width="50"  />

													<a href="<?php echo $pageURL ?>??edit&id=<?php echo $id;?>&fileType=detail_image4" onclick="return confirm('Are you sure you want to delete ?');" title="delete" class="btn-transition btn"><i class="fa fa-close"></i></a>
											<?php
											} ?>
										</div>
										<div class="col-sm-4">
											<label>Product Detail Image 5</label>
											<input type="file" class="form-control file" name="detail_image5" id="" data-image-index="7"/>
											<span class="help-text">
												Files must be less than <strong>2 MB</strong>.<br>
												Allowed file types: <strong>png|jpg|jpeg</strong>.<br>
												Images must be exactly <strong>1014 x 860</strong> pixels.
											</span>
											<?php 
												if(isset($_GET['edit']) && !empty($data['detail_image5'])) {
													$file_name = str_replace('', '-', strtolower( pathinfo($data['detail_image5'], PATHINFO_FILENAME)));
													$ext = pathinfo($data['detail_image5'], PATHINFO_EXTENSION);
											?>
													<br><img src="../images/product/<?php echo $file_name.'_crop.'.$ext ?>" width="50"  />

													<a href="<?php echo $pageURL ?>??edit&id=<?php echo $id;?>&fileType=detail_image5" onclick="return confirm('Are you sure you want to delete ?');" title="delete" class="btn-transition btn"><i class="fa fa-close"></i></a>
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
											<label>Data Sheet</label>
											<input type="file" class="form-control file" name="data_sheet" <?php if(!isset($_GET['edit'])) {  } ?>/>
											<span class="help-text">
												Files must be less than <strong>2 MB</strong>.<br>
												Allowed file types: <strong>pdf|doc|jpeg|png|jpeg</strong>.<br>
											</span>
											<?php 
												if(isset($_GET['edit']) && !empty($data['data_sheet'])) {
											?>
													<br><a download href="../images/product/<?php echo $data['data_sheet']; ?>" width="50">Download</a>


													<a href="<?php echo $pageURL ?>??edit&id=<?php echo $id;?>&fileType=data_sheet" onclick="return confirm('Are you sure you want to delete ?');" title="delete" class="btn-transition btn"><i class="fa fa-close"></i></a>
											<?php
											} ?>
										</div>
										<div class="col-sm-4">
											<label>Quick Start Guide</label>
											<input type="file" class="form-control file" name="user_start_guide" <?php if(!isset($_GET['edit'])) { } ?>/>
											<span class="help-text">
												Files must be less than <strong>2 MB</strong>.<br>
												Allowed file types: <strong>pdf|doc|jpeg|png|jpeg</strong>.<br>
											</span>
											<?php 
												if(isset($_GET['edit']) && !empty($data['user_start_guide'])) {
											?>
													<br><a download href="../images/product/<?php echo $data['user_start_guide']; ?>" width="50">Download</a>

													<a href="<?php echo $pageURL ?>??edit&id=<?php echo $id;?>&fileType=user_start_guide" onclick="return confirm('Are you sure you want to delete ?');" title="delete" class="btn-transition btn"><i class="fa fa-close"></i></a>
											<?php
											} ?>
										</div>

<!----New features in  add products -----------> 

<div class="col-sm-4">
											<label>Quick Start Guide 1</label>
											<input type="file" class="form-control file" name="user_start_guide_1" <?php if(!isset($_GET['edit'])) { } ?>/>
											<span class="help-text">
												Files must be less than <strong>2 MB</strong>.<br>
												Allowed file types: <strong>pdf|doc|jpeg|png|jpeg</strong>.<br>
											</span>
											<?php 
												if(isset($_GET['edit']) && !empty($data['user_start_guide_1'])) {
											?>
													<br><a download href="../images/product/<?php echo $data['user_start_guide_1']; ?>" width="50">Download</a>

													<a href="<?php echo $pageURL ?>??edit&id=<?php echo $id;?>&fileType=user_start_guide_1" onclick="return confirm('Are you sure you want to delete ?');" title="delete" class="btn-transition btn"><i class="fa fa-close"></i></a>
											<?php
											} ?>
										</div>



										<div class="col-sm-4">
											<label>Quick Start Guide (domestic)</label>
											<input type="file" class="form-control file" name="user_start_guide_domestic" <?php if(!isset($_GET['edit'])) { } ?>/>
											<span class="help-text">
												Files must be less than <strong>2 MB</strong>.<br>
												Allowed file types: <strong>pdf|doc|jpeg|png|jpeg</strong>.<br>
											</span>
											<?php 
												if(isset($_GET['edit']) && !empty($data['user_start_guide_domestic'])) {
											?>
													<br><a download href="../images/product/<?php echo $data['user_start_guide_domestic']; ?>" width="50">Download</a>

													<a href="<?php echo $pageURL ?>??edit&id=<?php echo $id;?>&fileType=user_start_guide_domestic" onclick="return confirm('Are you sure you want to delete ?');" title="delete" class="btn-transition btn"><i class="fa fa-close"></i></a>
											<?php
											} ?>
										</div>

										<div class="col-sm-4">
											<label>Quick Start Guide (International)</label>
											<input type="file" class="form-control file" name="user_start_guide_international" <?php if(!isset($_GET['edit'])) { } ?>/>
											<span class="help-text">
												Files must be less than <strong>2 MB</strong>.<br>
												Allowed file types: <strong>pdf|doc|jpeg|png|jpeg</strong>.<br>
											</span>
											<?php 
												if(isset($_GET['edit']) && !empty($data['user_start_guide_international'])) {
											?>
													<br><a download href="../images/product/<?php echo $data['user_start_guide_international']; ?>" width="50">Download</a>

													<a href="<?php echo $pageURL ?>??edit&id=<?php echo $id;?>&fileType=user_start_guide_international" onclick="return confirm('Are you sure you want to delete ?');" title="delete" class="btn-transition btn"><i class="fa fa-close"></i></a>
											<?php
											} ?>
										</div>




										<?php /* ?>
										<div class="col-sm-3">
											<label>User Guide<em>*</em></label>
											<input type="file" class="form-control file" name="start_guide" <?php if(!isset($_GET['edit'])) { echo 'required'; } ?>/>
											<span class="help-text">
												Files must be less than <strong>2 MB</strong>.<br>
												Allowed file types: <strong>pdf|doc|jpeg|png|jpeg</strong>.<br>
											</span>
											<?php 
												if(isset($_GET['edit']) && !empty($data['start_guide'])) {
											?>
													<br><a download href="../images/product/<?php echo $data['start_guide']; ?>" width="50">Download</a>
											<?php
											} ?>
										</div>
										<?php */ ?>


										<div class="col-sm-4">
											<label>Brochure</label>
											<input type="file" class="form-control file" name="brochure" <?php if(!isset($_GET['edit'])) {  } ?>/>
											<span class="help-text">
												Files must be less than <strong>2 MB</strong>.<br>
												Allowed file types: <strong>pdf|doc|jpeg|png|jpeg</strong>.<br>
											</span>
											<?php 
												if(isset($_GET['edit']) && !empty($data['brochure'])) {
											?>
													<br><a download href="../images/product/<?php echo $data['brochure']; ?>" width="50">Download</a>

													<a href="<?php echo $pageURL ?>??edit&id=<?php echo $id;?>&fileType=brochure" onclick="return confirm('Are you sure you want to delete ?');" title="delete" class="btn-transition btn"><i class="fa fa-close"></i></a>
											<?php
											} ?>
										</div>
									</div>
									<hr>
									<div class="form-group row">
										<div class="col-sm-4">
											<label>Display User Manual</label>
											<select class="form-control" name="display_user_manual">
												<option value="0" <?php if(isset($_GET['edit']) and $data['display_user_manual']=='0') { echo 'selected'; } ?>>No</option>
												<option value="1" <?php if(isset($_GET['edit']) and $data['display_user_manual']=='1') { echo 'selected'; } ?>>Yes</option>
											</select>
										</div>
									</div>
									
									<hr>
									<div class="form-group row">
										<div class="col-md-4">
											<label>Top Picks To Compliment</label>
											<select class="form-control select multi-select" multiple name="top_pics[]">
												<option value="">Select</option>
												<?php
													$topPicsArr = array();
													if(isset($_GET['edit'])){
														$topPicsArr = explode(",",$data['top_pics']);
													}
													$query = $admin->query("select * from ".PREFIX."product_master where active='1' AND only_for_documentation = '0' order by product_name ASC");
													while($row = $admin->fetch($query)) {
												?>
														<option value="<?php echo $row['id']; ?>" <?php if(in_array($row['id'], $topPicsArr)){ echo 'selected'; } ?> ><?php echo $row['product_name']; ?></option>
												<?php
													}
												?>
											</select>
										</div>
										<div class="col-sm-8">
											<label>Application Details<em>*</em></label>
											<textarea class="form-control" name="detail_description" id="detail_description" required><?php if(isset($_GET['edit'])){ echo $data['detail_description']; } ?></textarea>
										</div>
										<div class="col-sm-8">
											<label>Realted Products Area<em>*</em></label>
											<textarea class="form-control" name="related_products_area" id="related_products_area" required><?php if(isset($_GET['edit'])){ echo $data['related_products_area']; } ?></textarea>
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

						<?php if(isset($_GET['edit'])){ ?>
							<div class="card">
								<div class="card-header">
									<h4 class="card-title mb-0"> Product Specification </h4>
								</div>

								<div class="card-body">
									<div class="form-group row">
										<div class="col-sm-12">
											<div class="col-auto float-right ml-auto">
												<a href="<?php echo $addURL; ?>?industryId=<?php echo $id; ?>" class="btn add-btn"><i class="fa fa-plus"></i> Add Specification</a>
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
														<th>Title</th>
														<th>Description</th>
														<th>Active</th>
														<th>Action</th>
													</tr>
												</thead>
												<tbody>
													<?php
														$specSql = "select * from ".PREFIX."product_specification_master where product_id='".$id."' ORDER BY id DESC ";
														$specResult = $admin->query($specSql);
														$x = 1;
														while($specDetails = $admin->fetch($specResult)){
															$file_name = str_replace('', '-', strtolower( pathinfo($specDetails['image_name'], PATHINFO_FILENAME)));
															$ext = pathinfo($specDetails['image_name'], PATHINFO_EXTENSION);
															$url =  BASE_URL."/images/product/".$file_name.'_crop.'.$ext;
													?>
															<tr>
																<td><?php echo $x++ ?></td>
																<td><img width="100" src="<?php echo $url; ?>"  /></td>
																<td><?php echo $specDetails['title']; ?></td>
																<td><?php echo $specDetails['description']; ?></td>
																<td>
																	<?php if($specDetails['active']==1) { echo "Active";  } else{ echo "InActive"; } ?>
																</td>
																<td>
																	<a class="btn-transition btn" href="<?php echo $addURL; ?>?edit&id=<?php echo $specDetails['id']; ?>&industryId=<?php echo $id; ?>" title="Edit">   <i class="fa fa-pencil"></i> </a>
																	<a class="btn-transition btn" href="<?php echo $pageURL; ?>?industryId=<?php echo $id; ?>&delId=<?php echo $specDetails['id']; ?>" onclick="return confirm('Are you sure you want to delete?');" title="Delete"> <i class="fa fa-trash-o"></i> </a>
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

						<?php } ?>
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
		var editor = CKEDITOR.replace( 'overview', {
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
		var editor = CKEDITOR.replace( 'related_products_area', {
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
		var editor = CKEDITOR.replace( 'overview_2', {
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
		var editor = CKEDITOR.replace( 'detail_description', {
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
		var editor = CKEDITOR.replace( 'detail_area_1', {
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
		var editor = CKEDITOR.replace( 'detail_area_2', {
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
		var editor = CKEDITOR.replace( 'video_description_area', {
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

		function getSubSubCategory() {
			var sub_category_id = $("#sub_category_id").val();
			$.ajax({
				url:"ajaxGetSubSubCategory.php",
				data:{sub_category_id:sub_category_id},
				type:"POST",
				success: function(response){
					var response = JSON.parse(response);
					$("#varient_id").html(response.selectContent);
				},
				error: function(){
					alert("Unable to add to cart, pleases try again");
				},
				complete: function(response){
					
				}
			}).then(function (response) {
			    // create the option and append to Select2

				$("#varient_id").html(response.selectContent);
			});;
		}

		$(document).ready(function() {
			$('#sub_category_id').on("change",getSubSubCategory); 

			$("#category_id").on("change", function(){
				var category_id = $(this).val();
				$.ajax({
					url:"ajaxGetSubCategoryByCategoryId.php",
					data:{category_id:category_id},
					type:"POST",
					success: function(response){
						$("#sub_category_id").html(response);
					},
					error: function(){
						alert("Unable to get content, please try again");
					},
					complete: function(response){
						
					}
				});
			});


			$('input[name="detail_image"]').change(function(){
				loadImagePreview(this, (820 / 559));
			});

			$('input[name="detail_imagee1"]').change(function(){
				loadImagePreview(this, (820 / 559));
			});

			$('input[name="detail_imagee2"]').change(function(){
				loadImagePreview(this, (820 / 559));
			});

			$('input[name="detail_imagee3"]').change(function(){
				loadImagePreview(this, (820 / 559));
			});


			

			$('input[name="home_image"]').change(function(){
				loadImagePreview(this, (246 / 185));
			});

			$('input[name="category_image"]').change(function(){
				loadImagePreview(this, (200 / 200));
			});

			$('input[name="detail_image1"]').change(function(){
				loadImagePreview(this, (1014 / 860));
			});

			$('input[name="detail_image2"]').change(function(){
				loadImagePreview(this, (1014 / 860));
			});

			$('input[name="detail_image3"]').change(function(){
				loadImagePreview(this, (1014 / 860));
			});

			$('input[name="detail_image4"]').change(function(){
				loadImagePreview(this, (1014 / 860));
			});

			$('input[name="detail_image5"]').change(function(){
				loadImagePreview(this, (1014 / 860));
			});
			
			$("#form").validate({
				ignore: [],
				rules: {
					product_name:{
						required:true
					},
					permalink:{
						required:true,
						lettersonly:true,
						remote:{
                           url:"ajax-check-product-name.php",
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
					detail_video:{
						extension: 'mp4',
						filesizevideo: 55000000
					},
					product_title:{
						maxlength:100
					},
					home_image:{
						extension: "jpg|jpeg|png"
					},
					detail_image:{
						extension: "jpg|jpeg|png"
					},
					detail_imagee1:{
						extension: "jpg|jpeg|png"
					},
					detail_imagee2:{
						extension: "jpg|jpeg|png"
					},
					detail_imagee3:{
						extension: "jpg|jpeg|png"
					},
					category_image:{
						extension: "png"
					},
					data_sheet:{
						extension: "docx|doc|png|jpg|jpeg|pdf"
					},
					user_start_guide:{
						extension: "docx|doc|png|jpg|jpeg|pdf"
					},
					/*start_guide:{
						extension: "docx|doc|png|jpg|jpeg|pdf"
					},*/
					brochure:{
						extension: "docx|doc|png|jpg|jpeg|pdf"
					},
					short_description:{
						required:true,
						maxlength:100
					},
					overview:{
						required:true
					},
					detail_image1:{
						extension: "jpg|jpeg|png"
					},
					detail_image2:{
						extension: "jpg|jpeg|png"
					},
					detail_image3:{
						extension: "jpg|jpeg|png"
					},
					detail_image4:{
						extension: "jpg|jpeg|png"
					},
					detail_image5:{
						extension: "jpg|jpeg|png"
					},
					detail_description:{
						required:false
					},
					varient_id:{
						required:true
					}
				},
				messages: {
					data_sheet:{
						extension: "Please upload jpg/png/pdf/doc file"
					},
					user_start_guide:{
						extension: "Please upload jpg/png/pdf/doc file"
					},
					start_guide:{
						extension: "Please upload jpg/png/pdf/doc file"
					},
					brochure:{
						extension: "Please upload jpg/png/pdf/doc file"
					},
					permalink:{
						remote:"URL already exists."
					},
					detail_image1: {
						extension: "Please upload jpg or png image"
					},
					detail_image2: {
						extension: "Please upload jpg or png image"
					},
					detail_image3: {
						extension: "Please upload jpg or png image"
					},
					detail_image4: {
						extension: "Please upload jpg or png image"
					},
					detail_image5: {
						extension: "Please upload jpg or png image"
					},
					detail_image: {
						extension: "Please upload jpg or png image"
					},
					home_image: {
						extension: "Please upload jpg or png image"
					},
					category_image: {
						extension: "Please upload png image"
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