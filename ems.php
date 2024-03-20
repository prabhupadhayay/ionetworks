<?php 
   include_once 'include/functions.php';
   $functions = new Functions();
	include("include/php-variables.php");
	$sql ="select * from ".PREFIX."ems_cms ";
   $query = $functions->query($sql);
   $emsCMS = $functions->fetch($query);
   $bannerImageData = $functions->getImageUrl('slider-banner', $emsCMS['image_name'], 'crop', '');
   $FaqbannerImageData = $functions->getImageUrl('slider-banner', $emsCMS['faq_banner'], 'crop', '');
?>
<!DOCTYPE html>
<html>
<head>
	<title><?php echo $websitename; ?> || EMS </title>
	<meta name="description" content="A smart, upgradable, easy-to-use application for hassle-free management of all your UBRs">
	<?php include("include/header-link.php");?>
</head>
<body class="innerpage emsspage">
	<main class="root">
		<?php include("include/header.php");?>
		<section class="breadcrumb-section mtop">
			<div class="container p0">
				<ul class="breadcrumb-in">
					<li><a href="<?php echo BASE_URL;?>">Home</a></li>
					<li><a href="<?php echo BASE_URL;?>/products">Products</a></li>
					<li><a href="javascript:void(0);">EMS</a></li>
				</ul>
			</div>
		</section>

		<!-- <div class="backpage">
			<div class="container p0">
				<a  href="javascript:void(0);" onclick="window.history.go(-1); return false;"><span>Back to main page</span></a>
			</div>
		</div> -->

		<section class="cnmsbanner-section">
			<img src="<?php echo $bannerImageData; ?>" alt="ems-banner" class="cnmsbannerimg">
			<div class="cnmstextbox">
				<h1 class="wow fadeIn" data-wow-delay="0.5s"><?php echo $emsCMS['title']; ?></h1>
				<a href="<?php echo $emsCMS['url']; ?>" class="getdemobanbtn wow fadeIn" data-wow-delay="0.55s">Get a demo</a>
			</div>
		</section>

		<section class="yournetwork-section">
			<div class="container p0">
				<div class="yournetwork-in">
					<?php echo $emsCMS['introduction']; ?>
					<div class="networkslist">

						<?php 
							$sql = "select * from ".PREFIX."emsdata_master where active='1' ";
							$query = $functions->query($sql);
							while($emsData = $functions->fetch($query)){
								$emsDataImage = $functions->getImageUrl('ems', $emsData['image_name'], 'crop', '');

						?>
								<div class="networksflex wow fadeInUp" data-wow-delay="0.3s">
									<div class="networksthumb">
										<img src="<?php echo $emsDataImage;?>" alt="operational-efficiency" loading="lazy">
									</div>
									<div class="networkstext">
										<h4><?php echo $emsData['title']; ?></h4>
										<p><?php echo $emsData['description']; ?></p>
									</div>
								</div>
						<?php } ?>
					</div>
				</div>
			</div>
		</section>
		<section class="intutivedashboard-section" style="background-image:url('<?php echo $FaqbannerImageData; ?>');">
			<div class="container p0">
				<div class="intutivedashboard-in">
					<div class="intutivedashboard-acc wow fadeInUp" data-wow-delay="0.5s">
						<div class="headinginbox">
							<h1>Intuitive Dashboard</h1>
						</div>
						<div class="inaccbox">
							<div class="panel-group" id="intutiveaccordion">
							   <?php 
									$sqlems = "select * from ".PREFIX."emsfaq_master where active='1' ";
									$queryems = $functions->query($sqlems);
									$faqCnt = 0;
									while($emsFaq = $functions->fetch($queryems)){
										$faqCnt++;
								?>
									   <div class="panel panel-default">
									     	<div class="panel-heading">
									        	<a class="panel-title intutitle" data-toggle="collapse" aria-expanded="<?php if($faqCnt == 1){ ?>true<?php } else { ?>false<?php } ?>" data-parent="#intutiveaccordion" href="#collapse<?php echo $faqCnt; ?>"><?php echo $emsFaq['question']; ?></a>
									      	</div>
									      	<div id="collapse<?php echo $faqCnt; ?>" class="panel-collapse collapse <?php if($faqCnt == 1){ ?> in <?php } ?>">
									        		<div class="panel-body">
									        			<p><?php echo $emsFaq['answer']; ?></p>
									        	</div>
									     	</div>
									   </div>
								<?php } ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>

		<section class="whycnms-section">
			<div class="container p0">
				<div class="whycnms-in">
					<div class="headinglinebox wow fadeInUp" data-wow-delay="0.5s">
						<h2>Why iEon EMS</h2>
					</div>
					<div class="whycnms-flex">
						<?php 
							$sqlicon = "select * from ".PREFIX."emsicon_master where active='1' ";
							$queryicon = $functions->query($sqlicon);
							while($emsIcon = $functions->fetch($queryicon)){
								$emsIconImage = $functions->getImageUrl('ems', $emsIcon['image_name'], 'crop', '');
						?>
								<div class="whycnms-sub wow fadeInUp" data-wow-delay="0.3s">
									<div class="cnmsicon">
										<img src="<?php echo $emsIconImage;?>" alt="massive" loading="lazy">
									</div>
									<h4><?php echo $emsIcon['title']; ?></h4>
								</div>
					<?php } ?>
					</div>
				</div>
			</div>
		</section>

		<section class="tryourtech-section">
			<div class="container p0">
				<div class="tryourtech-in">
					<h2 class="wow fadeIn" data-wow-delay="0.5s">Try our technology</h2>
					<p class="wow fadeIn" data-wow-delay="0.55s"><?php echo $emsCMS['technology_description']; ?></p>
					<a href="<?php echo $emsCMS['technology_url']; ?>" class="getdemobanbtn wow fadeIn" data-wow-delay="0.6s">Get a demo</a>
				</div>
			</div>
		</section>

	</main>
	<?php include("include/footer.php");?> 
	<?php include("include/footer-link.php");?>
	<script type="text/javascript">
		$('.intutitle').click(function(){
			$('.intutitle').not(this).removeClass('active');
			$(this).toggleClass('active');
		})
	</script>
</body>
</html>