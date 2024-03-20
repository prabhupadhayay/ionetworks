<?php 
   include_once 'include/functions.php';
   $functions = new Functions();
   if(isset($_GET['permalink']) && !empty($_GET['permalink'])){
   		$permalink = $functions->escape_string($functions->strip_all($_GET['permalink']));
   		$productDetails = $functions->getProductByproductPermalink($permalink);
   		$productImage = $functions->getImageUrl('product', $productDetails['detail_image'], 'crop', '');
   		$subcategoryDetails = $functions->getUniqueSubCategoryById($productDetails['sub_category_id']);
   }else{
   	header("location: ".BASE_URL."/products");
   exit();
   }
   if(isset($_POST['submitContactForm'])){
   $chatSessionId = $_COOKIE["chatSessionId"];
   $first_name = $functions->escape_string($functions->strip_all($_POST['first_name']));
   $last_name = $functions->escape_string($functions->strip_all($_POST['last_name']));
   $mobile = $functions->escape_string($functions->strip_all($_POST['mobile']));
   $email = $functions->escape_string($functions->strip_all($_POST['email']));
   $company_name = $functions->escape_string($functions->strip_all($_POST['company_name']));
   $designation = $functions->escape_string($functions->strip_all($_POST['designation']));
   $country = $functions->escape_string($functions->strip_all($_POST['country']));
   if(isset($_POST['city'])){
   $city = $functions->escape_string($functions->strip_all($_POST['city']));
   }else{
   $city = "";
   }
   $product_id = $functions->escape_string($functions->strip_all($_POST['productData']));
   $sql = "insert into ".PREFIX."document_download_request(chatSessionId, first_name, last_name, mobile, email, company_name, designation, country, city, product_id)VALUES('".$chatSessionId."', '".$first_name."', '".$last_name."', '".$mobile."', '".$email."', '".$company_name."', '".$designation."', '".$country."', '".$city."', '".$product_id."')";
   $functions->query($sql);
   $prDetails = $functions->getUniqueProductById($product_id);
   $fileCnt=0;
   $data_sheet = "";
   $product_id = $functions->encryptValue($product_id);
   if(!empty($prDetails['data_sheet'])){
   $fileCnt++;
   $data_sheet = $chatSessionId."&ftype=data_sheet&pd=".$product_id;
   }
   $user_start_guide ="";
   if(!empty($prDetails['user_start_guide'])){
   $fileCnt++;
   $user_start_guide = $chatSessionId."&ftype=user_start_guide&pd=".$product_id;
   }
   
   $start_guide ="";
   if($prDetails['display_user_manual'] > 0){
   $fileCnt++;
   $start_guide = $chatSessionId."&ftype=start_guide&pd=".$product_id;
   }

   $brochure ="";
   if(!empty($prDetails['brochure'])){
   $fileCnt++;
   $brochure = $chatSessionId."&ftype=brochure&pd=".$product_id;
   }
   $noFileMessage="";
   if($fileCnt == 0){
   $noFileMessage = "No files are added in this product";
   }
   include_once("include/emailers/download-resource.php");
   include_once("include/classes/Email.class.php");
   $to = $email;
   $subject = SITE_NAME." | Download Resources";
   $emailObj = new Email();
   $emailObj->setSubject($subject);
   $emailObj->setEmailBody($emailMsg);
   $emailObj->setAddress($to);
   $emailObj->sendEmail();
   //$emailObj->setAddress("iosupport@hfcl.com");
   //$emailObj->sendEmail();
   //$emailObj->setAddress("iosales@hfcl.com");
   //$emailObj->sendEmail();
   header("location: ".BASE_URL."/Documentation/Resource-Download");
   exit();
   }
   ?>
<!DOCTYPE html>
<html>
   <head>
      <title><?php echo SITE_NAME; ?> || Product Details </title>
      <?php include("include/header-link.php");?>

      <meta name="description" content="Get a glimpse of the latest Wi-Fi trends and technologies with IO by HFCL's blogs to stay informed about how Wi-Fi will soon change our world">
   </head>
   <body class="innerpage ">
      <main class="root">
         <?php include("include/header.php");?>
         <section class="breadcrumb-section mtop">
            <div class="container p0">
               <ul class="breadcrumb-in">
                  <li class="wow fadeIn" data-wow-delay="0.5s"><a href="<?php echo BASE_URL; ?>/index.php">Home</a></li>
                  <li class="wow fadeIn" data-wow-delay="0.55s"><a href="<?php echo BASE_URL; ?>/products">Product</a></li>
                  <li class="wow fadeIn" data-wow-delay="0.6s"><a href="<?php echo BASE_URL; ?>/category/<?php echo $subcategoryDetails['permalink']; ?>"><?php echo $subcategoryDetails['category_name']; ?></a></li>
                  <li class="wow fadeIn" data-wow-delay="0.65s"><a href="javascript:void(0);"><?php echo $productDetails['product_name']; ?></a></li>
               </ul>
            </div>
         </section>
         <section class="pd-main-section">
            <div class="container p0">
               <div class="pd-main-wrapper">
                  <div class="pd-main-left">
                     <div class="pd-imagegallery">
                        <div class="pd-bigimgbox">
                           <img src='<?php echo $productImage; ?>' alt="productname" class="width100 " id="zoom_03" />
                        </div>
                        <div class="pd-gallerywrap">
                           <div id="gallery_01">
                              <a href="#" class="elevatezoom-gallery active" data-update="" data-image="<?php echo $productImage; ?>" data-zoom-image="<?php echo $productImage; ?>">
                                 <div class="pdgallerybox">
                                    <img src="<?php echo $productImage; ?>"/>
                                 </div>
                              </a>
                              <?php 
                                 if(!empty($productDetails['detail_imagee1'])){
                                 	$detail_imagee1 = $functions->getImageUrl('product', $productDetails['detail_imagee1'], 'crop', '');
                                 ?>
                              <a href="#" class="elevatezoom-gallery" data-update="" data-image="<?php echo $detail_imagee1; ?>" data-zoom-image="<?php echo $detail_imagee1; ?>">
                                 <div class="pdgallerybox">
                                    <img src="<?php echo $detail_imagee1; ?>"/>
                                 </div>
                              </a>
                              <?php } ?>
                              <?php 
                                 if(!empty($productDetails['detail_imagee2'])){
                                 	$detail_imagee2 = $functions->getImageUrl('product', $productDetails['detail_imagee2'], 'crop', '');
                                 ?>
                              <a href="#" class="elevatezoom-gallery" data-update="" data-image="<?php echo $detail_imagee2; ?>" data-zoom-image="<?php echo $detail_imagee2; ?>">
                                 <div class="pdgallerybox">
                                    <img src="<?php echo $detail_imagee2; ?>"/>
                                 </div>
                              </a>
                              <?php } ?>
                              <?php 
                                 if(!empty($productDetails['detail_imagee3'])){
                                 	$detail_imagee3 = $functions->getImageUrl('product', $productDetails['detail_imagee3'], 'crop', '');
                                 ?>
                              <a href="#" class="elevatezoom-gallery" data-update="" data-image="<?php echo $detail_imagee3; ?>" data-zoom-image="<?php echo $detail_imagee3; ?>">
                                 <div class="pdgallerybox">
                                    <img src="<?php echo $detail_imagee3; ?>"/>
                                 </div>
                              </a>
                              <?php } ?>
                              <?php 
                                 if(!empty($productDetails['detail_video'])){
                                 ?>
                              <a class="elevatezoom-gallery" data-update="" data-image="<?php echo $productImage; ?>" data-zoom-image="<?php echo $productImage; ?>">
                                 <div class="pdgallerybox video-gallery" data-id="myVideo1">
                                    <img src="<?php echo $productImage; ?>"/>
                                    <img src='<?php echo BASE_URL; ?>/images/video-icon.png' class="video-icon">
                                 </div>
                              </a>
                              <?php } ?>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="pd-main-right">
                     <div class="pdmain-text">
                        <h1 class="pdm-heading1 wow fadeInUp" data-wow-delay="0.5s"><?php echo $productDetails['product_name']; ?> </h1>
                        <h4 class="pdm-heading4 wow fadeInUp" data-wow-delay="0.55s"><?php echo $productDetails['product_title']; ?></h4>
                        <p class="pdm-paragraph wow fadeInUp" data-wow-delay="0.6s">
                           <?php echo $productDetails['short_description']; ?>
                        </p>
                     </div>
                  </div>
               </div>
            </div>
         </section>
         <section class="pd-overview-section">
            <div class="container p0">
               <div class='pd-overview-wrapper'>
                  <h2 class="pd-overview-heading wow fadeIn" data-wow-delay="0.5s">Overview</h2>
                  <div class="pd-overviewlist wow fadeInUp" data-wow-delay="0.55s">
                     <?php echo $productDetails['overview']; ?>
                  </div>
               </div>
            </div>
         </section>
         <?php 
            $sqlSpecification = "select * from ".PREFIX."product_specification_master where active='1' AND product_id='".$productDetails['id']."' ";
            $querySpecification = $functions->query($sqlSpecification);
            if($functions->num_rows($querySpecification) > 0){
            ?>
         <section class="pd-features-section">
            <div class="container p0">
               <div class="pd-features-wrapper">
                  <?php 
                     while($specificationDetails = $functions->fetch($querySpecification)){
                     $specificationImage = $functions->getImageUrl('product', $specificationDetails['image_name'], 'crop', '');
                     ?>
                  <div class="pd-features-box wow fadeInUp" data-wow-delay="0.2s">
                     <div class="pd-features-icon">
                        <img src='<?php echo $specificationImage; ?>' alt="higher-efficency" class="width100" />
                     </div>
                     <div class="pd-features-text">
                        <h4 class="pd-feature-head"><?php echo $specificationDetails['title']; ?></h4>
                        <p><?php echo $specificationDetails['description']; ?></p>
                     </div>
                  </div>
                  <?php } ?>
               </div>
            </div>
         </section>
         <?php } ?>

         <?php if(strlen($productDetails['detail_description']) > 2 ){ ?>
            <section class="pd-application-section wow fadeInUp" data-wow-delay="0.5s">
               <div class="pd-application-wrapper">
                  <div class='pd-application-left'>
                     <div class="pd-application-forslider pd-application-dots">
                        <?php 
                           if(!empty($productDetails['detail_image1'])){
                           	$detail_image1 = $functions->getImageUrl('product', $productDetails['detail_image1'], 'crop', '');
                           ?>
                        <div class="pd-application-forslider-item">
                           <img src="<?php echo $detail_image1; ?>" alt="stadium-products" class="width100"/>
                        </div>
                        <?php
                           }
                           ?>	
                        <?php 
                           if(!empty($productDetails['detail_image2'])){
                           	$detail_image2 = $functions->getImageUrl('product', $productDetails['detail_image2'], 'crop', '');
                           ?>
                        <div class="pd-application-forslider-item">
                           <img src="<?php echo $detail_image2; ?>" alt="stadium-products" class="width100"/>
                        </div>
                        <?php
                           }
                           ?>	
                        <?php 
                           if(!empty($productDetails['detail_image3'])){
                           	$detail_image3 = $functions->getImageUrl('product', $productDetails['detail_image3'], 'crop', '');
                           ?>	
                        <div class="pd-application-forslider-item">
                           <img src="<?php echo $detail_image3; ?>" alt="stadium-products" class="width100"/>
                        </div>
                        <?php
                           }
                           ?>	
                        <?php 
                           if(!empty($productDetails['detail_image4'])){
                           	$detail_image4 = $functions->getImageUrl('product', $productDetails['detail_image4'], 'crop', '');
                           ?>
                        <div class="pd-application-forslider-item">
                           <img src="<?php echo $detail_image4; ?>" alt="stadium-products" class="width100"/>
                        </div>
                        <?php
                           }
                           ?>	
                        <?php 
                           if(!empty($productDetails['detail_image5'])){
                           	$detail_image5 = $functions->getImageUrl('product', $productDetails['detail_image5'], 'crop', '');
                           ?>
                        <div class="pd-application-forslider-item">
                           <img src="<?php echo $detail_image5; ?>" alt="stadium-products" class="width100"/>
                        </div>
                        <?php
                           }
                           ?>	
                     </div>
                  </div>
                  <div class='pd-application-right'>
                     <div class="pd-application-text">
                        <?php echo $productDetails['detail_description']; ?>
                     </div>
                  </div>
               </div>
            </section>
         <?php } ?>
         <?php 
            $topPics = explode(",",$productDetails['top_pics']);
            if(count($topPics) > 0){
            	$productList = "select * from ".PREFIX."product_master where active='1' AND FIND_IN_SET(id,'".$productDetails['top_pics']."') ";
            $productQuery = $functions->query($productList);
            if($functions->num_rows($productQuery)>0){
            ?>
         <section class='toppicks-section'>
            <div class='container p0'>
               <h2 class="sectionheading wow fadeInUp" data-wow-delay="0.5s">Top Picks to Complement Your Choice</h2>
               <div class='toppicks-slider-wrapper'>
                  <div class="toppicks-slider thinslicksliderarrow">
                     <?php
                        while($productDetailsData = $functions->fetch($productQuery)){
                        	$proImage = $functions->getImageUrl('product', $productDetailsData['category_image'], 'crop', '');
                        ?>
                     <div class="toppicks-slider-item">
                        <div class="toppicks-slider-item-inner">
                           <div class="toppicks-slider-image">
                              <img src='<?php echo $proImage; ?>' alt="ion4i-2by2" />
                           </div>
                           <div class="tp-text">
                              <h4><?php echo $productDetailsData['product_name']; ?></h4>
                              <a href="<?php echo BASE_URL; ?>/product/<?php echo $productDetailsData['permalink']; ?>" class="dknowbtn">Know More</a>
                           </div>
                        </div>
                     </div>
                     <?php } ?>
                  </div>
               </div>
            </div>
         </section>
         <?php } } ?>
         <section class='pdresources-section'>
            <img src='<?php echo BASE_URL; ?>/images/resourcesafter.png' class='resourcesafter' />
            <div class="container p0">
               <h2 class="sectionheading wow fadeInUp" data-wow-delay="0.5s">Resources</h2>
               <div class="pdresources-wrapper">
                  <?php 
                     if(!empty($productDetails['data_sheet'])){
                     ?>
                  <a data-fancybox="" data-src="#content" href="javascript:void(0);" class="fancyboxbtn pdresources-box wow fadeInUp" data-wow-delay="0.5s">
                     <div class="pdresources-left">
                        <img src="<?php echo BASE_URL; ?>/images/Data-Sheet.png" alt='Data-Sheet' />
                        <img src="<?php echo BASE_URL; ?>/images/resources-download.png" alt='resources-download' class='resources-download'/>
                     </div>
                     <div class="pdresources-right">
                        <p>Datasheet</p>
                     </div>
                  </a>
                  <?php } 
                     if(!empty($productDetails['user_start_guide'])){
                     ?>
                  <a data-fancybox="" data-src="#content" href="javascript:void(0);" class="fancyboxbtn pdresources-box wow fadeInUp" data-wow-delay="0.55s">
                     <div class="pdresources-left">
                        <img src="<?php echo BASE_URL; ?>/images/Data-Sheet.png" alt='Data-Sheet' />
                        <img src="<?php echo BASE_URL; ?>/images/resources-download.png" alt='resources-download' class='resources-download'/>
                     </div>
                     <div class="pdresources-right">
                        <p>Quick Start Guide</p>
                     </div>
                  </a>
                  <?php } 
                     if($productDetails['display_user_manual'] > 0){
                     ?>
                  <a data-fancybox="" data-src="#content" href="javascript:void(0);" class="fancyboxbtn pdresources-box wow fadeInUp" data-wow-delay="0.6s">
                     <div class="pdresources-left">
                        <img src="<?php echo BASE_URL; ?>/images/Data-Sheet.png" alt='Data-Sheet' />
                        <img src="<?php echo BASE_URL; ?>/images/resources-download.png" alt='resources-download' class='resources-download'/>
                     </div>
                     <div class="pdresources-right">
                        <p>User Manual</p>
                     </div>
                  </a>
                  <?php } 
                     if(!empty($productDetails['brochure'])){
                     ?>
                  <a data-fancybox="" data-src="#content" href="javascript:void(0);" class="fancyboxbtn pdresources-box wow fadeInUp" data-wow-delay="0.65s">
                     <div class="pdresources-left">
                        <img src="<?php echo BASE_URL; ?>/images/Data-Sheet.png" alt='Data-Sheet' />
                        <img src="<?php echo BASE_URL; ?>/images/resources-download.png" alt='resources-download' class='resources-download'/>
                     </div>
                     <div class="pdresources-right">
                        <p>Brochure</p>
                     </div>
                  </a>
                  <?php } ?>
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
      <div style="display: none;" id="content" class="contentclass">
         <h2>To Download, Please Fill the Form</h2>
         <form class="formclass" method="POST" id="submitDocumentationForm" autocomplete="off">
            <div class="form-group">
               <input type="text" name="first_name" class="form-control" placeholder="First Name">
            </div>
            <div class="form-group">
               <input type="text" name="last_name" class="form-control" placeholder="Last Name">
            </div>
            <div class="form-group">
               <input type="text" name="mobile" class="form-control validateMobileClass" placeholder="Mobile No">
            </div>
            <div class="form-group">
               <input type="email" name="email" class="form-control" placeholder="Company Email id">
            </div>
            <div class="form-group">
               <input type="text" name="company_name" class="form-control" placeholder="Company Name">
            </div>
            <div class="form-group">
               <input type="text" name="designation" class="form-control" placeholder="Designation">
            </div>
            <div class="form-group">
               <select name="country" class="form-control checkcountryvalidation">
                  <option selected disabled focus>Country</option>
                  <?php 
                     $sql = $functions->query("select * from ".PREFIX."country_master where is_deleted='0' AND active='1' ");
                     while($countryDetails = $functions->fetch($sql)){
                     ?>
                  <option <?php if($countryDetails['country_name'] == ''){ echo 'selected'; }?> value="<?php echo $countryDetails['country_name']; ?>"><?php echo $countryDetails['country_name']; ?></option>
                  <?php } ?>
               </select>
            </div>
            <div class="form-group onchcontry">
               <input type="text" name="city" class="form-control" placeholder="Enter City" required>
               <?/*<select name="city" id="cityContact" class="form-control">
                  <?php 
                     $sqlCity = $functions->query("select * from ".PREFIX."city_master where is_deleted='0' AND active='1' AND country_id='101' ORDER BY city_name ASC");
                     	while($cityDetails = $functions->fetch($sqlCity)){
                     ?>
               <option value="<?php echo $cityDetails['city_name']; ?>"><?php echo $cityDetails['city_name']; ?></option>
               <?php } ?>
               </select>*/?>
            </div>
            <div class="btnbox">
               <input type="hidden" name="productData" id="productData" value="<?php echo $productDetails['id']; ?>" >
               <button type="submit" name="submitContactForm">Submit</button>
               <p class="redtext">All fields are mandatory</p>
            </div>
         </form>
      </div>
      <div class="videopopup">
         <div class="videocontainer">
            <div class="videoclose">
               <i class='fa fa-close'></i>
            </div>
            <div class="videowrapper">
               <video oncontextmenu="return false;" controls loop id="myVideo1" controlsList="nodownload">
                  <source src="<?php echo BASE_URL."/images/videos/".$productDetails['detail_video']; ?>">
                  Your browser doesn't support HTML5 video tag.
               </video>
            </div>
         </div>
      </div>
      <?php include("include/footer.php");?> 
      <?php include("include/footer-link.php");?>
      <script src="<?php echo BASE_URL;?>/js/jquery.elevatezoom-min.js" type="text/javascript"></script>
      <script type="text/javascript">
         $(document).ready(function() {  
         	$("#").validate({
         		ignore: [],
         		debug: false,
         		rules: {
         			first_name:{
         				required:true
         			},
         			last_name:{
         				required:true
         			},
         			mobile:{
         				required:true,
         				number:true,
                     minlength:10,
                     maxlength:10
         			},
         			email:{
         				required:true,
         				email:true,
                     remote:{
                        url:"<?php echo BASE_URL; ?>/ajax-check-email-contains.php",
                        type: "post"
                     }
         			},
         			company_name:{
         				required:true
         			},
         			designation:{
         				required:true
         			},
         			country:{
         				required:true
         			},
         			city:{
         				required:true,
                     lettersonly:true
         			}
         		},
         		messages: {
                  email:{
                     remote:"gmail/yahoo/outlook and rediff email id is not allowed."
                  },
         			image_name: {
         				extension: "Please upload jpg or png image"
         			},
         			investor:{
         				extension: "Please upload pdf only",
         				filesize:"Max 5 MB file size allowed"
         			}
         		}
         	}); 

            $.validator.addMethod("lettersonly", function(value, element) {
                return this.optional(element) || /^[a-zA-Z ]*$/.test(value);
            }, "Letters only please");

            $(".fancyboxbtn").fancybox({
                     clickSlide: false,
                     clickOutside: false,
                     touch: false
                 });
         });
         $(document).ready(function(){
         	
         		$("#zoom_03").elevateZoom({
         			gallery:'gallery_01',
         			zoomWindowWidth:500,
         			zoomWindowHeight:500,
         			zoomEnabled: false,
         			cursor: 'crosshair',
         			scrollZoom : false,
         			zoomLevel:0.8,
         			scrollZoom:false,
         			easing :false,
         			galleryActiveClass: 'active',
         			loadingIcon: 'https://www.elevateweb.co.uk/spinner.gif'
         		});

         		$("#gallery_01").slick({
         			slidesToScroll: 1,
         			slidesToShow: 5,
         			arrows:false,
    				infinite:false,
         			responsive: [
    					{
    				      breakpoint: 993,
    				      settings: {
    				        slidesToShow: 3,
    				        slidesToScroll: 1,
    				        infinite:false,
			            	dots:true
    				      }
    				    }
    				]
         		});
         	

         	$(".toppicks-slider").slick({
         		slidesToShow: 3,
         		slidesToScroll:1,
     			responsive: [
					{
				      breakpoint: 993,
				      settings: {
				        slidesToShow: 2,
				        slidesToScroll: 1
				      }
				    },
			    	{
			          breakpoint: 768,
			          settings: {
			            slidesToShow: 1,
			            slidesToScroll: 1,
			            dots:true
			          }
			        }
				]

         	});
         	$('.pd-application-forslider').slick({
         		slidesToShow: 1,
         		slidesToScroll: 1,
         		arrows: false,
         		dots:true,
               autoplay:true,
               autoplaySpeed:1500,
               speed:2000
         	});
         	$('.pd-application-textslider').slick({
         		slidesToShow: 3,
         		slidesToScroll: 1,
         		vertical:true,
         		arrows:false,
         		verticalSwiping:true,
         		//asNavFor: '.pd-application-forslider',
         		focusOnSelect: true,
         	});
           		$(".video-gallery").click(function(){
           			$(".videopopup").addClass("shows");
           			$("#myVideo1").get(0).play();
                  $('html').css({"overflow":"hidden"});
           		});
           		$(".videoclose").click(function(){
           			$(".videopopup").removeClass("shows");
           			$("#myVideo1").get(0).pause();
                  $('html').css({"overflow":"unset"});
           		});
         });
      </script>
   </body>
</html>