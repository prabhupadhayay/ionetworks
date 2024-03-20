<?php
	include_once 'include/config.php';
	include_once 'include/admin-functions.php';
	$admin = new AdminFunctions();

	if(!$loggedInUserDetailsArr = $admin->sessionExists()){
		header("location: admin-login.php");
		exit();
	}

	$pageName = "Slider Banner";
	$pageURL = 'banner-master.php';
	$addURL = 'banner-add.php';
	$deleteURL = 'banner-master.php';
	$tableName = 'slider_banner';

	$sql = "select * from ".PREFIX.$tableName." order by id DESC";
	$results = $admin->query($sql);

	if(isset($_GET['status']) && isset($_GET['status']) && !empty($_GET['active_id']) && !empty($_GET['active_id'])){
		$status = trim($admin->strip_all($_GET['status']));
		$active_id = trim($admin->strip_all($_GET['active_id']));
		if($status=="1"){
			$updatestatus = '0';
		}elseif($status=="0"){
			$updatestatus = '1';
		}

		$sql="UPDATE ".PREFIX.$tableName." SET `active`='".$updatestatus."'  WHERE id='".$active_id."'";
		$admin->query($sql);
		header('location: '.$pageURL.'?updatesuccess');
		exit;
	}

	if(isset($_GET['delId']) && !empty($_GET['delId']) ){
		$delId = trim($admin->strip_all($_GET['delId']));
		$admin->deleteSliderBanner($delId);
		header('location: '.$pageURL.'?deletesuccess');
		exit;
	}


	if(isset($_POST['update'])){
		$updateVideo = $admin->updateBannerVideo($_POST, $_FILES);
		header('location: '.$pageURL.'?updatesuccess');
		exit;
	}

	$_GET['edit'] = 'edit';
	$sqlVideo = "select * from ".PREFIX."home_cms";
	$resultsVideo = $admin->fetch($admin->query($sqlVideo));
			
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
	<!-- Crop Image css -->
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
						<div class="col-auto float-right ml-auto">
							<a href="<?php echo $addURL; ?>" class="btn add-btn"><i class="fa fa-plus"></i> Add <?php echo $pageName; ?></a>
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
									<h4 class="card-title mb-0"> Banner Video</h4>
								</div>
								<div class="card-body">
									<div class="form-group row">
										<div class="col-sm-3">
											<label>Banner Video</label>
											<input type="file" class="form-control" name="banner_video">
											<span class="help-block" id="dim">(Size: MAX 8MB/ MP4 Only`)</span>
											<?php 
												if(isset($_GET['edit']) && !empty($resultsVideo['banner_video'])) {
											?>
											<br><br>
											<a target="_blank" href="<?php echo BASE_URL; ?>/images/videos/<?php echo $resultsVideo['banner_video']; ?>">View Video</a><br>
											<?php
												} 
											?>
										</div>
										<div class="col-md-3">
											<label>Banner Image <em>*</em></label>
											<input type="file" class="form-control" <?php if(isset($_GET['edit'])){if(empty($resultsVideo['banner_image'])){ echo "required"; } }else{ echo "required"; }?> name="banner_image" id="1" data-image-index="0" />
											<span class="help-text">
												Files must be less than <strong>5 MB</strong>.<br>
												Allowed file types: <strong>jpg|jpeg|png</strong>.<br>
												Images must be exactly <strong>1920 x 860</strong> pixels.
											</span>
											<?php if(isset($_GET['edit'])) {
												$file_name = str_replace('', '-', strtolower( pathinfo($resultsVideo['banner_image'], PATHINFO_FILENAME)));
												$ext = pathinfo($resultsVideo['banner_image'], PATHINFO_EXTENSION);
											?>
												<img src="../images/home-banners/<?php echo $file_name.'_crop.'.$ext ?>" width="200" />
											<?php
											} ?>
										</div>
										<div class="col-sm-3">
											<label>Banner Title <em>*</em></label>
											<input type="text" required class="form-control" name="banner_title" id="" value="<?php if(isset($_GET['edit'])){ echo $resultsVideo['banner_title']; }?>"/>
										</div>
										<div class="col-sm-3">
											<label>Active</label>
											<select class="form-control" name="video_active">
												<option value="1" <?php if(isset($_GET['edit']) and $resultsVideo['video_active']=='1') { echo 'selected'; } ?>>Banner Image</option>
												<option value="0" <?php if(isset($_GET['edit']) and $resultsVideo['video_active']=='0') { echo 'selected'; } ?>>Banner Video</option>
											</select>
										</div>
									</div>
								</div>
							</div>
							<div class="form-actions text-right">
								<button type="submit" name="update" value="update" id="update" class="btn btn-warning"><i class="icon-pencil"></i>Update Subscription Banner</button>
							</div>
						</form>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<table class="table table-striped custom-table mb-0 datatable datatable-selectable-data">
							<thead>
								<tr>
									<th>#</th>
									<th>Image</th>
									<th>Active</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php
									$x = 1;
									while($row = $admin->fetch($results)){
										$file_name = str_replace('', '-', strtolower( pathinfo($row['image_name'], PATHINFO_FILENAME)));
										$ext = pathinfo($row['image_name'], PATHINFO_EXTENSION);
										$url =  BASE_URL."/images/home-banners/".$file_name.'_crop.'.$ext;
								?>
										<tr>
											<td><?php echo $x++ ?></td>
											<td><img width="100" src="<?php echo $url; ?>"  /></td>
											<td>
												<a href="<?php echo $pageURL ?>?status=<?php echo $row['active'];?>&active_id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to update status?');" title="Click to Change Status" ><?php echo (($row['active']==1) ? "Yes" : "No"); ?></a>
											</td>
											<td>
												<?php if($row['active']==1) { ?>
													<a href="<?php echo $pageURL ?>?status=<?php echo $row['active'];?>&active_id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to update status?');" title="Mark as Inactive" class="btn-transition btn"><i class="fa fa-close"></i></a>
												<?php } else if($row['active']==0) { ?>
													<a href="<?php echo $pageURL ?>?status=<?php echo $row['active'];?>&active_id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to update status?');" title="Mark as Active" class="btn-transition btn"><i class="fa fa-check"></i></a>
												<?php } ?>
												<a class="btn-transition btn" href="<?php echo $addURL; ?>?edit&id=<?php echo $row['id']; ?>" title="Edit">   <i class="fa fa-pencil"></i> </a>
												<a class="btn-transition btn" href="<?php echo $deleteURL; ?>?delId=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to delete?');" title="Delete"> <i class="fa fa-trash-o"></i> </a>
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
		<!-- Validate JS -->
	<script src="assets/js/jquery.validate.js"></script>
	<script src="assets/js/additional-methods.js"></script>
	<!-- Crop Image js -->
	<script src="assets/js/crop-image/cropper.min.js"></script>
	<script src="assets/js/crop-image/image-crop-app.js"></script>

	<!-- Custom JS -->
	<script src="assets/js/app.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			$("#form").validate({
				rules: {
					banner_video:{
						extension: 'mp4'/*,
						filesize: 8000000*/
					},
					banner_image: {
						extension: 'png|jpg|jpeg',
						filesize: 5000000
					},
				},
				messages: {
					banner_video:{
						extension: "Please upload mp4 format file only."
					}
				}
			});
			$.validator.addMethod('filesize', function (value, element, param) {
				return this.optional(element) || (element.files[0].size <= param)
			}, 'File size must be less than 5 MB');

			$.validator.addMethod('bannerfilesize', function (value, element, param) {
				return this.optional(element) || (element.files[0].size <= param)
			}, 'File size must be less than 2 MB');



			$('input[name="banner_image"]').change(function(){
				loadImagePreview(this, (1920 / 860));
			});
		});
	</script>
</body>
</html>