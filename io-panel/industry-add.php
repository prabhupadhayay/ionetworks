<?php
	include_once 'include/config.php';
	include_once 'include/admin-functions.php';
	$admin = new AdminFunctions();

	$pageName = "Industry";
	$parentPageURL = 'industry-master.php';
	$pageURL = 'industry-add.php';
	$addURL = "class-add.php";
	$addURL2 = "class-add2.php";

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
			$result = $admin->addIndustry($_POST, $_FILES);
			header("location:".$parentPageURL."?registersuccess");
		}
	}

	if(isset($_GET['edit'])){
		$id = $admin->escape_string($admin->strip_all($_GET['id']));
		$data = $admin->getUniqueIndustryById($id);
	}

	if(isset($_POST['id']) && !empty($_POST['id'])) {
		if($csrf->check_valid('post')) {
			$id = trim($admin->escape_string($admin->strip_all($_POST['id'])));
			$result = $admin->updateIndustry($_POST, $_FILES);
			header("location:".$pageURL."?updatesuccess&edit&id=".$id);
			exit();
		}
	}

	if(isset($_GET['delId']) && !empty($_GET['delId']) ){
		$delId = trim($admin->strip_all($_GET['delId']));
		$industryId = trim($admin->strip_all($_GET['industryId']));
		$admin->deleteClassLead($delId);
		header('location: '.$pageURL.'?deletesuccess&edit&id='.$industryId);
		exit;
	}

    if(isset($_GET['delId2']) && !empty($_GET['delId2']) ){
		$delId = trim($admin->strip_all($_GET['delId2']));
		$industryId = trim($admin->strip_all($_GET['industryId']));
		$admin->deleteClassLead2($delId);
		header('location: '.$pageURL.'?deletesuccess&edit&id='.$industryId);
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
									<h4 class="card-title mb-0"> Industry Details</h4>
								</div>
								<div class="card-body">
									<div class="form-group row">
										<div class="col-sm-4">
											<label>Industry Name<em>*</em></label>
											<input type="text" class="form-control" name="name" value="<?php if(isset($_GET['edit'])){ echo $data['name']; } ?>" required>
										</div>

										<div class="col-sm-4">
											<label>Industry Menu Icon</label>
											<input type="file" class="form-control file" name="menu_icon" id="" data-image-index="0" />
											<span class="help-text">
												Files must be less than <strong>2 MB</strong>.<br>
												Allowed file types: <strong>png</strong>.<br>
												Images must be exactly <strong>36 x 36</strong> pixels.
											</span>
											<?php 
												if(isset($_GET['edit']) && !empty($data['menu_icon'])) {
													$file_name = str_replace('', '-', strtolower( pathinfo($data['menu_icon'], PATHINFO_FILENAME)));
													$ext = pathinfo($data['menu_icon'], PATHINFO_EXTENSION);
											?>
													<br><img src="../images/industry/<?php echo $file_name.'_crop.'.$ext ?>" width="50"  />
											<?php
											} ?>
										</div>

										<div class="col-sm-4">
											<label>Industry Listing Image</label>
											<input type="file" class="form-control file" name="listing_image" id="" data-image-index="1" />
											<span class="help-text">
												Files must be less than <strong>2 MB</strong>.<br>
												Allowed file types: <strong>png|jpg|jpeg</strong>.<br>
												Images must be exactly <strong>753 x 368</strong> pixels.
											</span>
											<?php 
												if(isset($_GET['edit']) && !empty($data['listing_image'])) {
													$file_name = str_replace('', '-', strtolower( pathinfo($data['listing_image'], PATHINFO_FILENAME)));
													$ext = pathinfo($data['listing_image'], PATHINFO_EXTENSION);
											?>
													<br><img src="../images/industry/<?php echo $file_name.'_crop.'.$ext ?>" width="200"  />
											<?php
											} ?>
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
											<label>Listing Description<em>*</em></label>
											<textarea class="form-control" name="short_description" required><?php if(isset($_GET['edit'])){ echo $data['short_description']; } ?></textarea>
										</div>
										<div class="col-sm-4">
											<label>Detail Banner Description<em>*</em></label>
											<textarea class="form-control" name="banner_description" required><?php if(isset($_GET['edit'])){ echo $data['banner_description']; } ?></textarea>
										</div>
										<div class="col-sm-4">
											<label>Detail Banner Image</label>
											<input type="file" class="form-control file" name="detail_banner_image" id="" data-image-index="2" />
											<span class="help-text">
												Files must be less than <strong>2 MB</strong>.<br>
												Allowed file types: <strong>png</strong>.<br>
												Images must be exactly <strong>1920 x 306</strong> pixels.
											</span>
											<?php 
												if(isset($_GET['edit']) && !empty($data['detail_banner_image'])) {
													$file_name = str_replace('', '-', strtolower( pathinfo($data['detail_banner_image'], PATHINFO_FILENAME)));
													$ext = pathinfo($data['detail_banner_image'], PATHINFO_EXTENSION);
											?>
													<br><img src="../images/industry/<?php echo $file_name.'_crop.'.$ext ?>" width="200"  />
											<?php
											} ?>
										</div>
									</div>
									<hr>
									<div class="form-group row">
										<div class="col-sm-4">
											<label>Detail Image </label>
											<input type="file" class="form-control file" name="image_name" id="" data-image-index="3" />
											<span class="help-text">
												Files must be less than <strong>2 MB</strong>.<br>
												Allowed file types: <strong>png jpg jpeg</strong>.<br>
												Images must be exactly <strong>1920 x 757</strong> pixels.
											</span>
											<?php 
												if(isset($_GET['edit']) && !empty($data['image_name'])) {
													$file_name = str_replace('', '-', strtolower( pathinfo($data['image_name'], PATHINFO_FILENAME)));
													$ext = pathinfo($data['image_name'], PATHINFO_EXTENSION);
											?>
													<br><img src="../images/industry/<?php echo $file_name.'_crop.'.$ext ?>" width="100"  />
											<?php
											} ?>
										</div>
										<div class="col-sm-8">
											<label>Detail Image Title<em>*</em></label>
											<textarea class="form-control" name="image_title" id="image_title" required><?php if(isset($_GET['edit'])){ echo $data['image_title']; } ?></textarea>
										</div>
									</div>
									<hr>
									<div class="form-group row">
										<div class="col-sm-12">
											<label>Detail Description<em>*</em></label>
											<textarea class="form-control" name="description" id="description" required><?php if(isset($_GET['edit'])){ echo $data['description']; } ?></textarea>
										</div>
									</div>
									
									<hr>
									<div class="form-group row">
										<div class="col-sm-4">
											<label>Image </label>
											<input type="file" class="form-control file" name="detail_image1" id="" data-image-index="4" />
											<span class="help-text">
												Files must be less than <strong>2 MB</strong>.<br>
												Allowed file types: <strong>png jpg jpeg</strong>.<br>
												Images must be exactly <strong>652 x 895</strong> pixels.
											</span>
											<?php 
												if(isset($_GET['edit']) && !empty($data['detail_image1'])) {
													$file_name = str_replace('', '-', strtolower( pathinfo($data['detail_image1'], PATHINFO_FILENAME)));
													$ext = pathinfo($data['detail_image1'], PATHINFO_EXTENSION);
											?>
													<br><img src="../images/industry/<?php echo $file_name.'_crop.'.$ext ?>" width="100"  />
											<?php
											} ?>
										</div>

										<div class="col-sm-8">
											<label>Description<em>*</em></label>
											<textarea class="form-control" name="detail_description1" id="detail_description1" required><?php if(isset($_GET['edit'])){ echo $data['detail_description1']; } ?></textarea>
										</div>
									</div>
									<hr>

									<div class="form-group row">
										<div class="col-sm-4">
											<label>Image </label>
											<input type="file" class="form-control file" name="detail_image2" id="" data-image-index="5" />
											<span class="help-text">
												Files must be less than <strong>2 MB</strong>.<br>
												Allowed file types: <strong>png jpg jpeg</strong>.<br>
												Images must be exactly <strong>652 x 895</strong> pixels.
											</span>
											<?php 
												if(isset($_GET['edit']) && !empty($data['detail_image2'])) {
													$file_name = str_replace('', '-', strtolower( pathinfo($data['detail_image2'], PATHINFO_FILENAME)));
													$ext = pathinfo($data['detail_image2'], PATHINFO_EXTENSION);
											?>
													<br><img src="../images/industry/<?php echo $file_name.'_crop.'.$ext ?>" width="100"  />
											<?php
											} ?>
										</div>

										<div class="col-sm-8">
											<label>Description<em>*</em></label>
											<textarea class="form-control" name="detail_description2" id="detail_description2" required><?php if(isset($_GET['edit'])){ echo $data['detail_description2']; } ?></textarea>
										</div>
									</div>
									<hr>
									<div class="form-group row">
										<div class="col-sm-4">
											<label>Active</label>
											<select class="form-control" name="active">
												<option value="1" <?php if(isset($_GET['edit']) and $data['active']=='1') { echo 'selected'; } ?>>Yes</option>
												<option value="0" <?php if(isset($_GET['edit']) and $data['active']=='0') { echo 'selected'; } ?>>No</option>
											</select>
										</div>
										<div class="col-sm-4">
											<label>Display Order <em>*</em></label>
											<input type="number" min="1" required class="form-control" name="display_order" id="" value="<?php if(isset($_GET['edit'])){ echo $data['display_order']; }?>"/>
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
									<h4 class="card-title mb-0"> Class Leading Tech </h4>
								</div>

								<div class="card-body">
									<div class="form-group row">
										<div class="col-sm-12">
											<div class="col-auto float-right ml-auto">
												<a href="<?php echo $addURL; ?>?industryId=<?php echo $id; ?>" class="btn add-btn"><i class="fa fa-plus"></i> Add Class Leading</a>
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
														$classLeadSql = "select * from ".PREFIX."class_lead_master where industry_id='".$id."' ORDER BY id DESC ";
														$classLeadResult = $admin->query($classLeadSql);
														$x = 1;
														while($classLeadDetails = $admin->fetch($classLeadResult)){
															$file_name = str_replace('', '-', strtolower( pathinfo($classLeadDetails['image_name'], PATHINFO_FILENAME)));
															$ext = pathinfo($classLeadDetails['image_name'], PATHINFO_EXTENSION);
															$url =  BASE_URL."/images/industry/".$file_name.'_crop.'.$ext;
													?>
															<tr>
																<td><?php echo $x++ ?></td>
																<td><img width="100" src="<?php echo $url; ?>"  /></td>
																<td><?php echo $classLeadDetails['title']; ?></td>
																<td><?php echo $classLeadDetails['description']; ?></td>
																<td>
																	<?php if($classLeadDetails['active']==1) { echo "Active";  } else{ echo "InActive"; } ?>
																</td>
																<td>
																	<a class="btn-transition btn" href="<?php echo $addURL; ?>?edit&id=<?php echo $classLeadDetails['id']; ?>&industryId=<?php echo $id; ?>" title="Edit">   <i class="fa fa-pencil"></i> </a>
																	<a class="btn-transition btn" href="<?php echo $pageURL; ?>?industryId=<?php echo $id; ?>&delId=<?php echo $classLeadDetails['id']; ?>" onclick="return confirm('Are you sure you want to delete?');" title="Delete"> <i class="fa fa-trash-o"></i> </a>
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






								<div class="card-body">
									<div class="form-group row">
										<div class="col-sm-12">
											<div class="col-auto float-right ml-auto">
												<a href="<?php echo $addURL2; ?>?industryId=<?php echo $id; ?>" class="btn add-btn"><i class="fa fa-plus"></i> Add New Class Leading</a>
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
														$classLeadSql = "select * from ".PREFIX."class_lead_master_2 where industry_id='".$id."' ORDER BY id DESC ";
														$classLeadResult = $admin->query($classLeadSql);
														$x = 1;
														while($classLeadDetails = $admin->fetch($classLeadResult)){
															$file_name = str_replace('', '-', strtolower( pathinfo($classLeadDetails['image_name'], PATHINFO_FILENAME)));
															$ext = pathinfo($classLeadDetails['image_name'], PATHINFO_EXTENSION);
															$url =  BASE_URL."/images/industry/".$file_name.'_crop.'.$ext;
													?>
															<tr>
																<td><?php echo $x++ ?></td>
																<td><img width="100" src="<?php echo $url; ?>"  /></td>
																<td><?php echo $classLeadDetails['title']; ?></td>
																<td><?php echo $classLeadDetails['description']; ?></td>
																<td>
																	<?php if($classLeadDetails['active']==1) { echo "Active";  } else{ echo "InActive"; } ?>
																</td>
																<td>
																	<a class="btn-transition btn" href="<?php echo $addURL2; ?>?edit&id=<?php echo $classLeadDetails['id']; ?>&industryId=<?php echo $id; ?>" title="Edit">   <i class="fa fa-pencil"></i> </a>
																	<a class="btn-transition btn" href="<?php echo $pageURL; ?>?industryId=<?php echo $id; ?>&delId2=<?php echo $classLeadDetails['id']; ?>" onclick="return confirm('Are you sure you want to delete?');" title="Delete"> <i class="fa fa-trash-o"></i> </a>
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
		var editor = CKEDITOR.replace( 'image_title', {
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
		var editor = CKEDITOR.replace( 'detail_description1', {
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
		var editor = CKEDITOR.replace( 'detail_description2', {
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
			$('input[name="menu_icon"]').change(function(){
				loadImagePreview(this, (36 / 36));
			});

			$('input[name="listing_image"]').change(function(){
				loadImagePreview(this, (753 / 368));
			});

			$('input[name="image_name"]').change(function(){
				loadImagePreview(this, (1920 / 757));
			});

			$('input[name="detail_banner_image"]').change(function(){
				loadImagePreview(this, (1920 / 306));
			});
			
			$('input[name="detail_image1"]').change(function(){
				loadImagePreview(this, (652 / 895));
			});

			$('input[name="detail_image2"]').change(function(){
				loadImagePreview(this, (652 / 895));
			});


			$("#form").validate({
				ignore: [],
				rules: {
					name:{
						required:true
					},
					permalink:{
						required:true,
						lettersonly:true,
						remote:{
                           url:"ajax-check-industry-name.php",
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
					menu_icon:{
						extension: "png",
						filesize: 2000000
					},
					listing_image:{
						extension: "jpg|jpeg|png|webp",
						filesize: 2000000
					},
					short_description:{
						required:true,
						maxlength:160
					},
					banner_description:{
						required:true,
						maxlength:140
					},
					image_title:{
						required:true
					},
					description:{
						required:true
					},
					detail_banner_image:{
						extension: "jpg|jpeg|png|webp",
						filesize: 2000000
					},
					detail_image1:{
						extension: "jpg|jpeg|png|webp",
						filesize: 2000000
					},
					detail_image2:{
						extension: "jpg|jpeg|png|webp",
						filesize: 2000000
					},
					display_order:{
						required:true,
						number:true,
						min:1
					}
				},
				messages: {
					permalink:{
						remote:"URL already exists."
					},
					menu_icon: {
						extension: "Please upload png image"
					},
					listing_image: {
						extension: "Please upload jpg or png image"
					},
					detail_banner_image: {
						extension: "Please upload jpg or png image"
					},
					detail_image1: {
						extension: "Please upload jpg or png image"
					},
					detail_image2: {
						extension: "Please upload jpg or png image"
					}
				}
			});
			$.validator.addMethod("lettersonly", function(value, element) {
                return this.optional(element) || /^[a-zA-Z0-9\-]*$/.test(value);
            }, "Please enter character/number or - only");

			$.validator.addMethod('filesizevideo', function (value, element, param) {
				return this.optional(element) || (element.files[0].size <= param)
			}, 'File size must be less than 30 MB');
			$.validator.addMethod('filesize', function (value, element, param) {
				return this.optional(element) || (element.files[0].size <= param)
			}, 'File size must be less than 2 MB');
		});
	</script>
</body>
</html>