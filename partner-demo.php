<?php 
//die("hiiiii");
   include_once 'include/functions.php';
   $functions = new Functions();

   $sql ="select * from ".PREFIX."partner_cms ";
   $query = $functions->query($sql);
   $mediaCMS = $functions->fetch($query);
   $bannerImageData = $functions->getImageUrl('slider-banner', $mediaCMS['image_name'], 'crop', '');
   $PartnerbannerImageData = $functions->getImageUrl('slider-banner', $mediaCMS['partner_new_image'], 'crop', '');
   $channelPartnerImageData = $functions->getImageUrl('slider-banner', $mediaCMS['channel_partner_image'], 'crop', '');




   if(isset($_POST['productTrainingform'])){
	$name = $functions->escape_string($functions->strip_all($_POST['fname']));
	$lname = $functions->escape_string($functions->strip_all($_POST['lname']));
	$mobile = $functions->escape_string($functions->strip_all($_POST['mobile']));
	$email = $functions->escape_string($functions->strip_all($_POST['email']));
	$country = $functions->escape_string($functions->strip_all($_POST['country']));
	if(isset($_POST['city'])){
		$city = $functions->escape_string($functions->strip_all($_POST['city']));
	}else{
		$city="";
	}
	if(isset($_POST['state'])){
		$city = $functions->escape_string($functions->strip_all($_POST['state']));
	}else{
		$city="";
	}
	$designation = $functions->escape_string($functions->strip_all($_POST['designation']));
	$organization = $functions->escape_string($functions->strip_all($_POST['organization']));
	$sqlInsert = "insert into ".PREFIX."product_training_details(firstname, lastname, mobile, email, country, city, designation, organization,state)VALUES('".$name."', '".$lname."', '".$mobile."', '".$email."', '".$country."', '".$city."', '".$designation."', '".$organization."', '".$state."' )";
	$queryInsert = $functions->query($sqlInsert);

	header("location: ".BASE_URL."/Become-a-Partner/Thank-You");
	exit();
}

?>
<!DOCTYPE html>
<html>
<head>
	<title><?php echo SITE_NAME; ?> || Become a Partner </title>
	<?php include("include/header-link.php");?>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
<style>
#popup { 
  	display: none; 
		border: 1px black solid;
    width: 800px;
    max-width: 90%;
    height: 62vh;
    background-color: white;
    z-index: 10;
    position: absolute;
    left: 50%;
    top: 50%;
    transform: translate(-50%,-50%);
}

#page { 
  display: none; 
  width: 100%; height: 100%; 
  top:0px; left:0px;
  z-index: 9;
  padding: 2em;
  position: absolute;
}

.logo-LkZlp, .wink .logo-LkZlp {
    max-width: 100px;
}
	
.darken { background: rgba(0, 0, 0, 0.7); }

#iframe { border: 0; width: 100%; height: 100%; }

	</style>

</head>
<body class="innerpage partnerspage">
	<main class="root">
		<?php include("include/header.php");?>
		<section class="mainbanner-section mtop">
			<img src="<?php echo $PartnerbannerImageData; ?>">
			<div class="mainbanner-txt">
				<h1>Partner with us</h1>
			</div>
		</section>
		
		<section class="breadcrumb-section">
			<div class="container p0">
			</div>
		</section>

		<section class="collaborate-section">
			<div class="container p0">
				<div class="collaborate-in">
					<div class="collaborate-text wow fadeInUp" data-wow-delay="0.5s">
						<?php echo $mediaCMS['introduction']; ?>
						<!-- <button type="button" class="btn btn-primary custmbtn-train" data-toggle="modal" data-target="#exampleModal">Register For Product Training</button> -->
					</div>
					<div class="collaborate-tabs wow fadeInUp" data-wow-delay="0.5s">
						<ul class="nav nav-tabs">
							<li><a data-toggle="tab" href="javascript:void(0);" class="signin" style="cursor:default;"><span style="opacity:0">Sign In</span></a></li>
						 	<li class="active"><a data-toggle="tab" href="#joinus" class="joinus">Join us</a></li>
						</ul>

						<div class="tab-content">
						 	<div id="signin" class="tab-pane fade">
						 		<div class="signinbox">
							   	<form class="signinform" autocomplete="off">
							   		<div class="form-group">
							   			<input type="text" name="text" class="form-control" placeholder="Email or Phone number" required>
							   		</div>
							   		<div class="form-group">
							   			<input type="password" name="password" class="form-control" placeholder="Enter Password" required>
							   		</div>
							   		<button type="submit">Sign In</button>
							   		<p><a href="<?php echo BASE_URL; ?>/contact-us">Need help?</a></p>
							   	</form>
							   </div>
						  	</div>
						  	<div id="joinus" class="tab-pane fade in active">
						 		<div class="signinbox">
							   	<form class="signinform" id="partenerEmailForm" method="POST" action="<?php echo BASE_URL; ?>/Become-a-Partner/Partner-Registration" autocomplete="off">
							   		<div class="form-group">
							   			<input type="email" name="email" class="form-control" placeholder="Enter Email" required>
							   		</div>
							   		<button type="submit">Get started</button>
							   		<p><a href="<?php echo BASE_URL; ?>/contact-us">Need help?</a></p>
							   	</form>
							   </div>
						  	</div>
						</div>
					</div>

 <!-- Modal -->
<div class="modal fade popupform" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h5 class="modal-title" id="exampleModalLabel">Please fill the form to register for the Product Training on</h5>
      </div>
      <div class="modal-body">
	  <form  method="POST" id="productTrainingformsumbit">
							<div class="form-group">
								<input type="text" name="fname" class="form-control" placeholder="First Name" required>
							</div>
							<div class="form-group">
								<input type="text" name="lname" class="form-control" placeholder="Last Name" required>
							</div>
							<div class="form-group">
								<input type="text" name="mobile" class="form-control validateMobileClass" placeholder="Mobile" required>
							</div>
							<div class="form-group">
								<input type="email" name="email" class="form-control" placeholder="Email ID" required>
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
							<div class="form-group">
								<input type="text" name="state" class="form-control" placeholder="State" required>
							</div>
							<div class="form-group">
								<input type="text" name="city" class="form-control" placeholder="Enter City" required>
								
							</div>

							<div class="form-group">
								<input type="text" name="designation" class="form-control" placeholder="Designation" required>
							</div>
							<div class="form-group">
								<input type="text" name="organization" class="form-control" placeholder="Organization" required>
							</div>

				         <div class="btnbox">
				         	<button type="submit" name="productTrainingform">Submit</button>
				         </div>
						</form>
      </div>
      <div class="modal-footer">
        
      </div>
    </div>
  </div>
</div>
 <!-- Modal Ends-->

				</div>
			</div>
		</section>

		<section class="marketing-points">
			<div class="container">
				<div class="row">
					<div class="col-md-4 col-sm-4 col-xs-12 text-center">
						<img src="images/partner/icons/oi-1-16333259021-1.png">
						<h4>Marketing<br> Collaterals</h4>
					</div>
					<div class="col-md-4 col-sm-4 col-xs-12 text-center">
						<img src="images/partner/icons/oi-1-16333259021-2.png">
						<h4>Trainings &<br> Certifications</h4>
					</div>
					<div class="col-md-4 col-sm-4 col-xs-12 text-center">
						<img src="images/partner/icons/oi-1-16333259021-3.png">
						<h4>Technical & Sales<br> Support</h4>
					</div>
				</div>
			</div>
		</section>

		<section class="quickdata-section">
			<div class="container p0">
				<div class="quickdata-in">
					<h3 class="wow fadeInUp animated" data-wow-delay="0.5s">Purposeful Collaboration</h3>
					<p class="wow fadeInUp text-center">
						Want to play a key role in shaping the connected future? If you answer is yes, then IO by HFCL is the right partnership for you! We at IO will provide you with all the market expertise, tech knowledge to ensure that you have all that you need to succeed. We believe our partners are an extension of us and together we can realize our vision of providing interner for all. Join our Partner onboard program now!
					</p>
					<ul>
						<li>
							<div class="quickdatatumb">
								<img src="https://io.hfcl.com/images/partner/shutterstock_760384009-1633096830-1_crop.jpg" alt="transformation" loading="lazy">
							</div>
							<div class="quickdatatext">
								<h4>Transformation</h4>
								<p>Create value to your existing portfolio to accelerate digital transformation</p>
							</div>
						</li>

						<li>
							<div class="quickdatatumb">
								<img src="https://io.hfcl.com/images/partner/shutterstock_734391004-1633085193-1_crop.jpg" alt="transformation" loading="lazy">
							</div>
							<div class="quickdatatext">
								<h4>Expansion</h4>
								<p>Fast-track your growth with our sales expertise and sales enablement tools</p>
							</div>
						</li>

						<li>
							<div class="quickdatatumb">
								<img src="https://io.hfcl.com/images/partner/shutterstock_683657572-1633085226-1_crop.jpg" alt="transformation" loading="lazy">
							</div>
							<div class="quickdatatext">
								<h4>Profitability</h4>
								<p>Open new markets and quickly add value to your bottom line</p>
							</div>
						</li>

					</ul>
				</div>
			</div>
		</section>

		<section class="preidentsay-section">
			<div class="container p0">
				<div class="preidentsay-in">
					<h5 class="wow fadeInUp" data-wow-delay="0.5s"><span class="left"><i class="fa fa-quote-left" aria-hidden="true"></i></span> 
						<div>
							<?php echo $mediaCMS['testimonial_description']; ?>
						</div>
					<span class="right"><i class="fa fa-quote-right" aria-hidden="true"></i></span></h5>
					<h6><?php echo $mediaCMS['testimonial_title']; ?></h6>
				</div>
			</div>
		</section>


		<section class="partnerbottom-sec">
			<img src="<?php echo $channelPartnerImageData; ?>">
				<div class="partnerbottom-box">

				<?php echo $mediaCMS['channel_partner_description']; ?>

					<!-- <h3>For our Channel Partners, Value Added Resellers, System Integrators</h3>
					<ul>
						<li>Focused maketing programs for your customers</li>
						<li>Pre and post technical and sales support</li>
						<li>Leads Sharing</li>
						<li>Partnership Logo and Listing on HFCL's Find a Partner Site</li>
						<li>Branding Support-Leverage Brand value</li>
						<li>Product Demos and Joints Roadshows</li>
					</ul> -->
				</div>
		</section>

 
<div id="page">
</div>
<!-- <div id="popup">
  <iframe src="https://us20.list-manage.com/survey?u=d3a9a64745205edccb3b3a152&id=ed1d14c0ca&attribution=false" id="iframe"></iframe>
</div> -->



	</main>

	<?php include("include/footer.php");?> 
	<?php include("include/footer-link.php");?>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
	<script type="text/javascript">

		$(document).ready(function(){
			$('.selectpick').selectpicker();
		});

		if ($(window).width() < 800) {
         <?php
            if(isset($_GET['action'])){
                  ?>               
                     $('html, body').animate({scrollTop: $( '.<?php echo $_GET['action']; ?>' ).offset().top - 340}, 500);
                        $('.collaborate-tabs ul li').removeClass('active');
                        $('.tab-pane').removeClass('in active');
                        $(".<?php echo $_GET['action']; ?>").parent().addClass("active");
                        $("#<?php echo $_GET['action']; ?>").addClass("in active");
                        <?php
                     }
               ?>
             }
             if ($(window).width() > 800) {
               <?php
                  if(isset($_GET['action'])){
                  ?>               
                     $('html, body').animate({scrollTop: $( '.<?php echo $_GET['action']; ?>' ).offset().top - 130}, 500);
                        $('.collaborate-tabs ul li').removeClass('active');
                        $('.tab-pane').removeClass('in active');
                        $(".<?php echo $_GET['action']; ?>").parent().addClass("active");
                        $("#<?php echo $_GET['action']; ?>").addClass("in active");
                        <?php
                     }
               ?>
             }

// $( document ).ready(function(){
// window.open("https://us20.list-manage.com/survey?u=d3a9a64745205edccb3b3a152&id=ed1d14c0ca&attribution=false", "popupWindow", "width=800,height=800,scrollbars=yes");
// });



// $(document).ready(function () {
    
//         $("#thedialog").attr("https://us20.list-manage.com/survey?u=d3a9a64745205edccb3b3a152&id=ed1d14c0ca&attribution=false");
//         $("#somediv").dialog({
//             width: 400,
//             height: 450,
//             modal: true,
//             close: function () {
//                 $("#thedialog").attr('https://us20.list-manage.com/survey?u=d3a9a64745205edccb3b3a152&id=ed1d14c0ca&attribution=false', "about:blank");
//             }
//         });
//         return false;
    
// });



document.getElementById("popup").showpopup = function() {
  document.getElementById("popup").style.display = "block";
  document.getElementById('iframe').src = "https://us20.list-manage.com/survey?u=d3a9a64745205edccb3b3a152&id=ed1d14c0ca&attribution=false";
  document.getElementById('page').className = "darken";
  document.getElementById("page").style.display = "block";
}

// document.getElementById("a").onclick = function(e) {
//   e.preventDefault();
//   document.getElementById("popup").showpopup();
// }
$(document).ready(function () {
  //e.preventDefault();
  document.getElementById("popup").showpopup();
});

document.getElementById('page').onclick = function() {
  if(document.getElementById("popup").style.display == "block") {
    document.getElementById("popup").style.display = "none";
    document.getElementById("page").style.display = "none";
    document.getElementById('page').className = "";
  }
};






	</script>
</body>
</html>