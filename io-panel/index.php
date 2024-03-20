<?php
	include_once 'include/config.php';
	include_once 'include/admin-functions.php';
	$admin = new AdminFunctions();

	if(!$loggedInUserDetailsArr = $admin->sessionExists()){
		header("location: admin-login.php");
		exit();
	}else{
		header("location: banner-master.php");
		exit();
	}
/*
	$pageName = "Products";
	$pageURL = 'index.php';
	$addURL = 'product-add.php';
	$deleteURL = 'index.php';
	$tableName = 'product_master';

	$whereCond = '';
	$whereArray = array();
	if(isset($_GET['search'])) {
		$catArr = array();
		$subcatArr = array();
		if(isset($_GET['subcategory_level2_id']) and count($_GET['subcategory_level2_id'])>0) {
			foreach($_GET['subcategory_level2_id'] as $oneData) {
				$subSubCat = $admin->getUniqueSubCategoryLevel2ById($oneData);
				$subCat = $admin->getUniqueSubCategoryById($subSubCat['category_id']);
				if(!in_array($subSubCat['category_id'], $subcatArr)) {
					$subcatArr[] = $subSubCat['category_id'];
					$catArr[] = $subCat['category_id'];
				}

				$cond = "(subcategory_level2_id='".$oneData."')";
				$whereArray[] = $cond;
			}
		}
		if(isset($_GET['sub_category_id']) and count($_GET['sub_category_id'])>0) {
			foreach($_GET['sub_category_id'] as $oneData) {
				if(!in_array($oneData, $subcatArr)) {
					$subCat = $admin->getUniqueSubCategoryById($oneData);
					if(!in_array($subCat['category_id'], $catArr)) {
						$catArr[] = $subCat['category_id'];
					}

					$cond = "(category_id='".$subCat['category_id']."' and subcategory_id='".$oneData."')";
					$whereArray[] = $cond;
				}
			}
		}
		if(isset($_GET['category_id']) and count($_GET['category_id'])>0) {
			foreach($_GET['category_id'] as $oneData) {
				if(!in_array($oneData, $catArr)) {
					$cond = "(category_id='".$oneData."')";
					$whereArray[] = $cond;
				}
			}
		}
	}

	if(count($whereArray)>0) {
		$whereCond = " AND ".implode(' OR ', $whereArray);
	}

	$sql = "select * from ".PREFIX.$tableName." where category_id NOT IN (1,2,3) and is_deleted=0 ".$whereCond." order by id DESC";
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

		header('location: '.$pageURL.'?updated');
		exit;
	}

	if(isset($_GET['delId']) && !empty($_GET['delId']) ){
		$delId = trim($admin->strip_all($_GET['delId']));

		$admin->deleteProduct($delId);

		header('location: '.$pageURL.'?deletesuccess');
		exit;
	}

	if(isset($_POST['upload'])) {
		$file = $_FILES['upload_csv']['name'];
		move_uploaded_file($_FILES['upload_csv']['tmp_name'],'csv/'.$file);
		$handle = fopen('csv/'.$file,"r");
		$i=0;
		$j=1;

		$SaveImage = new SaveImage();
		$count = 1;
		$imageSizes = array(
			'crop' => array(
				'width' => 1500,
				'suffix' => 'crop'
			),
			'large' => array(
				'width' => 1500,
				'suffix' => 'large'
			),
		);

		$replace_keywords = array('"', ",", "\r", "\n", "\t");
		$find_keywords = array('| ', "|| ", "||| ", "|||| ", "||||| ");

		while(($fileop = fgetcsv($handle,1000,",")) != false) {
			if($j++!=1) {
				$category = str_replace($find_keywords, $replace_keywords, $admin->escape_string($admin->strip_all($fileop[$i++])));
				$sub_cat = str_replace($find_keywords, $replace_keywords, $admin->escape_string($admin->strip_all($fileop[$i++])));
				$sub_category_level2 = str_replace($find_keywords, $replace_keywords, $admin->escape_string($admin->strip_all($fileop[$i++])));
				$product_name = str_replace($find_keywords, $replace_keywords, $admin->escape_string($admin->strip_all($fileop[$i++])));
				$product_code = $admin->escape_string($admin->strip_all($fileop[$i++]));
				$active = $admin->escape_string($admin->strip_all($fileop[$i++]));
				$main_image_link = $admin->escape_string($admin->strip_all($fileop[$i++]));
				$image_flip_link = $admin->escape_string($admin->strip_all($fileop[$i++]));
				$best_seller = $admin->escape_string($admin->strip_all($fileop[$i++]));
				$curated_collection = $admin->escape_string($admin->strip_all($fileop[$i++]));
				$deals_bundles = $admin->escape_string($admin->strip_all($fileop[$i++]));
				$earn_loyalty = $admin->escape_string($admin->strip_all($fileop[$i++]));
				$tax = $admin->escape_string($admin->strip_all($fileop[$i++]));
				$is_split_tax = $admin->escape_string($admin->strip_all($fileop[$i++]));
				$tax2 = $admin->escape_string($admin->strip_all($fileop[$i++]));
				$tax2_amount = $admin->escape_string($admin->strip_all($fileop[$i++]));
				$size_code = $admin->escape_string($admin->strip_all($fileop[$i++]));
				$color = $admin->escape_string($admin->strip_all($fileop[$i++]));
				$size_name = $admin->escape_string($admin->strip_all($fileop[$i++]));
				$hsn_code = $admin->escape_string($admin->strip_all($fileop[$i++]));
				$ean_code = $admin->escape_string($admin->strip_all($fileop[$i++]));
				$customer_price = $admin->escape_string($admin->strip_all($fileop[$i++]));
				$customer_discount_price = $admin->escape_string($admin->strip_all($fileop[$i++]));
				$available_qty = $admin->escape_string($admin->strip_all($fileop[$i++]));
				$pack_of = $admin->escape_string($admin->strip_all($fileop[$i++]));
				$description = str_replace($find_keywords, $replace_keywords, $admin->escape_string($fileop[$i++]));
				$specification = str_replace($find_keywords, $replace_keywords, $admin->escape_string($fileop[$i++]));
				$page_title = $admin->escape_string($admin->strip_all($fileop[$i++]));
				$meta_keyword = $admin->escape_string($admin->strip_all($fileop[$i++]));
				$meta_description = $admin->escape_string($admin->strip_all($fileop[$i++]));

				//permaCode
					$prefix	= '';
					$permalink 	= str_shuffle('1234567890');
					$permalink 	= substr($permalink,0,8);
					$permalink 	= $admin->generate_id($prefix, $permalink, 'product_master', 'permalink');
				//permaCode::end

				$category_id = '';
				$catRS = $admin->query("select * from ".PREFIX."category_master where category_name LIKE '".$category."'");
				if($admin->num_rows($catRS)>0) {
					$cat = $admin->fetch($catRS);
					$category_id = $admin->escape_string($admin->strip_all($cat['id']));
				}

				$subcategory_id = '';
				if(!empty($sub_cat)) {
					$catRS = $admin->query("select * from ".PREFIX."sub_category_master where category_name LIKE '".$sub_cat."'");
					if($admin->num_rows($catRS)>0) {
						$cat = $admin->fetch($catRS);
						$subcategory_id = $admin->escape_string($admin->strip_all($cat['id']));
					}
				}

				$subcategory_level2_id = '';
				if(!empty($sub_category_level2)) {
					$catRS = $admin->query("select * from ".PREFIX."subsubcategory where category_name LIKE '".$sub_category_level2."'");
					if($admin->num_rows($catRS)>0) {
						$cat = $admin->fetch($catRS);
						$subcategory_level2_id = $admin->escape_string($admin->strip_all($cat['id']));
					}
				}

				$createdDate = date('Y-m-d H:i:s');
				$checkRS = $admin->query("select * from ".PREFIX."product_master where product_code='".$product_code."'");
				if($admin->num_rows($checkRS)==0) {
					$sql = "INSERT INTO ".PREFIX."product_master(category_id, subcategory_id, subcategory_level2_id, `product_name`, `product_code`, `tax`, `is_split_tax`, `tax2`, `tax2_amount`, `description`, specification, earn_loyalty, `active`, `permalink`, best_seller, deals_bundles, curated_collection) VALUES ('".$category_id."', '".$subcategory_id."', '".$subcategory_level2_id."', '".$product_name."', '".$product_code."', '".$tax."', '".$is_split_tax."', '".$tax2."', '".$tax2_amount."', '".$description."', '".$specification."', '".$earn_loyalty."', '".$active."', '".$permalink."', '".$best_seller."', '".$deals_bundles."', '".$curated_collection."')";
					$admin->query($sql);
					$product_id = $admin->last_insert_id();
				} else {
					$productDetail = $admin->fetch($checkRS);
					$product_id = $productDetail['id'];

					$sql = "UPDATE ".PREFIX."product_master SET category_id='".$category_id."', subcategory_id='".$subcategory_id."', subcategory_level2_id='".$subcategory_level2_id."', `product_name`='".$product_name."', `product_code`='".$product_code."', `tax`='".$tax."', `is_split_tax`='".$is_split_tax."', `tax2`='".$tax2."', `tax2_amount`='".$tax2_amount."', `description`='".$description."', specification='".$specification."', earn_loyalty='".$earn_loyalty."', `active`='".$active."', best_seller='".$best_seller."', deals_bundles='".$deals_bundles."', curated_collection='".$curated_collection."' WHERE id='".$product_id."'";
					$admin->query($sql);
				}

				$size_id = '';
				$sizeRS = $admin->query("select * from ".PREFIX."size_master where size_name LIKE '".$size_name."'");
				if($admin->num_rows($sizeRS)>0) {
					$size = $admin->fetch($sizeRS);
					$size_id = $admin->escape_string($admin->strip_all($size['id']));
				}

				$color_id = '';
				$colorRS = $admin->query("select * from ".PREFIX."color_master where color LIKE '".$color."'");
				if($admin->num_rows($colorRS)>0) {
					$color = $admin->fetch($colorRS);
					$color_id = $admin->escape_string($admin->strip_all($color['id']));
				}

				$sizecheckRS = $admin->query("select * from ".PREFIX."product_sizes where size_code='".$size_code."'");
				if($admin->num_rows($sizecheckRS)==0) {

					//permaCode
						$prefix	= '';
						$permalink 	= str_shuffle('1234567890');
						$permalink 	= substr($permalink,0,8);
						$permalink 	= $admin->generate_id($prefix, $permalink, 'product_sizes', 'permalink');
					//permaCode::end

					if(!empty($main_image_link)) {
						$main_image = $SaveImage->uploadImageFileFromUrl($main_image_link, $imageSizes, '../images/products/', SaveImage::$RESIZE_TO_WIDTH, time().'-'.$count++);
					} else {
						$main_image = "";
					}

					if(!empty($image_flip_link)) {
						$image_flip = $SaveImage->uploadImageFileFromUrl($image_flip_link, $imageSizes, '../images/products/', SaveImage::$RESIZE_TO_WIDTH, time().'-'.$count++);
					} else {
						$image_flip = "";
					}

					$admin->query("insert into ".PREFIX."product_sizes(product_id, size_id, size_code, hsn_code, ean_code, permalink, customer_price, customer_discount_price, available_qty, color_id, pack_of, `description`, specification, main_image, image_flip, page_title, meta_keyword, meta_description) values ('".$product_id."', '".$size_id."', '".$size_code."', '".$hsn_code."', '".$ean_code."', '".$permalink."', '".$customer_price."', '".$customer_discount_price."', '".$available_qty."', '".$color_id."', '".$pack_of."', '".$description."', '".$specification."', '".$main_image."', '".$image_flip."', '".$page_title."', '".$meta_keyword."', '".$meta_description."')");
				} else {
					$productSize = $admin->fetch($sizecheckRS);
					$product_size_id = $productSize['id'];

					$file_name = str_replace('', '-', strtolower( pathinfo($productSize['main_image'], PATHINFO_FILENAME)));
					$ext = pathinfo($productSize['main_image'], PATHINFO_EXTENSION);
					$size_main_image = BASE_URL.'/images/products/'.$file_name.'_crop.'.$ext;

					$file_name = str_replace('', '-', strtolower( pathinfo($productSize['image_flip'], PATHINFO_FILENAME)));
					$ext = pathinfo($productSize['image_flip'], PATHINFO_EXTENSION);
					$size_image_flip = BASE_URL.'/images/products/'.$file_name.'_crop.'.$ext;

					if($main_image_link != $size_main_image) {
						$main_image = $SaveImage->uploadImageFileFromUrl($main_image_link, $imageSizes, '../images/products/', SaveImage::$RESIZE_TO_WIDTH, time().'-'.$count++);

						$admin->query("update ".PREFIX."product_sizes set main_image='".$main_image."' where id='".$product_size_id."'");
					}

					if($image_flip_link != $size_image_flip) {
						$image_flip = $SaveImage->uploadImageFileFromUrl($main_image_link, $imageSizes, '../images/products/', SaveImage::$RESIZE_TO_WIDTH, time().'-'.$count++);

						$admin->query("update ".PREFIX."product_sizes set image_flip='".$image_flip."' where id='".$product_size_id."'");
					}

					$admin->query("update ".PREFIX."product_sizes set size_id='".$size_id."', size_code='".$size_code."', hsn_code='".$hsn_code."', ean_code='".$ean_code."', customer_price='".$customer_price."', customer_discount_price='".$customer_discount_price."', available_qty='".$available_qty."', color_id='".$color_id."', pack_of='".$pack_of."', `description`='".$description."', specification='".$specification."', page_title='".$page_title."', meta_keyword='".$meta_keyword."', meta_description='".$meta_description."' where id = '".$product_size_id."'");
				}

			}
			$i=0;
		}
		header("location: ".$pageURL."?success");
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
					<div class="col-md-6">
						<form action="" id="form" method="get" enctype="multipart/form-data" autocomplete="off">
							<div class="card">
								<div class="card-header">
									<h4 class="card-title mb-0"> Search</h4>
								</div>
								<div class="card-body">
									<div class="form-group row">
										<div class="col-sm-4">
											<label>Category</label>
											<select class="form-control select" name="category_id[]" id="category_ids" required multiple placeholder="Select Cateogry">
												<?php
													$category_ids_arr = array();
													if(isset($_GET['category_id'])) {
														$category_ids_arr = $_GET['category_id'];
													}

													$categoriesList = $admin->query("select * from ".PREFIX."category_master where id NOT IN (1,2,3) order by category_name ASC");
													while($categories = $admin->fetch($categoriesList)){
												?>
														<option value="<?php echo $categories['id']; ?>" <?php if(isset($_GET['category_id']) && count($category_ids_arr) > 0 && in_array($categories['id'],$category_ids_arr)) { echo "selected"; } ?>><?php echo $categories['category_name']; ?></option>
												<?php
													}
												?>
											</select>
										</div>
										<div class="col-sm-4">
											<label>Sub Category <em>*</em></label>
											<select class="form-control select" name="sub_category_id[]" id="sub_category_id" multiple placeholder="Select Cateogry">
												<?php
													if(isset($_GET['category_id'])) {
														$categories = implode(',', $_GET['category_id']);
														$query = $admin->query("select * from ".PREFIX."sub_category_master where active='1' and category_id IN (".$categories.")");
														$subcatArr = $_GET['sub_category_id'];
														while($row = $admin->fetch($query)) {
												?>
															<option value="<?php echo $row['id']; ?>" <?php if(isset($_GET['sub_category_id']) && in_array($row['id'], $subcatArr)){ echo "selected"; } ?> ><?php echo $row['category_name']; ?></option>
												<?php
														}
													}
												?>
											</select>
										</div>
										<div class="col-sm-4">
											<label>Sub Category Level2<em>*</em></label>
											<select class="form-control select" name="subcategory_level2_id[]" id="subcategory_level2_id" multiple placeholder="Select Cateogry">
												<?php
													if(isset($_GET['sub_category_id'])) {
														$categories = implode(',', $_GET['sub_category_id']);
														$query = $admin->query("select * from ".PREFIX."subsubcategory where category_id IN (".$categories.")");
														$subcatArray = $_GET['subcategory_level2_id'];
														while($row = $admin->fetch($query)) {
												?>
															<option value="<?php echo $row['id']; ?>" <?php if(isset($_GET['subcategory_level2_id']) && in_array($row['id'], $subcatArray)){ echo "selected"; } ?> ><?php echo $row['category_name']; ?></option>
												<?php
														}
													}
												?>
											</select>
										</div>
									</div>
									<div class="form-group row">
										<div class="col-sm-3">
											<label></label><br>
											<button type="submit" name="search" class="btn btn-warning">Search</button>
										</div>
										<div class="col-sm-3">
											<label></label><br>
											<a href="<?php echo $pageURL ?>" name="reset" class="btn btn-primary">Reset</a>
										</div>
									</div>
								</div>
							</div>
						</form>
					</div>

					<div class="col-md-6">
						<form action="" id="form" method="post" enctype="multipart/form-data" autocomplete="off">
							<div class="card">
								<div class="card-header">
									<h4 class="card-title mb-0"> Upload CSV</h4>
								</div>
								<div class="card-body">
									<div class="form-group row">
										<div class="col-sm-6">
											<label>Upload CSV File</label>
											<input type="file" class="form-control" name="upload_csv" id="upload_csv" /><br>
											<a href="export-products.php"> <i class="fa fa-download"></i> Export Product CSV</a>
											<br>
										</div>
										<div class="col-sm-1">
											<label></label><br>
											<button type="submit" name="upload" class="btn btn-warning">Upload</button>
										</div>
									</div>
									<div class="form-group row">
										<em><small>Category, Subcategory, Size and Color name should match the names in masters created</small></em>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>

				<div class="row">
					<div class="col-md-12">
						<table class="table table-striped custom-table mb-0 datatable-selectable-data">
							<thead>
								<tr>
									<th>#</th>
									<th>Display</th>
									<th>Product Image</th>
									<th>Category</th>
									<th>Product Name</th>
									<th>SKU Code</th>
									<th>MRP </th>
									<th>Discounted Price </th>
									<th>Available Qty </th>
									<th>Active</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php
									$x = 1;
									while($row = $admin->fetch($results)){
										$productSize = $admin->fetch($admin->query("select * from ".PREFIX."product_sizes where product_id='".$row['id']."' order by id LIMIT 0,1"));

										$file_name = str_replace('', '-', strtolower( pathinfo($productSize['main_image'], PATHINFO_FILENAME)));
										$ext = pathinfo($productSize['main_image'], PATHINFO_EXTENSION);
										$url =  AWS_S3_BUCKET_PRODUCT_LINK.$file_name.'_crop.'.$ext;
								?>
										<tr>
											<td><?php echo $x++ ?></td>
											<td><input type="text" name="display_order" value="<?php echo $row['display_order']; ?>" style="width: 50px" onchange="updateDisplayOrder(this.value, '<?php echo $row['id'] ?>')"></td>
											<td><img width="50" src="<?php echo $url; ?>"  /></td>
											<td><?php echo $admin->getUniqueCategoryById($row['category_id'])['category_name']; ?></td>
											<td><?php echo $row['product_name']; ?></td>
											<td><?php echo $productSize['size_code']; ?></td>
											<td>
												<div class="tdflex">
												<i class="fa fa-inr"></i> <input type="number" min="1" name="priceinput customer_price" value="<?php echo $productSize['customer_price']; ?>" style="width: 80px" onchange="updateVariantDetails(this.value, '<?php echo $productSize['id'] ?>', 'customer_price')">
												</div>
											</td>
											<td>
												<div class="tdflex">
												<i class="fa fa-inr"></i> <input type="number" min="0" name="priceinput customer_discount_price" value="<?php echo $productSize['customer_discount_price']; ?>" style="width: 80px" onchange="updateVariantDetails(this.value, '<?php echo $productSize['id'] ?>', 'customer_discount_price')">
												</div>
											</td>
											<td><input type="number" min="0" name="available_qty" value="<?php echo $productSize['available_qty']; ?>" style="width:65px" onchange="updateVariantDetails(this.value, '<?php echo $productSize['id'] ?>', 'available_qty')"></td>
											<td>
												<a href="<?php echo $pageURL ?>?status=<?php echo $row['active'];?>&active_id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to update status?');" title="Click to Change Product Status" ><?php echo (($row['active']==1) ? "Yes" : "No"); ?></a>
											</td>
											<td>
												<?php if($row['active']==1) { ?>
													<a href="<?php echo $pageURL ?>?status=<?php echo $row['active'];?>&active_id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to update status?');" title="Mark as Inactive" class="btn-transition btn"><i class="fa fa-close"></i></a>
												<?php } else if($row['active']==0) { ?>
													<a href="<?php echo $pageURL ?>?status=<?php echo $row['active'];?>&active_id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to update status?');" title="Mark as Active" class="btn-transition btn"><i class="fa fa-check"></i></a>
												<?php } ?>
												<a class="btn-transition btn" href="<?php echo $addURL; ?>?edit&id=<?php echo $row['id']; ?>" title="Edit">   <i class="fa fa-pencil"></i> </a>
												<a class="btn-transition btn" href="product-copy.php?id=<?php echo $row['id']; ?>&redirect=<?php echo $pageURL ?>" title="Copy Product"> <i class="fa fa-copy"></i> </a>
												<a class="btn-transition btn" href="product-variants.php?&product_id=<?php echo $row['id']; ?>" title="Product Variants"> <i class="fa fa-list-alt"></i> </a>
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

	<!-- Custom JS -->
	<script src="assets/js/app.js"></script>

	<!-- Validate JS -->
	<script src="assets/js/jquery.validate.js"></script>
	<script src="assets/js/additional-methods.js"></script>

	<script>
		$(document).ready(function() {
			$("#form").validate({
				rules: {
					upload_csv: {
						required: true,
						extension: "csv"
					}
				},
				messages: {
					upload_csv: {
						extension: "Please upload csv file"
					}
				}
			});
			$('.datatable-selectable-data').DataTable({
				"pageLength": 100
			});

			$("select[name='category_id[]']").on("change", function(){
				var category_id = $(this).val();

				$.ajax({
					url:"ajaxGetSubCategoryByCategoryId.php",
					data:{category_id:category_id},
					type:"POST",
					success: function(response){
						$("#sub_category_id").select2('val', response.selectContent);
						$("#sub_category_id").html(response);
					},
					error: function(){
						alert("Unable to get content, please try again");
					},
					complete: function(response){
						
					}
				});
			});

			$('#sub_category_id').on("change",getSubSubCategory);
		});

		function getSubSubCategory() {
			var subcategory = $("#sub_category_id").val();
			$.ajax({
				url:"ajaxGetSubSubCategory.php",
				data:{subcategory:subcategory},
				type:"GET",
				success: function(response){
					var response = JSON.parse(response);
					$("#subcategory_level2_id").select2('val', response.selectContent);
					$("#subcategory_level2_id").html(response.selectContent);
				},
				error: function(){
					alert("Unable to add to cart, pleases try again");
				},
				complete: function(response){
					
				}
			}).then(function (response) {
			    // create the option and append to Select2

				$("#subcategory_level2_id").html(response.selectContent);
			});;
		}

		function updateDisplayOrder(display_order, product_id) {
			$.ajax({
				url:"ajaxUpdateDisplayOrder.php",
				data:{display_order: display_order, product_id: product_id},
				type:"POST",
				success: function(response){
					location.reload();
				},
				error: function(){
					alert("Unable to get content, please try again");
				},
				complete: function(response){
					
				}
			});
		}

		function updateVariantDetails(field_value, product_size_id, field_name) {
			$.ajax({
				url:"ajaxUpdateVariantDetails.php",
				data:{field_value: field_value, product_size_id: product_size_id, field_name: field_name},
				type:"POST",
				success: function(response){
					location.reload();
				},
				error: function(){
					alert("Unable to get content, please try again");
				},
				complete: function(response){
					
				}
			});
		}
	</script>
</body>
</html>
<?php */ ?>