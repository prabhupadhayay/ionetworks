<?php 
   include_once 'include/functions.php';
   $functions = new Functions();

   if(isset($_GET['permalink']) && !empty($_GET['permalink'])){
   		$permalink = $functions->escape_string($functions->strip_all($_GET['permalink']));
   		$categoryDetails = $functions->getSubCategoryDetailsByPermalink($permalink);
   		$bannerImage = $functions->getImageUrl('slider-banner', $categoryDetails['image_name'], 'crop', '');
   }else{
   	header("location: ".BASE_URL."/products");
		exit();
   }
?>

<!DOCTYPE html>

<html>

<head>

	<title><?php echo SITE_NAME; ?> || <?php echo $categoryDetails['title']; ?> </title>
	
    <?php if($categoryDetails['title'] == "Commercial Access Switch"): ?>
		<meta name="description" content="Highly optimized Commercial Access Switches for all wired and wireless networking applications">
<?php elseif ($categoryDetails['title'] == "Industrial Access Switch"): ?>
	<meta name="description" content="Rugged switches designed to handle extreme environment conditions and provide industrial-grade reliability, security and easy management">
	<?php elseif ($categoryDetails['title'] == "Aggregation Switch"): ?>
	<meta name="description" content="High performance Layer-2 and Layer-3 switching solution that offers flexible network designs and scalability with multiple 10G backhaul.">
	<?php elseif ($categoryDetails['title'] == "P2P Unlicensed Band Radio"): ?>
	<meta name="description" content="Best-of-breed backhaul equipment that delivers finest performance in long distance applications for reliable Internet connectivity">
	<?php elseif ($categoryDetails['title'] == "P2MP Unlicensed Band Radio"): ?>
	<meta name="description" content="Backhaul solution with enhanced adaptability of the changing environment and higher capacity at multiple sites">
	<?php elseif ($categoryDetails['title'] == "Power Solutions AC /DC PoE Injectors"): ?>
	<meta name="description" content="A comprehensive portfolio of power solutions optimized to deliver a secure, reliable network solution">
	<?php elseif ($categoryDetails['title'] == "Antennas"): ?>
	<meta name="description" content="Versatile antennas for providing impeccable support to data traffic demands">
<?php else: ?>
	<meta name="description" content="IO by HFCL's Access Points are equipped with the latest Wi-Fi standards to appropriately accommodate your bandwidth requirements">
<?php endif; ?>


	<?php include("include/header-link.php");?>

</head>

<body class="innerpage accesspoints">

	<main class="root">

		<?php include("include/header.php");?>

		<section class="innerpagebanner-section mtop">

			<img src="<?php echo $bannerImage; ?>" alt="accesspoint" class="inbanner">
			<?php if($permalink == 'access-points'){ ?>
				<img src="<?php echo BASE_URL; ?>/images/catbanimg.png" alt="catbanimg" class="cenbanimg">
			<?php } ?>
			<div class="inbantext">

				<div class="container p0">

					<h1 class="wow fadeInUp" data-wow-delay="0.5s"><?php echo $categoryDetails['title']; ?></h1>

					<p class="wow fadeInUp" data-wow-delay="0.55s"><?php echo $categoryDetails['description']; ?></p>

				</div>

			</div>

		</section>

		<section class="breadcrumb-section">

			<div class="container p0">

				<ul class="breadcrumb-in">

					<li class="wow fadeIn" data-wow-delay="0.5s"><a href="<?php echo BASE_URL; ?>">Home</a></li>

					<li class="wow fadeIn" data-wow-delay="0.55s"><a href="<?php echo BASE_URL; ?>/products">Products</a></li>
					<li class="wow fadeIn" data-wow-delay="0.6s"><a href="javascript:void(0);"><?php echo $categoryDetails['category_name']; ?></a></li>

				</ul>

			</div>

		</section>

		

		<section class="delivaring-perfection-section">
            

<!-- copy this stuff and down -->
<div id="video-popup-overlay"></div>

<div id="video-popup-container">
  <div id="video-popup-close" class="fade">&#10006;</div>
  <div id="video-popup-iframe-container">
    <iframe id="video-popup-iframe" src="" width="100%" height="100%" frameborder="0"></iframe>
  </div>
</div>


			<img src="<?php echo BASE_URL;?>/images/horizaontalimg.png" alt="horizaontalimg" class="horizaontalimgbg">

			<div class="container p0">

				<div class="delivaring-perfection-in">

					<h2 class="wow fadeIn" data-wow-delay="0.5s"><?php echo $categoryDetails['page_title']; ?></h2>
					<p class="wow fadeIn" data-wow-delay="0.55s"><?php echo $categoryDetails['page_description']; ?></p>
					<?php 
						$image1 = $functions->getImageUrl('category', $categoryDetails['image1'], 'crop', '');
						$image2 = $functions->getImageUrl('category', $categoryDetails['image2'], 'crop', '');
						$image3 = $functions->getImageUrl('category', $categoryDetails['image3'], 'crop', '');
					?>
					<div class="delivaringflex">
						<div class="delivaringsub match wow fadeInUp" data-wow-delay="0.5s">
							<div class="delicon">
								<img src="<?php echo $image1; ?>" alt="delicon1" loading="lazy">
							</div>
							<h4><?php echo $categoryDetails['title1']; ?></h4>
						</div>
						<div class="delivaringsub match wow fadeInUp" data-wow-delay="0.55s">
							<div class="delicon">
								<img src="<?php echo $image2; ?>" alt="delicon2" loading="lazy">
							</div>
							<h4><?php echo $categoryDetails['title2']; ?></h4>
						</div>

						<div class="delivaringsub match wow fadeInUp" data-wow-delay="0.6s">
							<div class="delicon">
								<img src="<?php echo $image3; ?>" alt="delicon3" loading="lazy">
							</div>
							<h4><?php echo $categoryDetails['title3']; ?></h4>
						</div>
					</div>
				</div>
			</div>
		</section>


		<?php 
			$sqlVarient = "select * from ".PREFIX."varient_master where active='1' AND sub_category_id='".$categoryDetails['id']."' ";
			$verientQuery = $functions->query($sqlVarient);
			if($functions->num_rows($verientQuery) >0){
		?>
		<section class="indoorandoutdoor-section">
			<img src="<?php echo BASE_URL;?>/images/leftbig.png" alt="leftbig" class="ltimggg">
			<div class="container p0">
				<div class="indoorandoutdoor-in">
					<ul class="nav nav-pills inouttabs">
						<?php 
							$vCount = 1;
							while($vData = $functions->fetch($verientQuery)){
						?>
					    <li <?php if($vCount == '1'){ ?> class="active" <?php } ?>><a data-toggle="tab" href="#tab<?php echo $vCount; ?>"><?php echo $vData['name']; ?></a></li>
					   <?php $vCount++; } ?>
					</ul>
					<div class="tab-content inouttabscontent">
					<?php 
						$sqlVarient1 = "select * from ".PREFIX."varient_master where active='1' AND sub_category_id='".$categoryDetails['id']."' ";
						$verientQuery1 = $functions->query($sqlVarient1);
						$vCount1 = 1;
						while($vData1 = $functions->fetch($verientQuery1)){
					?>
					    <div id="tab<?php echo $vCount1; ?>" class="tab-pane fade <?php if($vCount1 == '1') { ?> in active <?php } ?> ">
					    	<div class="inoutsubbox">
					    		<?php 
					    			$subvarientProductList = $functions->query("select * from ".PREFIX."product_master where active='1' AND varient_id='".$vData1['id']."' AND only_for_documentation = '0' AND sub_varient_id !='' GROUP BY sub_varient_id ");
						    			while($subvarientProducData = $functions->fetch($subvarientProductList)){
						    				$subVarientDetails = $functions->getUniqueSubVarientById($subvarientProducData['sub_varient_id']);

					    		?>
					    			<h3><?php echo $subVarientDetails['name']; ?></h3>
						    		<p><?php echo $subVarientDetails['description']; ?></p>
							    	<div class="inoutsliderbox">
							    		<div class="inoutslider thinslicksliderarrow">
							    		<?php 
							    			$varientProductList = $functions->query("select * from ".PREFIX."product_master where active='1' AND varient_id='".$vData1['id']."' AND only_for_documentation = '0' AND sub_varient_id = '".$subvarientProducData['sub_varient_id']."' ");
							    			while($varientProducData = $functions->fetch($varientProductList)){
							    				$proImage = $functions->getImageUrl('product', $varientProducData['home_image'], 'crop', '');
							    		?>
								    			<div class="inoutslide match">
								    				<div class="inoutslideimg">
								    					<img src="<?php echo $proImage; ?>" alt="imgslide" loading="lazy">
								    				</div>
									    			<h4><?php echo $varientProducData['product_name']; ?></h4>
									    			<a href="<?php echo BASE_URL; ?>/products/<?php echo $permalink; ?>/<?php echo $varientProducData['permalink']; ?>" class="knowbtn">Read More</a>
								    			</div>
							    		<?php } ?>
							    		</div>
							    	</div>
					    		<?php } ?>
						    	<div class="inoutsliderbox">
						    		<div class="inoutslider thinslicksliderarrow">
						    		<?php 
						    			$varientProductList = $functions->query("select * from ".PREFIX."product_master where active='1' AND varient_id='".$vData1['id']."' AND sub_varient_id='' ");
						    			while($varientProducData = $functions->fetch($varientProductList)){
						    				$proImage = $functions->getImageUrl('product', $varientProducData['home_image'], 'crop', '');
						    		?>
							    			<div class="inoutslide match">
							    				<div class="inoutslideimg">
							    					<img src="<?php echo $proImage; ?>" alt="imgslide" loading="lazy">
							    				</div>
								    			<h4><?php echo $varientProducData['product_name']; ?></h4>
								    			<a href="<?php echo BASE_URL; ?>/products/<?php echo $permalink; ?>/<?php echo $varientProducData['permalink']; ?>" class="knowbtn">Read More</a>
							    			</div>
						    		<?php } ?>
						    		</div>
						    	</div>
						    </div>
					    </div>
					   <?php $vCount1++; } ?>
					</div>
				</div>
			</div>
		</section>
		<?php } ?>


		<?php 
			if(!empty($categoryDetails['comparison'])){
		?>
		<section class="productcomparison-section">
			<div class="container p0">
				<div class="productcomparison-in">
					<h2 class="wow fadeIn" data-wow-delay="0.5s">Product Comparison</h2>
					<div class="productcomparison-tablewrap">
						<?php echo $categoryDetails['comparison']; ?>
					</div>
				</div>
			</div>
		</section>
	<?php } ?>

		
	<?php 
		$faqList = "select * from ".PREFIX."faq_master where active='1' AND category_id='".$categoryDetails['id']."' ";
		$queryFaq = $functions->query($faqList);
		if($functions->num_rows($queryFaq) > 0){
	?>
		<section class="faqs-section">
			<img src="<?php echo BASE_URL;?>/images/rightbottom.png" alt="rightbottom" class="faqbgright">
			<div class="container p0">
				<div class="faqs-in">
					<h2>FAQs</h2>
					<div class="faqs-box">
						<div class="faqs-list">
							<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
							<?php
									$faqSr = 1;
									while($feqDetails = $functions->fetch($queryFaq)){
							?>
										<div class="panel panel-default">
											<div class="panel-heading" role="tab" id="heading1">
												<a class="panel-title" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $faqSr; ?>" aria-expanded="true" aria-controls="collapse<?php echo $faqSr; ?>">
														<i class="more-less glyphicon glyphicon-plus"></i><?php echo $feqDetails['question']; ?>
												</a>
											</div>
											<div id="collapse<?php echo $faqSr; ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading1">
												<div class="panel-body">
													<p><?php echo $feqDetails['answer']; ?></p>
												</div>
											</div>
										</div>
							<?php $faqSr++; } ?>

							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
	<?php } ?>



	
		<section class="blogsection blogsectionnew">
			<img src="<?php echo BASE_URL;?>/images/faqsrotate.png" alt="faqsrotate" class="faqsrotateimg">
			<div class="container p0">

				<div class="blogsinner">

					<h2 class="wow fadeIn" data-wow-delay="0.5s">Blog</h2>

					<div class="blogshowbox">
			         <?php
			            include_once('blog/wp-load.php');

			               $recent_posts = wp_get_recent_posts();
			         ?>
			         	<?php
			         		$x=1;
			         		$u=0.5;
			         		$runTill = 1;
			         			foreach($recent_posts as $key=>$post){
			         				$categoryArr = array();
										$category_detail=get_the_category($post['ID']);
										foreach($category_detail as $key1 => $value){
											$categoryArr[] = $category_detail[$key1]->cat_name;
										}


										if(in_array($permalink, $categoryArr)){


			         				$image = wp_get_attachment_image_src( get_post_thumbnail_id($post['ID']), 'single-post-thumbnail' );
			                     $feat_image = wp_get_attachment_url( get_post_thumbnail_id($post['ID'])); 
			                     $author_id = get_post_field ('post_author', $cause_id);
										$display_name = get_the_author_meta( 'display_name' , $author_id );                           
			             ?> 
											<div class="blogssub match wow fadeInUp" data-wow-delay="<? echo $u;?>s">

												<div class="blogthumb">

													<img src="<?php echo $feat_image; ?>" alt="<?php echo $post['post_title']; ?>">

												</div>

												<div class="blogtext">

													<h4><?php echo $post['post_title']; ?></h4>

													<p><?php echo substr(strip_tags($post['post_content']),0,60).'...'; ?></p>

													<a href="<?php echo get_permalink($post['ID']); ?>" class="knowbtn">Read More</a>

												</div>

											</div>
							<?php 
			               $x++;
			               $u+=0.5; 
			               $runTill++;

			               if($runTill == 4){
			               	break;
			               }
			            }  }

			           ?>
						

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

		$(document).ready(function($){

			var table = $('#example1').DataTable({

				responsive: true,

				"columnDefs": [

				{ "searchable": false, "targets": 0 },

				{ "sortable": false, "targets": 0 },



				],

				"order": [[ 1, "asc" ]],

				"paging":   false,

				"ordering": false,

				"info":     false,

				"searching" : false,

			});

		});



		function toggleIcon(e) {

	        $(e.target)

		            .prev('.panel-heading')

		            .find(".more-less")

		            .toggleClass('glyphicon-plus glyphicon-minus');

		    }

		    $('.panel-group').on('hidden.bs.collapse', toggleIcon);

		    $('.panel-group').on('shown.bs.collapse', toggleIcon);


	$(document).ready(function(){
    if (window.location.href.indexOf("?video=autoplay") > -1) {
		alert("hi video");
	  $("#video-popup-overlay,#video-popup-iframe-container,#video-popup-container,#video-popup-close").show();
      $("#video-popup-iframe").attr('src', "https://io.hfcl.com/images/videos/hfcl.mp4?autoplay=1");
      $("#video-popup-iframe").on('load', function() {
      $("#video-popup-container").show();
      });
    }
   });
  


			//video autoplay
	// if(window.location.href.indexOf("video") > -1) {
    // $("#video-popup-overlay,#video-popup-iframe-container,#video-popup-container,#video-popup-close").show();
    //   $("#video-popup-iframe").attr('src', "https://io.hfcl.com/images/videos/hfcl.mp4?autoplay=1");
    //   $("#video-popup-iframe").on('load', function() {
    //     $("#video-popup-container").show();
    //   });
    //   }
		
	</script>

</body>

</html>