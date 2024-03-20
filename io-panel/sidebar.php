<?php 
	$basename = basename($_SERVER['REQUEST_URI']);	
	$currentPage = pathinfo($_SERVER['PHP_SELF'], PATHINFO_BASENAME);
?>
<div class="sidebar" id="sidebar">
	<div class="sidebar-inner slimscroll">
		<div id="sidebar-menu" class="sidebar-menu">
			<ul>			

				<?php
					$masterPages = array(
						'banner-master.php',
						'banner-add.php',
						'slider-master.php',
						'slider-add.php',
						'headline-add.php',
						'headline-master.php',
						'home-testimonial-add.php',
						'home-testimonial-master.php',
						'media-add.php',
						'media-master.php'
						
					);
				?>
				<li class="has-ul class <?php if(in_array($currentPage, $masterPages)){ echo 'active'; } ?>">
					<a href="#" class="<?php if(in_array($currentPage, $masterPages)){ echo 'subdrop'; } ?>"><i class="fa fa-bars"></i><span>Masters</span></a>
					<ul class="hidden-ul" style="<?php if(in_array($currentPage, $masterPages)){ echo 'display:block;'; } ?>">

						<li><a href="banner-master.php" class="<?php if($currentPage == 'banner-master.php' || $currentPage=='banner-add.php') { echo 'active'; } ?>">Banner Master</a></li>	
						<li><a href="slider-master.php" class="<?php if($currentPage == 'slider-master.php' || $currentPage=='slider-add.php') { echo 'active'; } ?>">Home Slider Master</a></li>	
						<li><a href="headline-master.php" class="<?php if($currentPage == 'headline-master.php' || $currentPage=='headline-add.php') { echo 'active'; } ?>">Home Headline Master</a></li>	
						<li><a href="home-testimonial-master.php" class="<?php if($currentPage == 'home-testimonial-master.php' || $currentPage=='home-testimonial-add.php') { echo 'active'; } ?>">Home Testimonial Master</a>
						<li><a href="media-master.php" class="<?php if($currentPage == 'media-master.php' || $currentPage=='media-add.php') { echo 'active'; } ?>">News & Events Master</a></li>						
					</ul>
				</li>


				<?php
					$industryPages = array(
						'industry-listing-cms.php',
						'industry-master.php',
						'industry-add.php'
						
					);
				?>
				<li class="has-ul class <?php if(in_array($currentPage, $industryPages)){ echo 'active'; } ?>">
					<a href="#" class="<?php if(in_array($currentPage, $industryPages)){ echo 'subdrop'; } ?>"><i class="fa fa-bars"></i><span>Industry</span></a>
					<ul class="hidden-ul" style="<?php if(in_array($currentPage, $industryPages)){ echo 'display:block;'; } ?>">
						<li><a href="industry-listing-cms.php" class="<?php if($currentPage == 'industry-listing-cms.php') { echo 'active'; } ?>">Industry Banner CMS</a></li>
						<li><a href="industry-master.php" class="<?php if($currentPage == 'industry-master.php' || $currentPage == 'industry-add.php') { echo 'active'; } ?>">Industry Master</a></li>						
					</ul>
				</li>


				<?php
					$cmsPages = array(
						'home-cms.php'
					);
				?>
				<li class="has-ul class <?php if(in_array($currentPage, $cmsPages)){ echo 'active'; } ?>">
					<a href="#" class="<?php if(in_array($currentPage, $cmsPages)){ echo 'subdrop'; } ?>"><i class="fa fa-bars"></i><span>Home Page</span></a>
					<ul class="hidden-ul" style="<?php if(in_array($currentPage, $cmsPages)){ echo 'display:block;'; } ?>">
						<li><a href="home-cms.php" class="<?php if($currentPage == 'home-cms.php') { echo 'active'; } ?>">Home Page CMS</a></li>
					</ul>
				</li>




				<?php
					$cmsPages = array(
						'about-us-cms.php',
						'terms.php',
						'privacy-policy.php',
						'legal.php',
						'contact-us.php',
						'contact-cms.php',
					);
				?>
				<li class="has-ul class <?php if(in_array($currentPage, $cmsPages)){ echo 'active'; } ?>">
					<a href="#" class="<?php if(in_array($currentPage, $cmsPages)){ echo 'subdrop'; } ?>"><i class="fa fa-bars"></i><span>CMS Pages</span></a>
					<ul class="hidden-ul" style="<?php if(in_array($currentPage, $cmsPages)){ echo 'display:block;'; } ?>">
						<li><a href="about-us-cms.php" class="<?php if($currentPage == 'about-us-cms.php') { echo 'active'; } ?>">About Us</a></li>
						<li><a href="terms.php" class="<?php if($currentPage == 'terms.php' || $currentPage=='attribute-add.php') { echo 'active'; } ?>">Terms and conditions</a></li>
						<li><a href="privacy-policy.php" class="<?php if($currentPage == 'privacy-policy.php') { echo 'active'; } ?>">Privacy Policy</a></li>
						<li><a href="legal.php" class="<?php if($currentPage == 'legal.php') { echo 'active'; } ?>">Legal</a></li>
						<li><a href="contact-cms.php" class="<?php if($currentPage == 'contact-cms.php') { echo 'active'; } ?>">Contact CMS</a></li>
					</ul>
				</li>

			</ul>
		</div>
	</div>
</div>