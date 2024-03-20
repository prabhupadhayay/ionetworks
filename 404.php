<?php 
   include_once 'include/functions.php';
   $functions = new Functions();
?>
<!DOCTYPE html>
<html>
<head>
	<title><?php echo SITE_NAME; ?> || Page Not Found </title>
	<?php include("include/header-link.php");?>
</head>
<body class="innerpage ">
	<main class="root">
		<?php include("include/header.php");?>
		<section class="innerpagebanner-section mtop">
			<img src="<?php echo BASE_URL; ?>/images/procat.png" alt="procat" class="inbanner">
			<div class="inbantext">
				<div class="container p0">
					<h1>Page Not Found</h1>
				</div>
			</div>
		</section>
		<section class="breadcrumb-section">
			<div class="container p0">
				<ul class="breadcrumb-in">
					<li><a href="<?php echo BASE_URL; ?>">Home</a></li>
					<li><a href="javascript:void(0);">Page Not Found</a></li>
				</ul>

				<br>
				<br>
				<br>
				<center><h2>Page Not Found</h2></center>


			</div>
		</section>

	</main>
	<?php include("include/footer.php");?> 
	<?php include("include/footer-link.php");?>
	<script type="text/javascript">
	</script>
</body>
</html>