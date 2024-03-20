<?php 
   include_once 'include/functions.php';
   $functions = new Functions();
   $sql ="select * from ".PREFIX."category_page_cms ";
   $query = $functions->query($sql);
   $categoryCMS = $functions->fetch($query);
   $bannerImageData = $functions->getImageUrl('slider-banner', $categoryCMS['image_name'], 'crop', '');
   $image1 = $functions->getImageUrl('category', $categoryCMS['image1'], 'crop', '');
   $image2 = $functions->getImageUrl('category', $categoryCMS['image2'], 'crop', '');
   $image3 = $functions->getImageUrl('category', $categoryCMS['image3'], 'crop', '');
?>

<!DOCTYPE html>

<html>

<head>

	<title><?php echo SITE_NAME; ?> || Category Product Page </title>

	<?php include("include/header-link.php");?>
	<meta name="description" content="A smart, upgradable, easy-to-use application for hassle-free management of all your UBRs">
</head>

<body class="innerpage ">

	<main class="root">

		<?php include("include/header.php");?>
		<section class="innerpagebanner-section mtop">
			<img src="<?php echo $bannerImageData; ?>" alt="procat" class="inbanner">
			<img src="<?php echo BASE_URL; ?>/images/catbanimg.png" alt="catbanimg" class="cenbanimg">
			<div class="inbantext">
				<div class="container p0">
					<h1 class="wow fadeInUp" data-wow-delay="0.5s"><?php echo $categoryCMS['title']; ?></h1>
					<p class="wow fadeInUp" data-wow-delay="0.55s"><?php echo $categoryCMS['description']; ?></p>

				</div>

			</div>

		</section>

		<section class="breadcrumb-section">

			<div class="container p0">

				<ul class="breadcrumb-in">

					<li class="wow fadeIn" data-wow-delay="0.5s"><a href="<?php echo BASE_URL; ?>">Home</a></li>

					<li class="wow fadeIn" data-wow-delay="0.55s"><a href="<?php echo BASE_URL; ?>/products">Products</a></li>

				</ul>

			</div>

		</section>

		<section class="localandglobal-section">
			<img src="<?php echo BASE_URL;?>/images/leftbig.png" alt="leftbig" class="ltimggg">

			<div class="container p0">

				<div class="localandglobal-in">

					<h2 class="wow fadeIn" data-wow-delay="0.5s"><?php echo $categoryCMS['page_title']; ?></h2>

					<p class="wow fadeIn" data-wow-delay="0.55s"><?php echo $categoryCMS['page_description']; ?></p>



					<div class="localandglobalflexx">
						<div class="localandglobalsub wow fadeInUp" data-wow-delay="0.5s">
							<div class="iconbox">

								<img src="<?php echo $image1; ?>" alt="global" loading="lazy">

							</div>

							<h4><?php echo $categoryCMS['title1']; ?></h4>

						</div>



						<div class="localandglobalsub wow fadeInUp" data-wow-delay="0.55s">

							<div class="iconbox">

								<img src="<?php echo $image2; ?>" alt="cloud" loading="lazy">

							</div>

							<h4><?php echo $categoryCMS['title2']; ?></h4>

						</div>





						<div class="localandglobalsub wow fadeInUp" data-wow-delay="0.6s">

							<div class="iconbox">

								<img src="<?php echo $image3; ?>" alt="easy" loading="lazy">

							</div>

							<h4><?php echo $categoryCMS['title3']; ?></h4>

						</div>





					</div>



				</div>

			</div>

		</section>



		<section class="spectrum-section">

			<div class="container p0">

				<div class="spectrum-in">

					<h2 class="wow fadeIn" data-wow-delay="0.5s">Augmenting the connectivity spectrum</h2>

					<ul class="nav nav-pills spectrumtabs" id="suptab">
						<?php 
							$sqlCategoryProduct = "select * from ".PREFIX."category_master where active='1' AND id !='4' ";
							$queryCategoryProduct = $functions->query($sqlCategoryProduct);
							$subCat = 1;
							while($categoryDetails = $functions->fetch($queryCategoryProduct)){
						?>
					    <li  <?php if($subCat == '1'){ ?>class="active" <?php } ?>><a data-toggle="tab" href="#tab<?php echo $subCat; ?>"><?php echo $categoryDetails['category_name']; ?></a></li>
					    <?php $subCat++; } ?>
					</ul>

					<div class="tab-content spectrumcontents">
					   <?php 
							$sqlCategoryProductd = "select * from ".PREFIX."category_master where active='1' AND id !='4' ";
							$queryCategoryProductd = $functions->query($sqlCategoryProductd);
							$subCatd = 1;
							while($categoryDetailsd = $functions->fetch($queryCategoryProductd)){
						?>
					    <div id="tab<?php echo $subCatd; ?>" class="tab-pane fade <?php if($subCatd == '1'){ ?>in active <?php } ?>">
					      	<div class="spectrum-slider thinslicksliderarrow">
						      <?php 
									$productList = "select * from ".PREFIX."product_master where active='1' AND category_id='".$categoryDetailsd['id']."' AND only_for_documentation='0' ";
									$productQuery = $functions->query($productList);
									while($productDetails = $functions->fetch($productQuery)){
										$proImage = $functions->getImageUrl('product', $productDetails['category_image'], 'crop', '');
										$subcategoryDetailsCheck = $functions->getUniqueSubCategoryById($productDetails['sub_category_id']);
								?>
						      	<div class="spectrum-slide">
						      		<div class="slideflexbox">
						      			<div class="spectrum-img">
						      				<img src="<?php echo $proImage; ?>" alt="spect_2">
						      			</div>
						      			<div class="spectrum-tex">
						      				<h4><?php echo $productDetails['product_name']; ?></h4>
						      				<p><?php echo $productDetails['short_description']; ?></p>
						      				<a href="<?php echo BASE_URL; ?>/products/<?php echo $subcategoryDetailsCheck['permalink']; ?>/<?php echo $productDetails['permalink']; ?>" class="knowbtn">Know More</a>
						      			</div>
						      		</div>
						      	</div>
						      <?php } ?>
					      	</div>
					    </div>
					 	<?php $subCatd++; } ?>
					</div>
					    	 <!-- Bootstrap Accordion -->
								<div class="panel-group" id="accordion1" role="tablist" aria-multiselectable="true"></div>
							<!-- /Bootstrap Accordion -->
				</div>
			</div>
			<img src="<?php echo BASE_URL; ?>/images/imgrbimg.png" alt="imgrbimg" class="imgrbimgclass">
		</section>



		<section class="blogsection">

			<div class="container p0">

				<div class="blogsinner">

					<h2 class="wow fadeIn" data-wow-delay="0.5s">Blog</h2>

					<div class="blogshowbox">
			         <?php 
			            include_once('blog/wp-load.php');
			               $recent_posts = wp_get_recent_posts(array(
			                 	'numberposts' =>3,
			                 	'category_name' => 'Product Category'
			               ));
			         ?>
			         	<?php
			         		$x=1;
			         		$u=0.5;
			         			foreach($recent_posts as $key=>$post){
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
			            } ?>
						

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
				getAccordion("#suptab",600);
			});


		    function getAccordion(element_id,screen) 
		    {
		        

		      if ($(window).width() < screen) 
		      {
		        var concat = '';
		        obj_tabs = $( element_id + " li" ).toArray();
		        obj_cont = $( ".spectrumcontents .tab-pane" ).toArray();
		        jQuery.each( obj_tabs, function( n, val ) 
		        {
		          concat += '<div id="' + n + '" class="panel panel-default">';
		          concat += '<div class="panel-heading" role="tab" id="heading' + n + '">';
		          concat += '<h4 class="panel-title"><a class="clickaccslide" role="button" data-toggle="collapse" data-parent="#accordion1" href="#collapse' + n + '" aria-expanded="false" aria-controls="collapse' + n + '">' + val.innerText + '</a></h4>';
		          concat += '</div>';
		          concat += '<div id="collapse' + n + '" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading' + n + '">';
		          concat += '<div class="panel-body">' + obj_cont[n].innerHTML + '</div>';
		          concat += '</div>';
		          concat += '</div>';
		        });
		        $("#accordion1").html(concat);
		        $("#accordion1").find('.panel-collapse:first').addClass("in");
                $('.spectrum-slider').slick({
                    arrows: true,
                    dots: false,
                    speed: 3000,
                    slidesToShow: 3,
                    slidesToScroll: 1,
                    autoplay: true,
                    autoplaySpeed: 6000,
                    pauseOnHover: false,
                    fade: false,
                    responsive: [{
                        breakpoint: 991,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 1,
                        },
                    }, {
                        breakpoint: 600,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1,
                        },
                    }, ],
                });
		        $("#accordion1").find('.panel-title a:first').attr("aria-expanded","true");
		        $(element_id).remove();
		        $(".spectrumcontents").remove();
		      } 
		    } 

		    

	</script>

</body>

</html>