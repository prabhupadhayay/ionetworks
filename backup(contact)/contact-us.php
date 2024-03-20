<?php 
   include_once 'include/functions.php';
   $functions = new Functions();
   $sql ="select * from ".PREFIX."contact_cms ";
   $query = $functions->query($sql);
   $contactCMS = $functions->fetch($query);
   $bannerImageData = $functions->getImageUrl('slider-banner', $contactCMS['image_name'], 'crop', '');
   
?>

<!DOCTYPE html>

<html lang="en">

<head>

	<title>Contact Us | IO by HFCL</title>
    <meta name="title" content="Contact Us | IO by HFCL" />
    <meta name="description" content=" Get in touch with Us - Your trusted technology partner. Contact us in English for seamless communication and exceptional solutions." />
    <link rel="canonical" href="https://io.hfcl.com/contact-us" />

     <!-- Facebook Meta Tags -->
    <meta property="og:type" content="website" />
    <meta property="og:url" content="https://io.hfcl.com/" />
    <meta property="og:title" content="Contact Us | IO by HFCL" />
    <meta property="og:description" content=" Get in touch with Us - Your trusted technology partner. Contact us in English for seamless communication and exceptional solutions. " />
    <meta property="og:image" content="https://io.hfcl.com/images/product/contact-featured.jpg" />

     <!-- Twitter Meta Tags -->
    <meta property="twitter:card" content="summary_large_image" />
    <meta property="twitter:domain" content="io.hfcl.com/" />
    <meta property="twitter:url" content="https://io.hfcl.com/" />
    <meta property="twitter:title" content="Contact Us | IO by HFCL" />
    <meta property="twitter:description" content=" Get in touch with Us - Your trusted technology partner. Contact us in English for seamless communication and exceptional solutions. " />
    <meta property="twitter:image" content="https://io.hfcl.com/images/product/contact-featured.jpg" />

	<?php include("include/header-link-small.php");?>

</head>

<body class="innerpage contactuspage">

	<main class="root">

		<?php include("include/header.php");?>

        <section class="subheader_part">
            <div class="container">
                <div class="subheader_item">
                    <h1>Contact us for Sales Queries / Demo</h1>
                </div>
            </div>
        </section>

		<!-- breadcrumb_area start -->
        <div class="breadcrumb_area">
            <div class="container">
                <div class="breadcumb_cnt">
                    <ul>
                        <li><a href="<?php echo BASE_URL;?>">Home</a></li>
                        <li><img src="images/right.svg" alt=""></li>
                        <li class="inner120"><a href="#">Contact us</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- breadcrumb_area end -->

        <!-- map-area -->
        <!-- contact-area -->
        <section class="contact-area">
            <div class="container"> 
                <div class="row">
                    <div class="col-md-5">
                        <div class="tool-right">
                    <form class="formclass" method="POST" action="<?php echo BASE_URL;?>/contact-form.php" id="contactformsumbit">
                        <div class="row">
                            <div class="enter-input-wrap">
                                <div class="enterinput-title"><h6>Name</h6></div>
                              <div class="enter-input">
                                  <input type="text" name="name" class="form-control" required>
                              </div>
                          </div>
                          <div class="enter-input-wrap">
                            <div class="enterinput-title"><h6>Email ID</h6></div>
                                <div class="enter-input">
                                    <input type="email" name="email" class="form-control" required>
                                </div>
                            </div>
                            <div class="enter-input-wrap">
                                <div class="enterinput-title"><h6>Mobile Number</h6></div>
                                <div class="enter-input">
                                    <input type="number" name="mobile" class="form-control validateMobileClass" required>
                                </div>
                            </div>
                            <div class="enter-input-wrap">
                                <div class="enterinput-title"><h6>Country</h6></div>
                                <div class="enter-input">
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
                            </div>
                            <div class="enter-input-wrap">
                                <div class="enterinput-title"><h6>City</h6></div>
                                <div class="enter-input">
                                    <input type="text" name="city" class="form-control" required>
                                </div>
                            </div>
                            <div class="enter-input-wrap">
                                <div class="enterinput-title"><h6>Enquiry Type</h6></div>
                                <div class="enter-input">
                                    <select name="enquiry_type" class="form-control">
                                                    <option selected disabled focus>Enquiry Type</option>
                                                    <option value="General Enquiry">General Enquiry</option>
                                                    <option value="Product Enquiry">Product Enquiry</option>
                                                </select>
                                </div>
                            </div>

                        <div class="enter-input-wrap">
                        <div class="enterinput-title"><h6>Message</h6></div>
                        <div class="enter-input textarea-item">
                            <input type="text" name="message" class="form-control" required>
                        </div>
                        </div>

                        <div class="enter-input-wrap">
                            <div class="enterinput-title" style="opacity: 0;"><h6>recaptcha</h6></div>
                            <div class="enter-input">
                                <div id="recaptcha" name="recaptcha" class="g-recaptcha" data-callback="enableBtn" data-sitekey="6LclOxAdAAAAAIQKSWYTCUhGkXsIFdFigZOabJZn"></div>
                            </div>
                        </div>
                        </div>

                        <div class="enter-submit text-end">
                            <button type="submit" name="submitContactForm" id="submitButton" disabled="disabled">Submit</button>
                            <p id="errorMessage" style="color: red;">Captcha is Required</p>
                        </div>
                        </form>
                </div>
                    </div>
                    <div class="col-md-7">
                        <div class="map-main">
                    <div class="row align-items-center">
                        <div class="col-12 col-md-12 flexmapdiv">
                            <div class="map-left">
                                <div class="map-item-inner map-item-inner2">
                                    <ul>
                                        <li><img src="images/callus.png" alt=""></li>
                                        <li>Customer support <p>8792 701 100</p></li>
                                    </ul>
                                </div>
                                
                                <div class="map-item-inner">
                                    <ul>
                                        <li><img src="images/email.png" alt=""></li>
                                         <li>Write To Us <p><a href="mailto:iosales@hfcl.com">iosales@hfcl.com</a></p></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
               </div>
               <div class="office-area">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="office-item">
                            <p class="h2">Corporate Office</p class="h2">
                            <?php 
                                            $sqlOffice = "select * from ".PREFIX."address_master where active='1' AND office_type='Corporate Office' ";
                                            $sqlOfficeQuery = $functions->query($sqlOffice);
                                            while($officeDetails = $functions->fetch($sqlOfficeQuery)){
                                        ?>
                                                <p><?php echo $officeDetails['address']; ?></p>
                                                <?php 
                                                    if(!empty($officeDetails['telephone'])){
                                                ?>  
                                                    <p>Tel: <a href="tel:<?php echo $officeDetails['telephone']; ?>"><?php echo $officeDetails['telephone']; ?></a></p>
                                                <?php
                                                    }
                                                ?>

                                                <?php 
                                                    if(!empty($officeDetails['fax'])){
                                                ?>
                                                    <p>Fax: <?php echo $officeDetails['fax']; ?></p>
                                                <?php
                                                    }
                                                ?>

                                                <?php 
                                                    if(!empty($officeDetails['email'])){
                                                ?>
                                                    <p>Email: <a href="mailto:<?php echo $officeDetails['email']; ?>"><?php echo $officeDetails['email']; ?></a></p>
                                                <?php
                                                    }
                                                ?>
                                        <?php } ?>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="office-item lasthidden">
                           <p class="h2">Center of Excellence</p>
                           <?php 
                                        $sqlOfficeExe = "select * from ".PREFIX."address_master where active='1' AND office_type='Excellence Office' ";
                                        $sqlOfficeQueryExe = $functions->query($sqlOfficeExe);
                                        while($officeDetailsEx = $functions->fetch($sqlOfficeQueryExe)){
                                    ?>
                                            <p><?php echo $officeDetailsEx['address']; ?></p>
                                            <?php 
                                                if(!empty($officeDetailsEx['telephone'])){
                                            ?>  
                                                <p>Tel: <a href="tel:<?php echo $officeDetailsEx['telephone']; ?>"><?php echo $officeDetailsEx['telephone']; ?></a></p>
                                            <?php
                                                }
                                            ?>

                                            <?php 
                                                if(!empty($officeDetailsEx['fax'])){
                                            ?>
                                                <p>Fax: <?php echo $officeDetailsEx['fax']; ?></p>
                                            <?php
                                                }
                                            ?>

                                            <?php 
                                                if(!empty($officeDetailsEx['email'])){
                                            ?>
                                                <p>Email: <a href="mailto:<?php echo $officeDetailsEx['email']; ?>"><?php echo $officeDetailsEx['email']; ?></a></p>
                                            <?php
                                                }
                                            ?>
                                    <?php } ?>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="office-item hiddenall-3">
                             <p class="h2">Bengaluru Office</p>
                            <?php 
                                        $sqlOfficeExe = "select * from ".PREFIX."address_master where active='1' AND office_type='Excellence Office' ";
                                        $sqlOfficeQueryExe = $functions->query($sqlOfficeExe);
                                        while($officeDetailsEx = $functions->fetch($sqlOfficeQueryExe)){
                                    ?>
                                            <p><?php echo $officeDetailsEx['address']; ?></p>
                                            <?php 
                                                if(!empty($officeDetailsEx['telephone'])){
                                            ?>  
                                                <p>Tel: <a href="tel:<?php echo $officeDetailsEx['telephone']; ?>"><?php echo $officeDetailsEx['telephone']; ?></a></p>
                                            <?php
                                                }
                                            ?>

                                            <?php 
                                                if(!empty($officeDetailsEx['fax'])){
                                            ?>
                                                <p>Fax: <?php echo $officeDetailsEx['fax']; ?></p>
                                            <?php
                                                }
                                            ?>

                                            <?php 
                                                if(!empty($officeDetailsEx['email'])){
                                            ?>
                                                <p>Email: <a href="mailto:<?php echo $officeDetailsEx['email']; ?>"><?php echo $officeDetailsEx['email']; ?></a></p>
                                            <?php
                                                }
                                            ?>
                                    <?php } ?>
                        </div>
                    </div>
                </div>
        </div>
                    </div>
                </div>
                
            </div>
        </section>
        
    
        <!-- policy-area -->
        <section class="policy-area d-none">
            <div class="container">
                <div class="policy-title text-center">
                    <h2>How does our customer feedback process Work?</h2>
                    <p>We're committed to offering an exceptional experience, we welcome your insights on enhancing our services. Your feedback is valuable, and we're eager to assist.</p>
                </div>
                <div class="row">
                    <div class="col-lg-6 order-2 order-md-1 col-md-6">
                        <div class="policy-item">
                            <h3>Sales Assistance</h3>
                            <p>Navigating the purchase process or need information about our pricing plans? Our dedicated sales team is here to help. Whether you're a new customer wanting to learn more about our products or an existing client looking for upgrades, we ensure that all your sales-related questions are answered promptly. Reach out to us, and we'll guide you every step of the way.</p>
                            <p><a href="mailto:iosales@hfcl.com">sales@hfcl.com</a></p>
                        </div>
                    </div>
                    <div class="col-lg-6 order-1 order-md-2 col-md-6">
                        <div class="policy-item">
                            <img src="images/support.png" alt="">
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="policy-item">
                            <img src="images/product.png" alt="">
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="policy-item">
                            <h3>Product Assistance</h3>
                            <p>Encountering issues with a product or need guidance on its features? Dive into our comprehensive product support. Our team is well-versed with each product detail and is committed to assisting you in maximizing its benefits. From initial setup to troubleshooting, we're here to ensure you get the most out of your purchase. Let us know how we can be of service!</p>
                            <p><a href="mailto:ioenquiry@hfcl.com">ioenquiry@hfcl.com</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="associates-section" id="indassociates">
            <div class="container p0">
                <div class="associates-in">
                <?php 
                    $sqlAss = "select * from ".PREFIX."association_master where type='Association' AND active='1' ";
                    $sqlAssQuery = $functions->query($sqlAss);
                    if($functions->num_rows($sqlAssQuery)>0){

                ?>
                    <h2 class="wow fadeIn" data-wow-delay="0.5s">Industry Association</h2>
                    <div class="associatesflex">
                        <?php 
                            while($assDetails = $functions->fetch($sqlAssQuery)){
                                $associationImage = BASE_URL."/images/association/".$assDetails['image_name'];
                        ?>
                                <div class="thumbsub wow fadeInUp" data-wow-delay="0.5s">
                                    <img src="<?php echo $associationImage; ?>" alt="associates_1" loading="lazy">
                                </div>
                        <?php } ?>
                    </div>
                <?php } ?>

                <?php 
                    $sqlpt = "select * from ".PREFIX."association_master where type='Partner' AND active='1' ";
                    $sqlptQuery = $functions->query($sqlpt);
                    if($functions->num_rows($sqlptQuery)>0){

                ?>
                    <h2 class="wow fadeIn" data-wow-delay="0.65s">Distribution Partners</h2>
                    <div class="associatesflex">
                        <?php 
                            while($ptDetails = $functions->fetch($sqlptQuery)){
                                $ptImage = BASE_URL."/images/association/".$ptDetails['image_name'];
                        ?>
                                <div class="thumbsub wow fadeInUp" data-wow-delay="0.65s">
                                    <img src="<?php echo $ptImage; ?>" alt="associates_4" loading="lazy">
                                </div>
                    <?php } ?>
                        </div>
                    <?php } ?>

                </div>
            </div>
        </section>
        

	</main>
	<?php include("include/footer.php");?> 

	<?php include("include/footer-link-small.php");?>
	<script type="text/javascript">
		
		let captchay = Math.random() * 1000000;
		let captchax = Math.floor(captchay);
		document.getElementById("captchavalue").innerHTML = captchax;
		document.getElementById("captchainput2").value = captchax;
	

  		if ($(window).width() < 800) {

               <?php

                  if(isset($_GET['action'])){

                  ?>               

                     $('html, body').animate({scrollTop: $( '#<?php echo $_GET['action']; ?>' ).offset().top - 200}, 500);

                    <?php

                     }

               ?>

             }

             if ($(window).width() > 800) {

               <?php

                  if(isset($_GET['action'])){

                  ?>               

                     $('html, body').animate({scrollTop: $( '#<?php echo $_GET['action']; ?>' ).offset().top - 120}, 500);

                     <?php

                     }

               ?>

             }


		$(document).ready(function(){
			$("#contactformsumbit").validate({
				ignore: [],
				debug: false,
				rules: {
					mobile:{
						required:true,
						number:true
					},
					email:{
						required:true,
						email:true,
						remote:{
                           url:"ajax-check-email-contains.php",
                           type: "post"
                        }
					}
				},
				messages: {
					email:{
						remote:"gmail/yahoo/hotmail and rediff email id is not allowed."
					}
				}
			});  
		});


	</script>

</body>

</html>