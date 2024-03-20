<?php 
   include_once 'include/functions.php';
   $functions = new Functions();

   $sql ="select * from ".PREFIX."partner_cms ";
   $query = $functions->query($sql);
   $mediaCMS = $functions->fetch($query);
   $bannerImageData = $functions->getImageUrl('slider-banner', $mediaCMS['image_name'], 'crop', '');


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
  width: 400px; height: 200px; 
  top:20px; left:20px;
  background-color: white;
  z-index: 10;
  padding: 2em;
  position: fixed;
}

#page { 
  display: none; 
  width: 100%; height: 100%; 
  top:0px; left:0px;
  z-index: 9;
  padding: 2em;
  position: absolute;
}
	
.darken { background: rgba(0, 0, 0, 0.7); }

#iframe { border: 0; }

	</style>

</head>
<body class="innerpage partnerspage">
	<main class="root">
		<?php include("include/header.php");?>
		<section class="innerpagebanner-section mtop">
			<img src="<?php echo $bannerImageData; ?>" alt="partners-banner" class="inbanner">
			<div class="inbantext">
				<div class="container p0">
					<h1 class="wow fadeInUp" data-wow-delay="0.5s"><?php echo $mediaCMS['title']; ?></h1>
					<p class="wow fadeInUp" data-wow-delay="0.5s"><?php echo $mediaCMS['description']; ?></p>
				</div>
			</div>
		</section>
		<section class="breadcrumb-section">
			<div class="container p0">
				<ul class="breadcrumb-in">
					<li class="wow fadeIn" data-wow-delay="0.5s"><a href="<?php echo BASE_URL; ?>">Home</a></li>
					<li class="wow fadeIn" data-wow-delay="0.55s"><a href="javascript:void(0);">Partner</a></li>
					<li class="wow fadeIn" data-wow-delay="0.6s"><a href="javascript:void(0);">Become a Partner</a></li>
				</ul>
			</div>
		</section>
		
		<section class="collaborate-section">
			<div class="container p0">
				<div class="collaborate-in">
					<div class="collaborate-text wow fadeInUp" data-wow-delay="0.5s">
						<?php echo $mediaCMS['introduction']; ?>
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

<!----Model for Product Training------>

<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  Register For Product Training
</button>

 <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Please fill the form to register for the Product Training on</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
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
				            <p class="redtext">All fields are mandatory</p>
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

		<section class="onboardprogram-section">
			<div class="container p0">
				<div class="onboardprogram-in">
					<h2 class="wow fadeInUp" data-wow-delay="0.5s">Why Join Partner Onboard Program</h2>
					<div class="onboardprogram-flex">
						<?php 
							$sql = "select * from ".PREFIX."partner_onboard_master where active='1' ";
							$query = $functions->query($sql);
							while($onboardData = $functions->fetch($query)){
								$onboardImage = $functions->getImageUrl('partner', $onboardData['image_name'], 'crop', '');
						?>
							<div class="onboardprogram-sub match wow fadeInUp" data-wow-delay="0.5s">
								<div class="oniconbox">
									<img src="<?php echo $onboardImage; ?>" alt="onicon_1" loadong="lazy">
								</div>
								<h4><?php echo $onboardData['title']; ?></h4>
							</div>
						<?php } ?>

					</div>
				</div>
			</div>
		</section>

		<section class="moveladder-section">
			<div class="container p0">
				<div class="moveladder-in">
					<h2 class="wow fadeInUp" data-wow-delay="0.5s">Move up the ladder as you grow</h2>
					<p class="wow fadeInUp" data-wow-delay="0.55s"><?php echo $mediaCMS['ladder_detail_description']; ?></p>

					<div class="ladderteble-wrap">
						<table class="ladderteble">
							<thead>
								<tr>
									<th>Key <br>Benefits</th>
									<?php 
										$sql = "select * from ".PREFIX."ladder_category_master where active='1' ";
										$query = $functions->query($sql);
										while($ladderCategory = $functions->fetch($query)){	
									?>
											<th><?php echo $ladderCategory['name']; ?> </th>
									<?php } ?>
								</tr>
							</thead>
							<tbody>

								<?php 
									$sql = "select * from ".PREFIX."ladder_master where active='1' ORDER by display_order ASC";
									$query = $functions->query($sql);
									while($ladderDetails = $functions->fetch($query)){	
										$ladderArray = explode(",", $ladderDetails['ladder']);
								?>
									<tr>
										<td><?php echo $ladderDetails['key_name']; ?></td>
										<?php 
											$sql2 = "select * from ".PREFIX."ladder_category_master where active='1' ";
											$query2 = $functions->query($sql2);
											while($ladderCategory2 = $functions->fetch($query2)){	
												if(in_array($ladderCategory2['id'], $ladderArray)){
										?>
												<td><img src="<?php echo BASE_URL;?>/images/tick.png"></td>
										<?php }else{?>
												<td></td>
										<?php }?>
										<?php } ?>
									</tr>
								<?php } ?>
							</tbody>
						</table>
					</div>

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

		<section class="togrtherwecan-section">
			<div class="container p0">
				<div class="togrtherwecan-in">
					<?php echo $mediaCMS['togather_we_can']; ?>
					<div class="togrtherflex">
						<?php 
							$sql = "select * from ".PREFIX."togimg_master where active='1' ";
							$query = $functions->query($sql);
							while($onboardDataImg = $functions->fetch($query)){
								$onboardImagetog = $functions->getImageUrl('partner', $onboardDataImg['image_name'], 'crop', '');
						?>
							<div class="togrthersub match wow fadeInUp" data-wow-delay="0.5s">
								<div class="togrthertumb">
									<img src="<?php echo $onboardImagetog; ?>" alt="transformation" loading="lazy">
								</div>
								<div class="togrthertext">
									<h4><?php echo $onboardDataImg['title']; ?></h4>
									<p><?php echo $onboardDataImg['description']; ?></p>
								</div>
							</div>
						<?php } ?>
					</div>
				</div>
			</div>
		</section>

 
<div id="page">
</div>
<div id="popup"> 
  
  <iframe src="https://us20.list-manage.com/survey?u=d3a9a64745205edccb3b3a152&id=ed1d14c0ca&attribution=false" id="iframe"></iframe>
</div>



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