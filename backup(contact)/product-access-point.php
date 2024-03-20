<?php 
   include_once 'include/functions.php';
   $functions = new Functions();

//    if(isset($_GET['permalink']) && !empty($_GET['permalink'])){
//    		$permalink = $functions->escape_string($functions->strip_all($_GET['permalink']));
//    		$categoryDetails = $functions->getSubCategoryDetailsByPermalink($permalink);
//    		$bannerImage = $functions->getImageUrl('slider-banner', $categoryDetails['image_name'], 'crop', '');
//    }else{
//    	header("location: ".BASE_URL."/products");
// 		exit();
//    }

    //new code 
   // Get the current URL
   $currentUrl = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
   
   
   if (isset($_GET['permalink']) && !empty($_GET['permalink'])) {
      
      // Print the value of permalink for debugging
      //var_dump($currentUrl);
       //var_dump($urltomatch);
      $permalink = $functions->escape_string($functions->strip_all($_GET['permalink']));
      $categoryDetails = $functions->getSubCategoryDetailsByPermalink($permalink);
     
      $bannerImage = $functions->getImageUrl('slider-banner', $categoryDetails['image_name'], 'crop', '');
      //$cat_name = $subcategoryDetails['permalink'];
      
      $urltomatch = BASE_URL . "/products/" .  $categoryDetails['permalink'];
      
      $normalizedPermalink = strtolower($currentUrl);
	  $normalizedIndustryName = strtolower($urltomatch);


      //echo "Permalink value: " . $normalizedPermalink;
      //echo "URL TO MATCH value: " . $normalizedIndustryName;
   // Compare the normalized strings
   if ($normalizedPermalink === $normalizedIndustryName) {
      
       //echo "Permalink value: " . $currentUrl;
       //echo "URL TO MATCH value: " . $urltomatch;
   } else {
       if($currentUrl === BASE_URL . "/products/" . "commercial-access-switch"){
		header("location: " . BASE_URL . "/products/commercial-access-switches", true, 301);
        exit;
	   }
      header("location: " . BASE_URL . "/products");
      exit();
   }
   
   } else {
      header("location: " . BASE_URL . "/products");
      exit();
   }



?>

<!DOCTYPE html>

<html lang="en">

<head>

	<?php if($categoryDetails['title'] == "Commercial Access Switches"): ?>
	
	<title>Efficient Commercial Access Switch Solutions | IO by HFCL</title>
	<meta name="title" content="Efficient Commercial Access Switch Solutions | IO by HFCL" />
	<meta name="description" content="Discover IO by HFCL's advanced commercial access switch solutions designed for seamless connectivity and superior network performance. Elevate your business operations with our cutting-edge technology."/>
	<link rel="canonical" href="https://io.hfcl.com/products/commercial-access-switch" />
	 
	 <!-- Facebook Meta Tags -->
	<meta property="og:type" content="website" />
	<meta property="og:url" content="https://io.hfcl.com/" />
	<meta property="og:title" content="Efficient Commercial Access Switch Solutions | IO by HFCL" />
	<meta property="og:description" content="Discover IO by HFCL's advanced commercial access switch solutions designed for seamless connectivity and superior network performance. Elevate your business operations with our cutting-edge technology."/>
	<meta property="og:image" content="https://io.hfcl.com/images/product/commercial-featured.jpg" />

	 <!-- Twitter Meta Tags -->
	<meta property="twitter:card" content="summary_large_image" />
	<meta property="twitter:domain" content="io.hfcl.com/" />
	<meta property="twitter:url" content="https://io.hfcl.com/" />
	<meta property="twitter:title" content="Efficient Commercial Access Switch Solutions | IO by HFCL" />
	<meta property="twitter:description" content="Discover IO by HFCL's advanced commercial access switch solutions designed for seamless connectivity and superior network performance. Elevate your business operations with our cutting-edge technology."/>
	<meta property="twitter:image" content="https://io.hfcl.com/images/product/commercial-featured.jpg"/>
   
   <?php elseif ($categoryDetails['title'] == "Industrial Access Switches"): ?>
	
	<title>Industrial Access Switches | IO by HFCL - Robust Connectivity Solutions</title>
	<meta name="title" content="Industrial Access Switches | IO by HFCL - Robust Connectivity Solutions" />
	<meta name="description" content="Discover IO by HFCL's Industrial Access Switches for seamless connectivity in industrial environments. Ensure reliability and efficiency with our rugged network solutions."/>
	<link rel="canonical" href="https://io.hfcl.com/products/industrial-access-switch" />
	 
	 <!-- Facebook Meta Tags -->
	<meta property="og:type" content="website" />
	<meta property="og:url" content="https://io.hfcl.com/" />
	<meta property="og:title" content="Industrial Access Switches | IO by HFCL - Robust Connectivity Solutions" />
	<meta property="og:description" content="Discover IO by HFCL's Industrial Access Switches for seamless connectivity in industrial environments. Ensure reliability and efficiency with our rugged network solutions."/>
	<meta property="og:image" content="https://io.hfcl.com/images/product/industrial-featured.jpg" />

	 <!-- Twitter Meta Tags -->
	<meta property="twitter:card" content="summary_large_image" />
	<meta property="twitter:domain" content="io.hfcl.com/" />
	<meta property="twitter:url" content="https://io.hfcl.com/" />
	<meta property="twitter:title" content="Industrial Access Switches | IO by HFCL - Robust Connectivity Solutions" />
	<meta property="twitter:description" content="Discover IO by HFCL's Industrial Access Switches for seamless connectivity in industrial environments. Ensure reliability and efficiency with our rugged network solutions."/>
	<meta property="twitter:image" content="https://io.hfcl.com/images/product/industrial-featured.jpg" />
	
	<?php elseif ($categoryDetails['title'] == "Aggregation Switch"): ?>
	
	<meta name="description" content="High performance Layer-2 and Layer-3 switching solution that offers flexible network designs and scalability with multiple 10G backhaul.">

	<meta name="keywords" content="IO by HFCL network switch, IO by HFCL managed switch, IO by HFCL aggregation switch, link aggregation switch, switch models, switch to access point" />
	
	<?php elseif ($categoryDetails['title'] == "P2P Unlicensed Band Radio"): ?>
	
	<title>P2P Unlicensed Band Radio Solutions | IO by HFCL</title>
	<meta name="title" content="P2P Unlicensed Band Radio Solutions | IO by HFCL" />
	<meta name="description" content="Discover IO by HFCL's cutting-edge P2P unlicensed band radio solutions for reliable and efficient communication. Explore our innovative technology today."/>
	<link rel="canonical" href="https://io.hfcl.com/products/p2p" />
	 
	 <!-- Facebook Meta Tags -->
	<meta property="og:type" content="website" />
	<meta property="og:url" content="https://io.hfcl.com/" />
	<meta property="og:title" content="P2P Unlicensed Band Radio Solutions | IO by HFCL" />
	<meta property="og:description" content="Discover IO by HFCL's cutting-edge P2P unlicensed band radio solutions for reliable and efficient communication. Explore our innovative technology today."/>
	<meta property="og:image" content="https://io.hfcl.com/images/product/p2p-featured.jpg" />

	 <!-- Twitter Meta Tags -->
	<meta property="twitter:card" content="summary_large_image" />
	<meta property="twitter:domain" content="io.hfcl.com/" />
	<meta property="twitter:url" content="https://io.hfcl.com/" />
	<meta property="twitter:title" content="P2P Unlicensed Band Radio Solutions | IO by HFCL" />
	<meta property="twitter:description" content="Discover IO by HFCL's cutting-edge P2P unlicensed band radio solutions for reliable and efficient communication. Explore our innovative technology today."/>
	<meta property="twitter:image" content="https://io.hfcl.com/images/product/p2p-featured.jpg" />
	
	<?php elseif ($categoryDetails['title'] == "P2MP Unlicensed Band Radio"): ?>
	
	<title>P2MP Unlicensed Band Radio Solutions | IO by HFCL</title>
	<meta name="title" content="P2MP Unlicensed Band Radio Solutions | IO by HFCL" />
	<meta name="description" content="Discover IO by HFCL's cutting-edge P2MP unlicensed band radio solutions. Revolutionize your communication infrastructure with our high-performance, reliable, and cost-effective radio technology."/>
	<link rel="canonical" href="https://io.hfcl.com/products/p2mp" />
	 
	 <!-- Facebook Meta Tags -->
	<meta property="og:type" content="website" />
	<meta property="og:url" content="https://io.hfcl.com/" />
	<meta property="og:title" content="P2MP Unlicensed Band Radio Solutions | IO by HFCL" />
	<meta property="og:description" content="Discover IO by HFCL's cutting-edge P2MP unlicensed band radio solutions. Revolutionize your communication infrastructure with our high-performance, reliable, and cost-effective radio technology."/>
	<meta property="og:image" content="https://io.hfcl.com/images/product/p2mp-featured.jpg" />

	 <!-- Twitter Meta Tags -->
	<meta property="twitter:card" content="summary_large_image" />
	<meta property="twitter:domain" content="io.hfcl.com/" />
	<meta property="twitter:url" content="https://io.hfcl.com/" />
	<meta property="twitter:title" content="P2MP Unlicensed Band Radio Solutions | IO by HFCL" />
	<meta property="twitter:description" content="Discover IO by HFCL's cutting-edge P2MP unlicensed band radio solutions. Revolutionize your communication infrastructure with our high-performance, reliable, and cost-effective radio technology."/>
	<meta property="twitter:image" content="https://io.hfcl.com/images/product/p2mp-featured.jpg" />
	
	<?php elseif ($categoryDetails['title'] == "Antennas"): ?>
	
	<title>High-Performance Antennas | IO by HFCL</title>
	<meta name="title" content="High-Performance Antennas | IO by HFCL" />
	<meta name="description" content="Discover IO by HFCL's range of high-performance antennas designed for seamless connectivity. Explore our innovative antenna solutions for enhanced communication and connectivity experiences."/>
	<link rel="canonical" href="https://io.hfcl.com/products/antennas" />
	 
	 <!-- Facebook Meta Tags -->
	<meta property="og:type" content="website" />
	<meta property="og:url" content="https://io.hfcl.com/" />
	<meta property="og:title" content="High-Performance Antennas | IO by HFCL" />
	<meta property="og:description" content="Discover IO by HFCL's range of high-performance antennas designed for seamless connectivity. Explore our innovative antenna solutions for enhanced communication and connectivity experiences."/>
	<meta property="og:image" content="https://io.hfcl.com/images/product/antennas-featured.jpg" />

	 <!-- Twitter Meta Tags -->
	<meta property="twitter:card" content="summary_large_image" />
	<meta property="twitter:domain" content="io.hfcl.com/" />
	<meta property="twitter:url" content="https://io.hfcl.com/" />
	<meta property="twitter:title" content="High-Performance Antennas | IO by HFCL" />
	<meta property="twitter:description" content="Discover IO by HFCL's range of high-performance antennas designed for seamless connectivity. Explore our innovative antenna solutions for enhanced communication and connectivity experiences."/>
	<meta property="twitter:image" content="https://io.hfcl.com/images/product/antennas-featured.jpg" />

	<?php elseif ($categoryDetails['title'] == "xPON"): ?>
	
	<title>xPON Solutions for High-Speed Connectivity | IO by HFCL</title>
	<meta name="title" content="xPON Solutions for High-Speed Connectivity | IO by HFCL" />
	<meta name="description" content="Discover IO by HFCL's cutting-edge xPON solutions, revolutionizing high-speed connectivity through passive optical networks. Explore our reliable, efficient, and future-proof PON solutions today."/>
	<link rel="canonical" href="https://io.hfcl.com/products/xpon" />
	 
	 <!-- Facebook Meta Tags -->
	<meta property="og:type" content="website" />
	<meta property="og:url" content="https://io.hfcl.com/" />
	<meta property="og:title" content="xPON Solutions for High-Speed Connectivity | IO by HFCL" />
	<meta property="og:description" content="Discover IO by HFCL's cutting-edge xPON solutions, revolutionizing high-speed connectivity through passive optical networks. Explore our reliable, efficient, and future-proof PON solutions today."/>
	<meta property="og:image" content="https://io.hfcl.com/images/product/xpon-featured.jpg" />

	 <!-- Twitter Meta Tags -->
	<meta property="twitter:card" content="summary_large_image" />
	<meta property="twitter:domain" content="io.hfcl.com/" />
	<meta property="twitter:url" content="https://io.hfcl.com/" />
	<meta property="twitter:title" content="xPON Solutions for High-Speed Connectivity | IO by HFCL" />
	<meta property="twitter:description" content="Discover IO by HFCL's cutting-edge xPON solutions, revolutionizing high-speed connectivity through passive optical networks. Explore our reliable, efficient, and future-proof PON solutions today."/>
	<meta property="twitter:image" content="https://io.hfcl.com/images/product/xpon-featured.jpg" />

	<?php elseif ($categoryDetails['title'] == "Power Solutions AC /DC PoE Injectors"): ?>

	<title>Power Solutions AC /DC PoE Injectors | IO by HFCL</title>
	<meta name="title" content="Power Solutions AC /DC PoE Injectors | IO by HFCL" />
	<meta name="description" content="Discover IO by HFCL's high-performance Power Solutions AC/DC PoE Injectors. Empower your network with reliable connectivity. Explore our cutting-edge technology today."/>
	<link rel="canonical" href="https://io.hfcl.com/products/power-solutions-ac-dc-poe-injectors" />
	 
	 <!-- Facebook Meta Tags -->
	<meta property="og:type" content="website" />
	<meta property="og:url" content="https://io.hfcl.com/" />
	<meta property="og:title" content="Power Solutions AC /DC PoE Injectors | IO by HFCL" />
	<meta property="og:description" content="Discover IO by HFCL's high-performance Power Solutions AC/DC PoE Injectors. Empower your network with reliable connectivity. Explore our cutting-edge technology today."/>
	<meta property="og:image" content="https://io.hfcl.com/images/product/power-featured.jpg" />

	 <!-- Twitter Meta Tags -->
	<meta property="twitter:card" content="summary_large_image" />
	<meta property="twitter:domain" content="io.hfcl.com/" />
	<meta property="twitter:url" content="https://io.hfcl.com/" />
	<meta property="twitter:title" content="Power Solutions AC /DC PoE Injectors | IO by HFCL" />
	<meta property="twitter:description" content="Discover IO by HFCL's high-performance Power Solutions AC/DC PoE Injectors. Empower your network with reliable connectivity. Explore our cutting-edge technology today."/>
	<meta property="twitter:image" content="https://io.hfcl.com/images/product/power-featured.jpg" />
   
    <?php else: ?>
	
	<title>High-Performance Access Points | IO by HFCL</title>
	<meta name="title" content="High-Performance Access Points | IO by HFCL" />
	<meta name="description" content="Discover IO by HFCL's high-performance access points for seamless connectivity. Explore our advanced networking solutions designed to enhance your digital experience."/>
	<link rel="canonical" href="https://io.hfcl.com/products/access-points" />

	 <!-- Facebook Meta Tags -->
	<meta property="og:type" content="website" />
	<meta property="og:url" content="https://io.hfcl.com/" />
	<meta property="og:title" content="High-Performance Access Points | IO by HFCL" />
	<meta property="og:description" content="Discover IO by HFCL's high-performance access points for seamless connectivity. Explore our advanced networking solutions designed to enhance your digital experience."/>
	<meta property="og:image" content="https://io.hfcl.com/images/product/access-featured.jpg" />

	 <!-- Twitter Meta Tags -->
	<meta property="twitter:card" content="summary_large_image" />
	<meta property="twitter:domain" content="io.hfcl.com/" />
	<meta property="twitter:url" content="https://io.hfcl.com/" />
	<meta property="twitter:title" content="High-Performance Access Points | IO by HFCL" />
	<meta property="twitter:description" content="Discover IO by HFCL's high-performance access points for seamless connectivity. Explore our advanced networking solutions designed to enhance your digital experience."/>
	<meta property="twitter:image" content="https://io.hfcl.com/images/product/access-featured.jpg" />
   
   <?php endif; ?>
	
	<?php include("include/header-link-small.php");?>

</head>

<body class="innerpage accesspoints <?php $path = substr($_SERVER["REQUEST_URI"],strrpos($_SERVER["REQUEST_URI"])+1);  echo "".$path;?>">

	<main class="root">

		<?php include("include/header.php");?>

		<!-- breadcrumb_area start -->
        <div class="breadcrumb_area">
            <div class="container">
                <div class="breadcumb_cnt">
                    <ul>
                        <li><a href="<?php echo BASE_URL; ?>">Home</a></li>
                        <li><i class="fa fa-angle-right" aria-hidden="true"></i></li>
                        <li><a href="<?php echo BASE_URL; ?>/products">Products</a></li>
                        <li><i class="fa fa-angle-right" aria-hidden="true"></i></li>
                        <li><?php echo $categoryDetails['category_name']; ?></li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- breadcrumb_area end -->

		<section class="hero-area10">
		    <div class="container">
		        <div class="hero-main10">
		            <div class="row">
		                <div class="col-lg-5 col-md-6 order-2 order-md-1">
		                    <div class="hero-left10">
		                        <h2><?php echo $categoryDetails['title']; ?></h2>
		                        <p><?php echo $categoryDetails['description']; ?></p>
		                        <ul>
		                            <li><a href="#">Contact Sales <span><img src="../images/arrow.svg" alt=""></span></a></li>
		                            <li><a href="#">Explore All Products</a></li>
		                        </ul>
		                    </div>
		                </div>
		                <div class="col-lg-7 col-md-6 order-1 order-md-2">
		                    <div class="hero-right10">
		                        <img src="../images/accesspoint/hero.png" alt="">
		                        <!-- <?php if($permalink == 'access-points'){ ?>
											<img src="<?php echo BASE_URL; ?>/images/catbanimg.png" alt="catbanimg" class="cenbanimg">
										<?php } ?> -->
		                    </div>
		                </div>
		            </div>
		        </div>
		    </div>
		</section>		

		<section class="efficient-area">
		    <div class="container">
		        <div class="efficient-main">
		            <div class="row">
		                <div class="col-lg-3 col-md-6">
		                    <div class="efficient-item efficient-item1">
		                        <h6><?php echo $categoryDetails['page_title']; ?></h6>
		                        <h2><?php echo $categoryDetails['page_description']; ?></h2>
		                        <?php 
											$image1 = $functions->getImageUrl('category', $categoryDetails['image1'], 'crop', '');
											$image2 = $functions->getImageUrl('category', $categoryDetails['image2'], 'crop', '');
											$image3 = $functions->getImageUrl('category', $categoryDetails['image3'], 'crop', '');
										?>
		                    </div>
		                </div>
		                <div class="col-lg-3 col-md-6">
		                    <div class="efficient-item">
		                        <img src="<?php echo $image1; ?>" alt="">
		                        <h4><?php echo $categoryDetails['title1']; ?></h4>
		                        <p><?php echo $categoryDetails['title1_description']; ?></p>
		                    </div>
		                </div>
		                <div class="col-lg-3 col-md-6">
		                    <div class="efficient-item">
		                        <img src="<?php echo $image2; ?>" alt="">
		                        <h4><?php echo $categoryDetails['title2']; ?></h4>
		                        <p><?php echo $categoryDetails['title2_description']; ?></p>
		                    </div>
		                </div>
		                <div class="col-lg-3 col-md-6">
		                    <div class="efficient-item">
		                        <img src="<?php echo $image3; ?>" alt="">
		                        <h4><?php echo $categoryDetails['title3']; ?></h4>
		                        <p><?php echo $categoryDetails['title3_description']; ?></p>
		                    </div>
		                </div>
		            </div>
		        </div>
		    </div>
		</section>

		<!--  -->
<section class="performance-wrapper">
    <div class="container">
        <div class="performance-main">
            <div class="performance-title text-center">
                <h2>High-performance APs</h2>
                <p>Discover AI-powered RF optimization, rich intelligence, and smart management options via cloud or on-premises.</p>
            </div>
            <div class="performance-item-wrap">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="performance-item">
                            <img src="../images/accesspoint/per1.png" alt="">
                            <div class="performance-cnt">
                                <h4>Indoor access points</h4>
                                <p>Lorem Ipsum is simply dummy text of the printing and type setting industry  text of the printing.</p>
                                <a href="#">Explore Products <span><img src="../images/arrow20.png" alt=""></span></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="performance-item">
                            <img src="../images/accesspoint/per2.png" alt="">
                            <div class="performance-cnt">
                                <h4>Outdoor access points</h4>
                                <p>Lorem Ipsum is simply dummy text of the printing and type setting industry  text of the printing. </p>
                                <a href="#">Explore Products <span><img src="../images/arrow20.png" alt=""></span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- casestudy-section -->
<section class="casestudy-area">
    <div class="casetudy-overlay"></div>
    <div class="container">
        <div class="casestudy-main">
            <h4>New Wi-Fi standard coming soon</h4>
            <p>Wi-Fi 7 (IEEE 802.11be) is the proposed standard for WLAN that increases data rates using 320 MHz channels, multi-link operations (MLO), and the 6 GHz band.</p>
            <a href="#">Read Casestudy <span><img src="../images/arrow30.png" alt=""></span></a>
        </div>
    </div>
</section>

<!-- knowmore-section -->
<section class="knowmore-area">
    <div class="container">
        <div class="knowmore-main">
            <div class="knowmore-img knowmore-img1">
                <img src="../images/accesspoint/knowmore.png" alt="">
            </div>
            <h3>Introducing the first self-locating APs</h3>
            <p>HPE Aruba Networking APs can automatically locate themselves, enabling highly accurate indoor location – everywhere.</p>
            <a href="#">Know more<span><img src="../images/arrow20.png" alt=""></span></a>
            <div class="knowmore-img knowmore-img2">
                <img src="../images/accesspoint/knowmore.png" alt="">
            </div>
        </div>
    </div>
</section>

<!-- resources-section -->
<section class="resources-area">
    <div class="container">
        <div class="resources-title text-center">
            <h2>Related resources</h2>
        </div>
        <div class="resources-main">
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="resources-item">
                        <img src="../images/accesspoint/resources.png" alt="">
                        <div class="resources-cnt">
                        	 <p class="resource-type">Casestudy</p>
                            <h5>Banking - NABARD</h5>
                            <p class="resource-text">Enhancing Operational Efficiency with HFCL's Access Solutions</p>
                            <a href="#" class="btn btn-solid btn-hover-swp border-none">
                               <span class="btn-txt">Read More</span>
                               <span class="btn-icon"><i class="fa fa-arrow-right"></i></span>
                               <span class="btn-icon"><i class="fa fa-arrow-right"></i></span>
                            </a>
                        </div>  
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="resources-item">
                        <img src="../images/accesspoint/resources.png" alt="">
                        <div class="resources-cnt">
                            <p class="resource-type">White Paper</p>
                            <h5>Wi-Fi 7</h5>
                            <p class="resource-text">HFCL Empowers Connectivity Beyond Imagination</p>
                            <a href="#" class="btn btn-solid btn-hover-swp border-none">
                               <span class="btn-txt">Read More</span>
                               <span class="btn-icon"><i class="fa fa-arrow-right"></i></span>
                               <span class="btn-icon"><i class="fa fa-arrow-right"></i></span>
                            </a>
                        </div>  
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="resources-item">
                        <img src="../images/accesspoint/resources.png" alt="">
                        <div class="resources-cnt">
                            <p class="resource-type">Video</p>
                            <h5>ion4x</h5>
                            <p class="resource-text">IO Wi-Fi 6 Dual Band 2x2:2 Outdoor Access Point with Integrated Antenna (8 dBi)</p>
                            <a href="#" class="btn btn-solid btn-hover-swp border-none">
                               <span class="btn-txt">Watch Now</span>
                               <span class="btn-icon"><i class="fa fa-arrow-right"></i></span>
                               <span class="btn-icon"><i class="fa fa-arrow-right"></i></span>
                            </a>
                        </div>  
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="resources-item">
                        <img src="../images/accesspoint/resources.png" alt="">
                        <div class="resources-cnt">
                            <p class="resource-type">Casestudy</p>
                            <h5>Banking - Bank of Baroda</h5>
                            <p class="resource-text">HFCL’s Make In India Switches deployment across 1600+ branches of Bank of Baroda</p>
                            <a href="#" class="btn btn-solid btn-hover-swp border-none">
                               <span class="btn-txt">Read More</span>
                               <span class="btn-icon"><i class="fa fa-arrow-right"></i></span>
                               <span class="btn-icon"><i class="fa fa-arrow-right"></i></span>
                            </a>
                        </div>  
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
		


	<?php 
		$faqList = "select * from ".PREFIX."faq_master where active='1' AND category_id='".$categoryDetails['id']."' ";
		$queryFaq = $functions->query($faqList);
		if($functions->num_rows($queryFaq) > 0){
	?>

	<section class="faq-defaultnew">
      <div class="container p0">
        <div class="faqs-in">
          <h2>Frequently Asked Questions</h2>
          <div class="faqs-box">
            <div class="faqs-list"><div id="mCSB_1" class="mCustomScrollBox mCS-light mCSB_vertical mCSB_inside" style="max-height: none;" tabindex="0"><div id="mCSB_1_container" class="mCSB_container mCS_y_hidden mCS_no_scrollbar_y" style="position:relative; top:0; left:0;" dir="ltr">
              <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                   <?php
									$faqSr = 1;
									while($feqDetails = $functions->fetch($queryFaq)){
							?>
                   <div class="panel panel-default">
                      <div class="panel-heading" role="tab" id="heading1">
                        <a class="panel-title" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $faqSr; ?>" aria-expanded="true" aria-controls="collapse<?php echo $faqSr; ?>">
                            <i class="more-less glyphicon glyphicon-plus"></i><?php echo $feqDetails['question']; ?></a>
                      </div>
                      <div id="collapse<?php echo $faqSr; ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading1">
                        <div class="panel-body">
                          <p><?php echo $feqDetails['answer']; ?></p>
                        </div>
                      </div>
                    </div>   
                    <?php $faqSr++; } ?>
              
              </div>
            </div></div></div>
          </div>
        </div>
      </div>
    </section>
	<?php } ?>



	</main>



	<?php include("include/footer.php");?> 
	<?php include("include/footer-link-small.php");?>

</body>

</html>