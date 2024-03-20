<?php 
   include_once 'include/functions.php';
   $functions = new Functions();
   $whereClasue = "";
   if(isset($_POST['industryIds']) && !empty($_POST['industryIds'])){
		$sizeId = implode(",", $_POST['industryIds']);
		$whereClasue =" and id IN (".$sizeId.")";
	}

	$sqlIndustry ="select * from ".PREFIX."industry_master where active='1' ".$whereClasue." ORDER BY display_order ASC ";
	$queryIndustry = $functions->query($sqlIndustry);
	while($industryDetails = $functions->fetch($queryIndustry)){
		$industryImage = $functions->getImageUrl('industry', $industryDetails['listing_image'], 'crop', '');
?>
	<div class="indusrylistrow wow fadeInUp" data-wow-delay="0.5s">
		<div class="indusrythumb">
			<img src="<?php echo $industryImage; ?>" alt="<?php echo $industryDetails['name']; ?>" loading="lazy">
		</div>
		<div class="indusrytext">
			<h2><?php echo $industryDetails['name']; ?></h2>
			<p><?php echo $industryDetails['short_description']; ?></p>
			<a href="<?php echo BASE_URL; ?>/industries/<?php echo $industryDetails['permalink']; ?>" class="knowbtn">Know More</a>
		</div>
	</div>
<?php } ?>
