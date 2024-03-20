<?php 
   include_once 'include/functions.php';
   $functions = new Functions();
   $sqlVideo = "select * from ".PREFIX."home_cms";
   $resultsVideo = $functions->fetch($functions->query($sqlVideo));
   if($resultsVideo['video_active'] == '1'){
   	$bannerImage = $functions->getImageUrl('home-banners', $resultsVideo['banner_image'], 'crop', '');
   }else{
   }
?>
<!DOCTYPE html>
<html>
   <head>
     
      <title><?php echo SITE_NAME; ?> || Home </title>
      <?php include("include/header-link.php");?>
   </head>
   <body class="homepage">
      <?php include("include/header.php");?>
      <main class="root">
         <div id="fullpage">
            <?php 
               if($resultsVideo['video_active'] == '1'){
               	?>
            <section class="section homepage-banner">
               <img src="<?php echo $bannerImage; ?>" alt="topbanner" loading="lazy" class="staticbanner">
               <div class="textbanner">
                  <div class="container p0">
                     <div class="textbannerin wow fadeIn" data-wow-delay="0.5s">
                        <h1><?php echo $resultsVideo['banner_title']; ?></h1>
                     </div>
                  </div>
               </div>
            </section>
            <?php }else{ ?>
            <section class="section homepage-banner" id="videobanner">
               <div class="relative">
                   <video autoplay playsinline loop muted id="videosss">
                     <source src="images/videos/<?php echo $resultsVideo['banner_video']; ?>" type="video/mp4" muted/>
                  </video> 
                  <button class="mutbtn"><i class="fa fa-microphone-slash" aria-hidden="true"></i></button>
               </div>
            </section>
            <?php } ?>
            <section class="section homepagebanner-slider" style="background-image:url('images/banners/banner.png');">
               <div class="homepagebanner-in">
                  <div class="container p0">
                     <div class="sliderflexx">
                        <div class="lefthomeslider">
                           <?php
                              $bannerRS = $functions->getSliderbBanner();
                              while($sliderRow = $functions->fetch($bannerRS)) {
                              	$sliderBanner = $functions->getImageUrl('home-banners', $sliderRow['image_name'], 'crop', '');
                              	?>
                           <div class="imgbox">
                              <img src="<?php echo $sliderBanner; ?>" alt="imgslide">
                           </div>
                           <?php } ?>
                        </div>
                        <div class="righthomeslider">
                           <?php
                              $bannerText = $functions->getSliderbBanner();
                              while($sliderData = $functions->fetch($bannerText)) {
                              	?>
                           <div class="contenttext">
                              <div class="contenttextflexx">
                                 <div class="topbox">
                                    <h2><strong><?php echo $sliderData['title1']; ?></strong></h2>
                                 </div>
                                 <div class="bottombox">
                                    <h2><?php echo $sliderData['title2']; ?></h2>
                                    <p><?php echo $sliderData['description']; ?></p>
                                    <a href="<?php echo $sliderData['url']; ?>" class="knowbtn">Know More</a>
                                 </div>
                              </div>
                           </div>
                           <?php } ?>
                        </div>
                     </div>
                  </div>
               </div>
            </section>
            <section class="section futureconnectivity-section" style="background-image:url('images/futureconnect.png');">
               <div class="container-fluid p0">
                  <div class="futureconnectivity-in">
                     <div class="tab-content">
                        <?php 
                           $homeSliderText = $functions->getAllActiveHomeSlider();
                           $y = 1;
                           while($sliderDataText = $functions->fetch($homeSliderText)) {
                           	?>
                        <div id="tab<?php echo $y; ?>" class="tab-pane <?php if($y=='1'){ ?> in active <?php } ?>">
                           <div class="futureconnectflex">
                              <div class="imgleftbox">
                                 <div class="videoshowbox">
                                    <!-- <img src="images/videos/<?php //echo $sliderDataText['slider_video']; ?>"> -->
                                    <video autoplay playsinline loop muted>
                                       <source src="images/videos/<?php echo $sliderDataText['slider_video']; ?>" type="video/mp4" muted >
                                       Your browser doesn't support HTML5 video tag.
                                    </video>
                                 </div>
                                 <!-- <img src="images/mobileimg.png" alt="mobileimg" class="mobimgbox"> -->
                              </div>
                              <div class="textrightbox">
                                 <h2><?php echo $sliderDataText['title']; ?></h2>
                                 <p><?php echo $sliderDataText['description']; ?></p>
                                 <a href="<?php echo $sliderDataText['url']; ?>" class="knowbtn">Know More</a>
                              </div>
                           </div>
                        </div>
                        <?php $y++; } ?>
                     </div>
                     <ul class="nav nav-pills futureconnectivity-tabs">
                        <?php 
                           $homeSlider = $functions->getAllActiveHomeSlider();
                           $x = 1;
                           while($sliderData = $functions->fetch($homeSlider)) {
                           	$sliderIcon = $functions->getImageUrl('home-banners', $sliderData['image_name'], 'crop', '');
                           	?>
                        <li onclick="tabsnavclick1(<?php echo $x; ?>);" class="tabsnavclick1 <?php if($x=='1'){ ?> active <?php } ?>"><a data-toggle="pill" href="#tab<?php echo $x; ?>"><img src="<?php echo $sliderIcon; ?>" alt="tab<?php echo $x; ?>"></a></li>
                        <?php $x++; } ?>
                     </ul>
                  </div>
               </div>
               <!-- <img src="images/rightbottom.png" alt="rightbottom" class="brightimg"> -->
            </section>
            <section class="section superiorsolution-section" style="background-image:url('images/supsol.png');">
               <!-- <section class="section superiorsolution-section"> -->
               <img src="images/rightbottom.png" alt="rightbottom" class="trightimg">
               <div class="superiorsolution-in">
                  <div class="container p0">
                     <h2 class="wow fadeIn" data-wow-delay="0.15s">Get off to a perfect start <br>with our superior solutions</h2>
                     <ul class="nav nav-pills superiorsolution-tabs" id="suptab">
                        <?php 
                           $sqlCategoryProduct = "select * from ".PREFIX."category_master where active='1' and show_tab='1' ";
                           $queryCategoryProduct = $functions->query($sqlCategoryProduct);
                           $subCat = 1;
                           while($categoryDetails = $functions->fetch($queryCategoryProduct)){
                           	?>
                        <li <?php if($subCat == '1'){ ?>class="active" <?php } ?>><a data-toggle="pill" href="#supertab<?php echo $subCat; ?>"><?php echo $categoryDetails['category_name']; ?></a></li>
                        <?php $subCat++; } ?>
                     </ul>
                     <div class="tab-content superiorsolution-content">
                        <?php 
                           $sqlCategoryProductd = "select * from ".PREFIX."category_master where active='1' and show_tab='1' ";
                           $queryCategoryProductd = $functions->query($sqlCategoryProductd);
                           $subCatd = 1;
                           while($categoryDetailsd = $functions->fetch($queryCategoryProductd)){
                           	?>
                        <div id="supertab<?php echo $subCatd; ?>" class="tab-pane <?php if($subCatd == '1'){ ?>in active <?php } ?>">
                           <div class="supproductslider thinslicksliderarrow">
                              <?php 
                                 $productList = "select * from ".PREFIX."product_master where active='1' AND category_id='".$categoryDetailsd['id']."' AND only_for_documentation='0' ";
                                 $productQuery = $functions->query($productList);
                                 while($productDetails = $functions->fetch($productQuery)){
                                 	$proImage = $functions->getImageUrl('product', $productDetails['home_image'], 'crop', '');
                                    $subcategoryDetailsCheck = $functions->getUniqueSubCategoryById($productDetails['sub_category_id']);
                                 	?>
                              <div class="supproductslide match">
                                 <div class="prothumb">
                                    <img src="<?php echo $proImage; ?>" alt="suppro1">
                                 </div>
                                 <div class="protext">
                                    <h6><?php echo $productDetails['product_name']; ?></h6>
                                    <p><?php echo $productDetails['short_description']; ?></p>
                                    <a href="<?php echo BASE_URL; ?>/products/<?php echo $subcategoryDetailsCheck['permalink']; ?>/<?php echo $productDetails['permalink']; ?>" class="probtn">Know More</a>
                                 </div>
                              </div>
                              <?php } ?>
                           </div>
                           <div class="flexbtn">
                              <!-- <a href="<?php //echo BASE_URL; ?>/category/<?php //echo $categoryDetailsd['permalink']; ?>" class="knowbtn">View All</a> -->
                              <a href="<?php echo BASE_URL; ?>/products" class="knowbtn">View All</a>
                           </div>
                        </div>
                        <?php $subCatd++; } ?>
                     </div>
                     <!-- Bootstrap Accordion -->
                     <div class="panel-group" id="accordion1" role="tablist" aria-multiselectable="true"></div>
                     <!-- /Bootstrap Accordion -->
                  </div>
               </div>
               <img src="images/leftbig.png" alt="leftbig" class="lbimg">
            </section>
            <?php 
               $sqlEmpower = "select * from ".PREFIX."industry_empower_master where active='1' ";
               $queryEmpower = $functions->query($sqlEmpower);
               if($functions->num_rows($queryEmpower) >0){
               	?>
            <section class="section empoweringind-section">
               <img src="<?php echo BASE_URL; ?>/images/leftbig.png" alt="leftbig" class="ltimg">
               <div class="empoweringind-in">
                  <div class="container p0">
                     <h2 class="mobileheader">Empowering Industries with Connected Tech</h2>
                     <div class="empoweringind-slider sliderdots">
                        <?php 
                           while($empowerDetails = $functions->fetch($queryEmpower)){
                           	$image1 = $functions->getImageUrl('industry', $empowerDetails['image1'], 'crop', '');
                           	$image2 = $functions->getImageUrl('industry', $empowerDetails['image2'], 'crop', '');
                           	$image3 = $functions->getImageUrl('industry', $empowerDetails['image3'], 'crop', '');
                           	$industryName1 = $functions->getUniqueIndustryById($empowerDetails['industry1']);
                           	$industryName2 = $functions->getUniqueIndustryById($empowerDetails['industry2']);
                           	$industryName3 = $functions->getUniqueIndustryById($empowerDetails['industry3']);
                           	?>
                        <div class="empoweringind-slide">
                           <div class="empowerflex">
                              <div class="empowercontent">
                                 <!-- <h2>Enabling Expansion With Cutting Edge Solutions</h2> -->
                                 <h2>Empowering Industries with Connected Tech</h2>
                                 <div class="inflex">
                                    <div class="rowbox">
                                       <div class="inimg">
                                          <img src="<?php echo $image1; ?>">
                                       </div>
                                       <div class="intext">
                                          <h4><?php echo $industryName1['name']; ?></h4>
                                          <p><?php echo $empowerDetails['text1']; ?></p>
                                          <a href="<?php echo BASE_URL; ?>/industries/<?php echo $industryName1['permalink']; ?>" class="arclick"><img src="<?php echo BASE_URL; ?>/images/right-arrow.png" alt="right-arrow"></a>
                                       </div>
                                    </div>
                                    <div class="rowbox">
                                       <div class="inimg">
                                          <img src="<?php echo $image2; ?>">
                                       </div>
                                       <div class="intext">
                                          <h4><?php echo $industryName2['name']; ?></h4>
                                          <p><?php echo $empowerDetails['text2']; ?></p>
                                          <a href="<?php echo BASE_URL; ?>/industries/<?php echo $industryName2['permalink']; ?>" class="arclick"><img src="<?php echo BASE_URL; ?>/images/right-arrow.png" alt="right-arrow"></a>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="empowerimgbox">
                                 <img src="<?php echo $image3; ?>" alt="empower">
                                 <div class="textonimg">
                                    <div class="toptext">
                                       <h4><?php echo $industryName3['name']; ?></h4>
                                       <p><?php echo $empowerDetails['text3']; ?></p>
                                    </div>
                                    <a class="clickbox" href="<?php echo BASE_URL; ?>/industries/<?php echo $industryName3['permalink']; ?>">View More</a>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <?php } ?>
                     </div>
                     <div class="flexbtn">
                        <a href="<?php echo BASE_URL; ?>/industries" class="knowbtn">View All</a>
                     </div>
                  </div>
               </div>
               <img src="images/rightbottom.png" alt="rightbottom" class="rightbimg">
            </section>
            <?php } ?>
            <section class="section headlinessection">
               <img src="images/faqsrotate.png" alt="faqsrotate" class="headhorimg">
               <div class="headlines-in">
                  <div class="container p0">
                     <h2 class="wow fadeIn" data-wow-delay="0.15s">Hitting headlines and how!</h2>
                     <div class="headlinebox">
                        <div class="headlineimgslider">
                           <?php 
                              $homeHeadline = $functions->getAllActiveHomeHeadline();
                              while($headlineData = $functions->fetch($homeHeadline)) {
                              	$headlineImage = $functions->getImageUrl('home-banners', $headlineData['image_name'], 'crop', '');
                              	?>
                           <div class="headlineimgslide">
                              <img src="<?php echo $headlineImage; ?>" alt="headline">
                           </div>
                           <?php } ?>
                        </div>
                        <div class="headlinetextslider sliderdots">
                           <?php 
                              $homeHeadlineText = $functions->getAllActiveHomeHeadline();
                              while($headlineTextData = $functions->fetch($homeHeadlineText)) {
                              	?>
                           <div class="headlinetextslide">
                              <h3><?php echo $headlineTextData['title']; ?></h3>
                              <p><?php echo $headlineTextData['description']; ?></p>
                              <a href="<?php echo $headlineTextData['url']; ?>" class="knowbtn">Read More</a>
                           </div>
                           <?php } ?>
                        </div>
                     </div>
                  </div>
               </div>
            </section>
            <section class="section testimonials-section">
               <div class="testimonials-in">
                  <div class="container p0">
                     <h2 class="wow fadeIn" data-wow-delay="0.15s">Here’s why we take pride in what we do</h2>
                     <div class="testslider">
                        <ul class="flip-items thinslicksliderarrow">
                           <?php 
                              $testimonial = $functions->getAllActiveHomeTestimonial();
                              while($homeTestimonial = $functions->fetch($testimonial)){
                              	$homeTestimonialImage = $functions->getImageUrl('home-banners', $homeTestimonial['image_name'], 'crop', '');
                              	?>
                           <li class="testslide">
                              <img src="<?php echo $homeTestimonialImage; ?>" alt="testimg">
                              <div class="textmontext">
                                 <div class="topcom">
                                    <p><?php echo $homeTestimonial['description']; ?></p>
                                 </div>
                                 <div class="botbox">
                                    <h4><?php echo $homeTestimonial['name']; ?></h4>
                                    <h6><?php echo $homeTestimonial['designation']; ?></h6>
                                 </div>
                              </div>
                           </li>
                           <?php } ?>
                        </ul>
                     </div>
                  </div>
               </div>
            </section>
            <section class="section homecontactus-section">
               <div class="homecontactus-in">
                  <div class="container p0">
                     <?php include('commoncontact.php');?>
                  </div>
               </div>
            </section>
            <?php include("include/footer.php");?> 
         </div>
      </main>
      <?php include("include/footer-link.php");?>
      <script type="text/javascript">
         are_cookies_enabled();
         
         function are_cookies_enabled(){
            var cookieEnabled = (navigator.cookieEnabled) ? true : false;
            if (typeof navigator.cookieEnabled == "undefined" && !cookieEnabled){ 
               document.cookie="testcookie";
               cookieEnabled = (document.cookie.indexOf("testcookie") != -1) ? true : false;
            }
            return cookieEnabled;
         }


         

         <?php 
            if(!isset($_COOKIE["chatSessionId"])){
                  $chatSessionId = $functions->generateOTP('5');
                  $chatSessionId = time()."-".$chatSessionId;
         ?>
               $.cookie('chatSessionId', '<?php echo $chatSessionId; ?>', { path: '/' });
               if ($.cookie('chatSessionId') == '<?php echo $chatSessionId; ?>') {
                   // cookie worked, set/enable appropriate things
               }
         <?php
            }
         ?>
      </script>
      <script type="text/javascript">
         $(document).ready(function() { 
         
         $(".mutbtn").click(function(){
                  $(this).find("i").toggleClass("fa-microphone-slash");
                  $(this).find("i").toggleClass("fa-microphone");
                  var vid1=document.getElementById("videosss");
                  vid1.muted = !vid1.muted;
         }); 

         	if ($(window).width() > 1100) {
         		var myFullpage = new fullpage('#fullpage', {
         			verticalCentered: true,
         			scrollBar:true,
         			/*anchors: ['homesbanners1', 'homesbannersecs', 'futureconnectivitys', 'superiorsolutions', 'empoweringinds', 'headlines', 'testimonialss', 'homecontactuss', 'footers'],
         			navigationTooltips: ['homesbanner1', 'homesbannersec', 'student', 'futureconnectivity', 'superiorsolution', 'headline', 'empoweringind' , 'testimonial', 'homecontactus', 'footer'],*/
         			css3: true,
         			afterLoad: function(anchorLink, index){
         				function MatchHeight1() {
         					$('.match').matchHeight({});
         				}
         			}
         		});
         	}
         });
         if ($(window).width() > 601) {
         $(document).ready(function(){
	         var $myflip = $(".testslider").flipster({
	         itemContainer: 'ul',
	         itemSelector: 'li',
	         style: 'carousel',
	         spacing: -0.65,
	         nav: false,
	         buttons: true,
	         pauseOnHover: false,
	         loop: true,
	         click: true,
	         enableMousewheel: false,
	         scrollwheel: false,
         });
         });
         }
         // $(document).ready(
         //    function(){
         // 		var $myflip = $(".testslider").flipster({
         // 				itemContainer: 'ul',
         //          			itemSelector: 'li',
         //               style: 'carousel',
         //               spacing: -0.65,
         //               nav: false,
         //               buttons: true,
         //               pauseOnHover: false,
         //               loop: true,
         //               click: true,
         //               enableMousewheel: false,
         //               scrollwheel: false,
         //            })
         // 	});
         $('.superiorsolution-tabs li a').click(function(){
         function MatchHeight1() {
         $('.match').matchHeight({});
         }
         })
         function tabsnavclick1(playId){
         $(".myVideo").get(0).pause();
         $("#myVideo"+playId).get(0).play();
         }
         $(document).ready(function(){
         getAccordion("#suptab",600);
         });
         function getAccordion(element_id,screen) 
         {
         if ($(window).width() < screen) 
         {
         var concat = '';
         obj_tabs = $( element_id + " li" ).toArray();
         obj_cont = $( ".superiorsolution-content .tab-pane" ).toArray();
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
         $('.supproductslider').slick({
         arrows: true,
         dots: false,
         speed: 2000,
         slidesToShow: 3,
         slidesToScroll: 1,
         autoplay: true,
         autoplaySpeed: 3000,
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
         $(".superiorsolution-content").remove();
         } 
         } 
      </script>
   </body>
</html>