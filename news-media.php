<?php 
   include_once 'include/functions.php';
   $functions = new Functions();
   $sql ="select * from ".PREFIX."media_listing_cms ";
   $query = $functions->query($sql);
   $mediaCMS = $functions->fetch($query);
   $bannerImageData = $functions->getImageUrl('slider-banner', $mediaCMS['image_name'], 'crop', '');

   

   if(isset($_GET['permalink'])){
      if($_GET['permalink'] == 'PressRelease'){
         $PressRelease = "PressRelease";
      }else if($_GET['permalink'] == 'Events'){
         $Events="Events";
      }
   }
?>

<!DOCTYPE html>

<html>

<head>

	<title><?php echo SITE_NAME; ?> || News & Media </title>
	<?php if($_GET['permalink'] == 'PressRelease'): ?>
		<meta name="description" content="Know more about why IO by HFCL is hitting the headlines with some major breakthroughs with its pathbreaking innovations">
<?php elseif ($_GET['permalink'] == 'Events'): ?>
	<meta name="description" content="Know more about why IO by HFCL is in the news today, accelerating digital trasformation and chaning the way we connect">
	
<?php else: ?>
	<meta name="description" content="Delve into some of IO by HFCL's major Press Release and Events to stay updated with our latest milestones achieved">
<?php endif; ?>
	<?php include("include/header-link.php");?>

</head>

<body class="innerpage industry">

	<main class="root">

		<?php include("include/header.php");?>

		<section class="innerpagebanner-section mtop">

			<img src="<?php echo $bannerImageData; ?>" alt="newsbanner" class="inbanner">

			<div class="inbantext">

				<div class="container p0">

					<h1 class="wow fadeInUp" data-wow-delay="0.5s"><?php echo $mediaCMS['title']; ?></h1>

					<p class="wow fadeInUp" data-wow-delay="0.55s"><?php echo $mediaCMS['description']; ?></p>

				</div>

			</div>

		</section>

		<section class="breadcrumb-section">

			<div class="container p0">

				<ul class="breadcrumb-in">

					<li class="wow fadeIn" data-wow-delay="0.5s"><a href="<?php echo BASE_URL; ?>">Home</a></li>

					<li class="wow fadeIn" data-wow-delay="0.55s"><a href="javascript:void(0);">News & Media</a></li>

				</ul>

			</div>

		</section>

		

		<section class="industrylist-section" id="pressid">
			<div class="container p0">
				<div class="industrylist-in">
					<div class="checkbox-dropdown">
						 	Select Type
							<ul class="checkbox-dropdown-list">
						   	<li>
						       	<input type="checkbox" value="PressRelease" name="IndustryType" id="ind1" class="PressRelease filterMedia" />
						      	<label for="ind1">Press Release</label>
						   	</li>
						    <li>
						        <input type="checkbox" value="Events" name="IndustryType" id="ind3" class="Events filterMedia" />
						      	<label for="ind3">Events</label>
						    </li>
						</ul>
					</div>

					<div class="allnewsandmediabox">
						<div class="allnewsandmediagrid">
							<?php 
								if(isset($PressRelease)){
									$sqlMedia ="select * from ".PREFIX."media_master where type='PressRelease' AND active='1' ORDER BY media_date DESC ";
								}else if(isset($Events)){
									$sqlMedia ="select * from ".PREFIX."media_master where type='Events' AND active='1' ORDER BY media_date DESC ";
								}else{
									$sqlMedia ="select * from ".PREFIX."media_master where active='1' ORDER BY media_date DESC ";
								}
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
										<p class="match"><?php echo $mediaDetails['short_description']; ?></p>
										<h5><?php echo date("F j, Y", strtotime($mediaDetails['media_date'])); ?></h5>
										<!-- <a href="<?php //echo BASE_URL; ?>/media/<?php //echo $mediaDetails['permalink']; ?>" class="knowbtn">Read More</a> -->
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
		$(document).ready(function(){
			$(document).on("change", ".filterMedia", function() {
				filterFunction();
			});
		});

		function filterFunction(){
			var mediaType = [];
			$(".filterMedia").each(function(){
				if($(this).prop("checked") == true) {
					mediaType.push($(this).val());
				}
			});

			$.ajax({
				url:"<?php echo BASE_URL; ?>/ajax-filter-media.php",
				data:{
					mediaType: mediaType,
				},
				type:"POST",
				success: function(response){
					$('.allnewsandmediabox').html(response);
				},
				error: function(){
					console.log("Unable to load data, please try again");
				},
				complete: function(response){
					MatchHeight1();
				}
			});
		}
	</script>

	<script type="text/javascript">
		  $('.checkbox-dropdown').on("click", function(event)
		  {
		    $(this).toggleClass('is-active');
		    $('.checkbox-dropdown-list').slideToggle();
		      event.stopPropagation();
		  });

		  $('.checkbox-dropdown, .checkbox-dropdown-list').on("click", function(event)
		  {
		      event.stopPropagation();
		  });

		  $(document).on("click", function(event)
		  {
		    $('.checkbox-dropdown').removeClass('is-active');
		    $('.checkbox-dropdown-list').slideUp();
		 });

		if ($(window).width() < 800) {
            <?php
                if(isset($_GET['action'])){
                ?>               
                    $('html, body').animate({scrollTop: $( '#pressid' ).offset().top - 200}, 500);
                    $('.<?php echo $_GET['action']; ?>').attr('checked', true);
                <?php
                }
            ?>
        }

        if ($(window).width() > 800) {
            <?php
               	if(isset($_GET['action'])){
            	?>               
                	$('html, body').animate({scrollTop: $( '#pressid' ).offset().top - 120}, 500);
                 	$('.<?php echo $_GET['action']; ?>').attr('checked', true);
             	<?php
                }
            ?>
        }
	</script>

</body>

</html>