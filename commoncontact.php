<div class="contactbox wow fadeInUp" data-wow-delay="0.5s">
	<h2>Let’s stay connected</h2>
			<form class="formclass" method="POST" action="<?php echo BASE_URL;?>/contact-form.php" id="contactformsumbit">

				<div class="form-group">

					<input type="text" name="name" class="form-control" placeholder="First Name" required>

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

					<select name="country" onchange="checkCountry(this.value);" class="form-control checkcountryvalidation">

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
						<input type="text" name="city" class="form-control" placeholder="Enter City" pattern="^[a-zA-Z\s]+$" required>
					<?php /*<select name="city" id="cityContact" class="form-control">
						<option selected disabled focus>City</option>
						<?php 
							$sqlCity = $functions->query("select * from ".PREFIX."city_master where is_deleted='0' AND active='1' AND country_id='101' ORDER BY city_name ASC");
							while($cityDetails = $functions->fetch($sqlCity)){
						?>
							<option value="<?php echo $cityDetails['city_name']; ?>"><?php echo $cityDetails['city_name']; ?></option>
						<?php } ?>
					</select>*/ ?>

				</div>

				<div class="form-group">

					<select name="enquiry_type" class="form-control">

						<option selected disabled focus>Enquiry Type</option>

						<option value="General Enquiry">General Enquiry</option>

						<option value="Product Enquiry">Product Enquiry</option>

					</select>

				</div>

				<div class="form-group">

					<input type="text" name="message" class="form-control" placeholder="Message" required>

				</div>

	            <div class="recaptcha-div">

	                <div id="recaptcha" name="recaptcha" class="g-recaptcha" data-sitekey="6LclOxAdAAAAAIQKSWYTCUhGkXsIFdFigZOabJZn"></div>

	            </div>

	            <div class="btnbox">

	         		<button type="submit" name="submitContactForm">Submit</button>

	              	<p class="redtext">All fields are mandatory</p>

	               	</div>

			</form>

</div>