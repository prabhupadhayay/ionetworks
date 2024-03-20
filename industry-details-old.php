<?php include("include/php-variables.php");?>
<!DOCTYPE html>
<html>
<head>
	<title><?php echo $websitename; ?> || Industry Details </title>
	<?php include("include/header-link.php");?>
</head>
<body class="innerpage industrydetails">
	<main class="root">
		<?php include("include/header.php");?>
		<section class="breadcrumb-section mtop">
			<div class="container p0">
				<ul class="breadcrumb-in">
					<li class="wow fadeIn" data-wow-delay="0.5s"><a href="index.php">Home</a></li>
					<li class="wow fadeIn" data-wow-delay="0.55s"><a href="industry.php">Industry</a></li>
					<li class="wow fadeIn" data-wow-delay="0.6s"><a href="javascript:void(0);">Government</a></li>
				</ul>
			</div>
		</section>
		
		<section class="article-section">
			<div class="container p0">
				<div class="article-in">

					<div class="backpage">
						<a href="industry.php"><span>Back to main page</span></a>
					</div>

					<div class="mainarticle-box">

						<h2>Lorem Ipsum is simply dummy text of <br>the printing and typesetting industry</h2>

						<div class="article-thumb">
							<img src="images/indinside.png" alt="indinside">
						</div>

						<div class="articlebottom">
							<div class="articletext">
								<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
								<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
								<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
								<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
							</div>

							<div class="articlecatlist wow fadeInUp" data-wow-delay="0.5s">
								<div class="otherlisthead">
									<h4>Other Industries</h4>
								</div>
								<div class="bottomlistbox">
									<ol>
										<li><a href="#">Enterprises</a></li>
										<li><a href="#">Hospitality</a></li>
										<li><a href="#">Education</a></li>
										<li><a href="#">Healthcare</a></li>
										<li><a href="#">Retail</a></li>
									</ol>
								</div>
							</div>
						</div>

					</div>

				</div>
			</div>
		</section>

		<section class="commoncontact-section">
			<div class="container p0">
				<div class="commoncontact-in">
					<?php include('commoncontact.php');?>
				</div>
			</div>
		</section>

	</main>

	<?php include("include/footer.php");?> 
	<?php include("include/footer-link.php");?>

	<script type="text/javascript">
		$(".checkbox-dropdown").click(function () {
		    $(this).toggleClass("is-active");
		    $('.checkbox-dropdown-list').slideToggle();
		});

		$(".checkbox-dropdown ul").click(function(e) {
		    e.stopPropagation();
		});

	</script>
</body>
</html>