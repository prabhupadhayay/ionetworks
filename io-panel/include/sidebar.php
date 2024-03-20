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
						'media-master.php',
						'faq-add.php',
						'faq-master.php',
						'brochure-enquiry2022.php',
						'brochure-event2022.php'
						
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
						<li><a href="faq-master.php" class="<?php if($currentPage == 'faq-master.php' || $currentPage=='faq-add.php') { echo 'active'; } ?>">FAQ Master</a></li>
						<li><a href="brochure-enquiry2022.php" class="<?php if($currentPage == 'brochure-enquiry2022.php' || $currentPage=='brochure-enquiry2022.php') { echo 'active'; } ?>">Brochureware Enquiry</a></li>	
						<li><a href="brochure-event2022.php" class="<?php if($currentPage == 'brochure-enquiry2022.php' || $currentPage=='brochure-event2022.php') { echo 'active'; } ?>">Brochureware Event Enquiry</a></li>
						
					</ul>
				</li>


				<?php
					$industryPages = array(
						'category-master.php',
						'category-add.php',
						'category-page-cms.php',
						'product-master.php',
						'product-add.php',
						'varient-master.php',
						'varient-add.php',
						'sub-varient-master.php',
						'sub-varient-add.php'
						
					);
				?>
				<li class="has-ul class <?php if(in_array($currentPage, $industryPages)){ echo 'active'; } ?>">
					<a href="#" class="<?php if(in_array($currentPage, $industryPages)){ echo 'subdrop'; } ?>"><i class="fa fa-bars"></i><span>Product</span></a>
					<ul class="hidden-ul" style="<?php if(in_array($currentPage, $industryPages)){ echo 'display:block;'; } ?>">
						<li><a href="category-page-cms.php" class="<?php if($currentPage == 'category-page-cms.php') { echo 'active'; } ?>">Category Page CMS</a></li>
						<li><a href="category-master.php" class="<?php if($currentPage == 'category-master.php' || $currentPage == 'category-add.php') { echo 'active'; } ?>">Category Master</a></li>
						<li><a href="product-master.php" class="<?php if($currentPage == 'product-master.php' || $currentPage == 'product-add.php') { echo 'active'; } ?>">Product Master</a></li>
						<li><a href="varient-master.php" class="<?php if($currentPage == 'varient-master.php' || $currentPage == 'varient-add.php') { echo 'active'; } ?>">Product Varient Master</a></li>
						<li><a href="sub-varient-master.php" class="<?php if($currentPage == 'sub-varient-master.php' || $currentPage == 'sub-varient-add.php') { echo 'active'; } ?>">Product Sub Varient Master</a></li>						
					</ul>
				</li>

				<?php
					$industryPages = array(
						'category-master-new.php',
						'category-add-new.php'
					);
				?>
				<li class="has-ul class <?php if(in_array($currentPage, $industryPages)){ echo 'active'; } ?>">
					<a href="#" class="<?php if(in_array($currentPage, $industryPages)){ echo 'subdrop'; } ?>"><i class="fa fa-bars"></i><span>Product Revamp</span></a>
					<ul class="hidden-ul" style="<?php if(in_array($currentPage, $industryPages)){ echo 'display:block;'; } ?>">
						<li><a href="category-master-new.php" class="<?php if($currentPage == 'category-master-new.php' || $currentPage == 'category-add-new.php') { echo 'active'; } ?>">Category Master Revamp</a></li>						
					</ul>
				</li>

				<?php
					$industryPages = array(
						'industry-listing-cms.php',
						'industry-master.php',
						'industry-add.php',
						'industry-empower-master.php',
						'industry-empower-add.php'
						
					);
				?>
				<li class="has-ul class <?php if(in_array($currentPage, $industryPages)){ echo 'active'; } ?>">
					<a href="#" class="<?php if(in_array($currentPage, $industryPages)){ echo 'subdrop'; } ?>"><i class="fa fa-bars"></i><span>Industry</span></a>
					<ul class="hidden-ul" style="<?php if(in_array($currentPage, $industryPages)){ echo 'display:block;'; } ?>">
						<li><a href="industry-listing-cms.php" class="<?php if($currentPage == 'industry-listing-cms.php') { echo 'active'; } ?>">Industry Banner CMS</a></li>
						<li><a href="industry-master.php" class="<?php if($currentPage == 'industry-master.php' || $currentPage == 'industry-add.php') { echo 'active'; } ?>">Industry Master</a></li>	
						<li><a href="industry-empower-master.php" class="<?php if($currentPage == 'industry-empower-master.php' || $currentPage == 'industry-empower-add.php') { echo 'active'; } ?>">Empowering Industry Master</a></li>						
					</ul>
				</li>



				<?php
					$industryPages = array(
						'partner-cms.php',
						'partnership-cms.php',
						'partner-onboard-master.php',
						'partner-onboard-add.php',
						'togimg-master.php',
						'togimg-add.php',
						'ladder-master.php',
						'ladder-add.php',
						'lad-master.php',
						'lad-add.php'
						
					);
				?>
				<li class="has-ul class <?php if(in_array($currentPage, $industryPages)){ echo 'active'; } ?>">
					<a href="#" class="<?php if(in_array($currentPage, $industryPages)){ echo 'subdrop'; } ?>"><i class="fa fa-bars"></i><span>Partner</span></a>
					<ul class="hidden-ul" style="<?php if(in_array($currentPage, $industryPages)){ echo 'display:block;'; } ?>">
						<li><a href="partner-cms.php" class="<?php if($currentPage == 'partner-cms.php') { echo 'active'; } ?>">Partner CMS</a></li>
						<li><a href="partnership-cms.php" class="<?php if($currentPage == 'partnership-cms.php') { echo 'active'; } ?>">Partnership CMS</a></li>
						<li><a href="partner-onboard-master.php" class="<?php if($currentPage == 'partner-onboard-master.php' || $currentPage == 'partner-onboard-add.php') { echo 'active'; } ?>">Partner Onboard Master</a></li>	
						<li><a href="togimg-master.php" class="<?php if($currentPage == 'togimg-master.php' || $currentPage == 'togimg-add.php') { echo 'active'; } ?>">Togather Image Master</a></li>	
						<li><a href="ladder-master.php" class="<?php if($currentPage == 'ladder-master.php' || $currentPage == 'ladder-add.php') { echo 'active'; } ?>">Ladder Category Master</a></li>
						<li><a href="lad-master.php" class="<?php if($currentPage == 'lad-master.php' || $currentPage == 'lad-add.php') { echo 'active'; } ?>">Ladder Master</a></li>						
					</ul>
				</li>

				<?php
					$industryPages = array(
						'ems-cms.php',
						'emsicon-master.php',
						'emsicon-add.php',
						'emsdata-master.php',
						'emsdata-add.php',
						'emsfaq-master.php',
						'emsfaq-add.php'
						
					);
				?>
				<li class="has-ul class <?php if(in_array($currentPage, $industryPages)){ echo 'active'; } ?>">
					<a href="#" class="<?php if(in_array($currentPage, $industryPages)){ echo 'subdrop'; } ?>"><i class="fa fa-bars"></i><span>EMS</span></a>
					<ul class="hidden-ul" style="<?php if(in_array($currentPage, $industryPages)){ echo 'display:block;'; } ?>">
						<li><a href="ems-cms.php" class="<?php if($currentPage == 'ems-cms.php') { echo 'active'; } ?>">EMS CMS</a></li>
						<li><a href="emsicon-master.php" class="<?php if($currentPage == 'emsicon-master.php' || $currentPage == 'emsicon-add.php') { echo 'active'; } ?>">Why EMS Icon Master</a></li>
						<li><a href="emsdata-master.php" class="<?php if($currentPage == 'emsdata-master.php' || $currentPage == 'emsdata-add.php') { echo 'active'; } ?>">EMS Data Master</a></li>
						<li><a href="emsfaq-master.php" class="<?php if($currentPage == 'emsfaq-master.php' || $currentPage == 'emsfaq-add.php') { echo 'active'; } ?>">EMS FAQ Master</a></li>	
					
					</ul>
				</li>


				<?php
					$industryPages = array(
						'cnms-cms.php',
						'cnmsicon-master.php',
						'cnmsicon-add.php',
						'cnmsdata-master.php',
						'cnmsdata-add.php',
						'cnmsfaq-master.php',
						'cnmsfaq-add.php'	
					);
				?>
				<li class="has-ul class <?php if(in_array($currentPage, $industryPages)){ echo 'active'; } ?>">
					<a href="#" class="<?php if(in_array($currentPage, $industryPages)){ echo 'subdrop'; } ?>"><i class="fa fa-bars"></i><span>CNMS</span></a>
					<ul class="hidden-ul" style="<?php if(in_array($currentPage, $industryPages)){ echo 'display:block;'; } ?>">
						<li><a href="cnms-cms.php" class="<?php if($currentPage == 'cnms-cms.php') { echo 'active'; } ?>">CNMS CMS</a></li>	
						<li><a href="cnmsicon-master.php" class="<?php if($currentPage == 'cnmsicon-master.php' || $currentPage == 'cnmsicon-add.php') { echo 'active'; } ?>">Why CNMS Icon Master</a></li>	
						<li><a href="cnmsdata-master.php" class="<?php if($currentPage == 'cnmsdata-master.php' || $currentPage == 'cnmsdata-add.php') { echo 'active'; } ?>">CNMS Data Master</a></li>	
						<li><a href="cnmsfaq-master.php" class="<?php if($currentPage == 'cnmsfaq-master.php' || $currentPage == 'cnmsfaq-add.php') { echo 'active'; } ?>">CNMS FAQ Master</a></li>					
					</ul>
				</li>


				<?php
					$contactUsPages = array(
						'contact-cms.php',
						'address-master.php',
						'address-add.php',
						'email-master.php',
						'email-add.php',
						'association-master.php',
						'association-add.php',
						'contact-enquiry.php',
						'whitepaper-enquiry.php',
						'partnership-enquiry.php',
						'download-resource-request.php'
						
					);
				?>
				<li class="has-ul class <?php if(in_array($currentPage, $contactUsPages)){ echo 'active'; } ?>">
					<a href="#" class="<?php if(in_array($currentPage, $contactUsPages)){ echo 'subdrop'; } ?>"><i class="fa fa-bars"></i><span>Contact Us</span></a>
					<ul class="hidden-ul" style="<?php if(in_array($currentPage, $contactUsPages)){ echo 'display:block;'; } ?>">
						<li><a href="contact-cms.php" class="<?php if($currentPage == 'contact-cms.php') { echo 'active'; } ?>">Contact Us CMS</a></li>
						<li><a href="address-master.php" class="<?php if($currentPage == 'address-master.php' || $currentPage == 'address-add.php') { echo 'active'; } ?>">Address Master</a></li>	
						<li><a href="email-master.php" class="<?php if($currentPage == 'email-master.php' || $currentPage == 'email-add.php') { echo 'active'; } ?>">Email Master</a></li>			
						<li><a href="association-master.php" class="<?php if($currentPage == 'association-master.php' || $currentPage == 'association-add.php') { echo 'active'; } ?>">Association & Partners Images</a></li>
						<li><a href="contact-enquiry.php" class="<?php if($currentPage == 'contact-enquiry.php') { echo 'active'; } ?>">Contact Enquiries</a></li>
						<li><a href="whitepaper-enquiry.php" class="<?php if($currentPage == 'whitepaper-enquiry.php') { echo 'active'; } ?>">Whitepaper Enquiries</a></li>
						<li><a href="product-training-enquiry.php" class="<?php if($currentPage == 'product-training-enquiry.php') { echo 'active'; } ?>">Product Training Enquiries</a></li>
						<li><a href="partnership-enquiry.php" class="<?php if($currentPage == 'partnership-enquiry.php') { echo 'active'; } ?>">Partnership Enquiries</a></li>
						<li><a href="download-resource-request.php" class="<?php if($currentPage == 'download-resource-request.php') { echo 'active'; } ?>">Resource Download Request</a></li>
						<li><a href="installation-query-result.php" class="<?php if($currentPage == 'installation-query-result.php') { echo 'active'; } ?>">Installation Queries</a></li>
											
					</ul>
				</li>




				<?php
					$cmsPages = array(
						'blog-cms.php',
						'documentation-cms.php',
						'about-us-cms.php',
						'terms.php',
						'privacy-policy.php',
						'legal.php'
					);
				?>
				<li class="has-ul class <?php if(in_array($currentPage, $cmsPages)){ echo 'active'; } ?>">
					<a href="#" class="<?php if(in_array($currentPage, $cmsPages)){ echo 'subdrop'; } ?>"><i class="fa fa-bars"></i><span>CMS Pages</span></a>
					<ul class="hidden-ul" style="<?php if(in_array($currentPage, $cmsPages)){ echo 'display:block;'; } ?>">
						<li><a href="documentation-cms.php" class="<?php if($currentPage == 'documentation-cms.php') { echo 'active'; } ?>">Documentation Banner CMS</a></li>
						<li><a href="blog-cms.php" class="<?php if($currentPage == 'blog-cms.php') { echo 'active'; } ?>">Blog Banner CMS</a></li>
						<li><a href="about-us-cms.php" class="<?php if($currentPage == 'about-us-cms.php') { echo 'active'; } ?>">About Us</a></li>
						<li><a href="terms.php" class="<?php if($currentPage == 'terms.php' || $currentPage=='attribute-add.php') { echo 'active'; } ?>">Terms and conditions</a></li>
						<li><a href="privacy-policy.php" class="<?php if($currentPage == 'privacy-policy.php') { echo 'active'; } ?>">Privacy Policy</a></li>
						<li><a href="legal.php" class="<?php if($currentPage == 'legal.php') { echo 'active'; } ?>">Partner T&C</a></li>
					</ul>
				</li>

			</ul>
		</div>
	</div>
</div>