
<?php
$basename = basename($_SERVER['REQUEST_URI']);
$currentPage = pathinfo($_SERVER['PHP_SELF'], PATHINFO_BASENAME);  
$currentPage = str_replace(".php", "", $currentPage);
?> 

<!-- Loader start -->
<div id="loader-wrapper">
	<div class="loader">            
		<img src="<?php echo BASE_URL; ?>/images/Logo_Final.svg">
	</div>
</div>
<!-- Loader end -->
<div class="wrapper">	
 <header class="header">
 	<div class="tophead">
 		<div class="container p0">
 			<div class="topheadflex">

	 			<a href="<?php echo BASE_URL; ?>/contact-us" class="anchorcontact <?php if($currentPage=='contact-us') { echo 'active'; } ?>">Contact Us</a>
	 			<!-- <a href="#">Partner Login</a> -->
	 			<a href="javascript:void(0)" class="searchclick"><i class="fa fa-search" aria-hidden="true"></i></a>
	 		</div>
 		</div>


 		<div class="searchbar">
 			<form class="search" method="GET" action="<?php echo BASE_URL; ?>/search">
 				<div class="form-group">
 					<input type="text" required="required" name="search" class="form-control" placeholder="Search..">
 				</div>
	 			<div class="closesearch">
	 				<i class="fa fa-times" aria-hidden="true"></i>
	 			</div>
 			</form>
 		</div>
 	</div>

 	<div class="bottommenu">

 		<div class="container p0">

 			<div class="bottommenuflex">

 				<div class="logo">

 					<a href="<?php echo BASE_URL; ?>">
 						<!-- <img src="<?php //echo BASE_URL; ?>/images/io_final.png" alt="logo" loading="lazy"> -->
 						<img src="<?php echo LOGO; ?>" alt="logo" loading="lazy">
 					</a>

 				</div>

 				<div class="mainmenu">
                	<div class="menuoutbox">
	                    <div class="moblogobox">
			                <a href="<?php echo BASE_URL; ?>/index">
			                  	<!-- <img src="<?php// echo BASE_URL; ?>/images/logo_final_1.png" alt="logo" loading="lazy"> -->
			                  	<img src="<?php echo LOGO; ?>" alt="logo" loading="lazy">
			                </a>
	                    </div>

		 				<ul class="mobileulfix">


	 						<li class="menuhover">
	 							<a href="https://betaio.hfcl.com/products">Products</a>
								 <!-- <a href="<?php echo BASE_URL; ?>/products">Products</a> -->
	 							<div class="dropmenu">
	 								<div class="dropmenuin">

	 								<?php 
	 									$sqlMenuProduct = "select * from ".PREFIX."category_master where active='1' ";
	 									$queryMenuProduct = $functions->query($sqlMenuProduct);
	 									while($menuCategoryDetails = $functions->fetch($queryMenuProduct)){
	 										$menuCategoryImage = $functions->getImageUrl('category', $menuCategoryDetails['image_name'], 'crop', '');
	 								?>	
	 									<div class="dropsub">
	 										<div class="drophead">
	 											<div class="dropicon">
		 											<img src="<?php echo $menuCategoryImage; ?>" alt="logo" loading="lazy">
		 										</div>
		 										<h4><?php echo $menuCategoryDetails['category_name']; ?></h4>
	 										</div>
	 										<ul>
	 											<?php 
	 											if($menuCategoryDetails['id'] != 4){
				 									$sqlMenuCategory = "select * from ".PREFIX."sub_category_master where category_id ='".$menuCategoryDetails['id']."' AND active='1' ORDER BY display_order ASC ";
				 									$queryMenuSubCategory = $functions->query($sqlMenuCategory);
				 									while($menuSubCategoryDetails = $functions->fetch($queryMenuSubCategory)){
				 								?>	
	 													<li><a href="<?php echo BASE_URL; ?>/products/<?php echo $menuSubCategoryDetails['permalink']; ?>"><?php echo $menuSubCategoryDetails['category_name']; ?></a></li>
	 											<?php 
	 												}	
	 												
	 											?>
	 												
	 											<?php }else{ ?>
	 												<li><a href="<?php echo BASE_URL; ?>/products/cnms">cNMS</a></li>
	 												<li><a href="<?php echo BASE_URL; ?>/products/ems">EMS</a></li>
	 											<?php } ?>
	 										</ul>
	 									</div>
	 								<?php } ?>
	 								</div>
	 							</div>
	 						</li>

	 						<li class="menuhover <?php if($currentPage=='industry' || $currentPage=='industry-details') { echo 'active'; }?>">
	 							<a href="<?php echo BASE_URL; ?>/industries">Industries</a>
	 							<div class="dropmenu inddrop">
	 								<div class="dropmenuin">
	 									<ul class="indmenul">
	 									<?php 
	 										$sqlIndustryMenu = "select * from ".PREFIX."industry_master where active='1' order by display_order ASC ";
	 										$resultIndustryMenu = $functions->query($sqlIndustryMenu);
	 										while($industryMenuDetails = $functions->fetch($resultIndustryMenu)){
	 											$industryMenuImage = $functions->getImageUrl('industry', $industryMenuDetails['menu_icon'], 'crop', '');
	 									?>
		 										<li class="match">
		 											<a href="<?php echo BASE_URL; ?>/industries/<?php echo $industryMenuDetails['permalink']; ?>"><img src="<?php echo $industryMenuImage; ?>" alt="<?php echo $industryMenuDetails['name']; ?>" loading="lazy">
			 											<span><?php echo $industryMenuDetails['name']; ?></span>
			 										</a>
		 										</li>
		 								<?php } ?>


	 									</ul>

	 								</div>

	 							</div>

	 						</li>

	 						<li class="menuhover">

	 							<a href="javascript:void(0);">Resources</a>

	 							<div class="dropmenu resourcesdrop">

	 								<div class="dropmenuin">

	 									<div class="dropsub">

	 										<div class="drophead">

	 											<div class="dropicon">

		 											<img src="<?php echo BASE_URL; ?>/images/explore.png" alt="explore" loading="lazy">

		 										</div>

		 										<h4>Explore</h4>

	 										</div>

	 										<ul>

	 											<li><a href="<?php echo BASE_URL; ?>/blogs">Blogs</a></li>
	 											<li><a href="<?php echo BASE_URL; ?>/documentation">Documentation</a></li>
												 <li><a href="<?php echo BASE_URL; ?>/videos">Videos</a></li>
												 

	 										</ul>

	 									</div>

	 									<div class="dropsub">

	 										<a href="<?php echo BASE_URL; ?>/news&media" class="drophead">

	 											<div class="dropicon">

		 											<img src="<?php echo BASE_URL; ?>/images/media.png" alt="media" loading="lazy">

		 										</div>

		 										<h4>News & Media</h4>

	 										</a>

	 										<ul>

	 											<li><a href="<?php echo BASE_URL; ?>/news&media/PressRelease">Press Releases</a></li>

	 											<li><a href="<?php echo BASE_URL; ?>/news&media/Events">Events</a></li>

	 										</ul>

	 									</div>

	 								</div>

	 							</div>

	 						</li>

	 						<li class="menuhover">

	 							<a href="javascript:void(0);">Partner</a>

	 							<div class="dropmenu partnerdrop">

	 								<div class="dropmenuin">

	 									<ul class="indmenul partul">

	 										<li>

	 											<a href="<?php echo BASE_URL;?>/Partner/Become-a-Partner"><img src="<?php echo BASE_URL; ?>/images/portal.png" alt="portal" loading="lazy">

		 											<span>Partner Portal Login</span>

		 										</a>

	 										</li>

	 										<li>

	 											<a href="<?php echo BASE_URL;?>/Partner/Become-a-Partner"><img src="<?php echo BASE_URL; ?>/images/member.png" alt="member" loading="lazy">

	 											<span>Become a Partner</span>

		 										</a>

	 										</li>

	 									</ul>

	 								</div>

	 							</div>

	 						</li>

	 					</ul>
	 				</div>
 					<a href="<?php echo BASE_URL;?>/contact-us" class="getdemobtn">Get a demo</a>
 					<div class="myacdrop">
 						<h4>My Account</h4>
 						<div class="myacdropdoown">
 							<a href="#">My Profile</a>
 							<a href="#">Logout</a>
 							<a href="#">Contact Us</a>
 						</div>
 					</div>
 					<div class="togglemenus">
                    	<span></span>
                    	<span></span>
                    	<span></span>
                    </div>
 				</div>

 			</div>

 		</div>

 	</div>
	<div class="mobilepatch"></div>
 </header>



      

	 

