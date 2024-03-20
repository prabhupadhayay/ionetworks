<?php 
   include_once 'include/functions.php';
   $functions = new Functions();
   $whereClasue = "";
   if(isset($_POST['mediaType']) && !empty($_POST['mediaType'])){
		$mediaType = implode("','", $_POST['mediaType']);
		$whereClasue =" and type IN ('".$mediaType."')";
	}
?>
						<div class="allnewsandmediagrid">
							<?php
								$sqlMedia ="select * from ".PREFIX."media_master where active='1' ".$whereClasue." ORDER BY media_date DESC ";
		
								$queryMedia = $functions->query($sqlMedia);
								while($mediaDetails = $functions->fetch($queryMedia)){
									$mediaImage = $functions->getImageUrl('media', $mediaDetails['listing_image'], 'crop', '');
							?>
								<div class="newsmediasub wow fadeInUp" data-wow-delay="0.5s">
									<div class="newsmediathumb">
										<img src="<?php echo $mediaImage; ?>" alt="1" loading="lazy">
									</div>
									<div class="newsmediatext">
										<h4><?php echo $mediaDetails['title']; ?></h4>
										<p><?php echo $mediaDetails['short_description']; ?></p>
										<h5><?php echo date("F j, Y", strtotime($mediaDetails['media_date'])); ?></h5>
										<?php 
											if(!empty($mediaDetails['third_party_url'])){
										?>
											<a target="_blank" href="<?php echo $mediaDetails['third_party_url']; ?>" class="knowbtn">Read More</a>
										<?php
											}else{
										?>
											<a href="<?php echo BASE_URL; ?>/news&media/<?php echo $mediaDetails['permalink']; ?>" class="knowbtn">Read More</a>
										<?php } ?>
										
									</div>
								</div>
							<?php } ?>
						</div>

						<!-- <div class="pagination_blog">
							<a href="#" class="active">1</a>
							<a href="#">2</a>
							<a href="#">3</a>
							<a href="#">4</a>
						</div> -->
